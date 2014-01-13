<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Auth\Model\Form\LoginForm;
use Auth\Model\Entity\Login as LoginEntity;
use Auth\Adapter\AuthAdapterDb;
use Zend\Authentication\AuthenticationService;
use Zend\Crypt\Password\Bcrypt;
use Zend\Authentication\Result;

class LoginController extends AbstractActionController
{
    public function indexAction()
    {
       $form= new LoginForm();
       $request=$this->getRequest();
       $errorMessage=array();
       $loginError="";
       if($request->isPost())
       {
          $loginEntity= new LoginEntity();  
          $form->setInputFilter($loginEntity->getInputFilter());
          $data=$request->getPost();
          $loginEntity->exchangeArray($data);
          $form->setData($data);
          $form->bind($loginEntity);
          if($form->isValid())
          {
             $sm= $this->getServiceLocator();
             $dbAdapter=$sm->get("ZendDbAdapter");
             $authAdapter= new AuthAdapterDb($dbAdapter,"tnb_users",'user_email','user_pass');
             $authAdapter->setIdentity($loginEntity->username);
             
             $securePass = MD5($loginEntity->password);
             $authAdapter->setCredential($securePass);

             $auth=$sm->get("Auth");
             $result=$auth->authenticate($authAdapter);
             if($result->isValid())
             {
                 $storage=$auth->getStorage();
                 $userColumn=$dbAdapter->getResultRowObject(null,'password');
                 $storage->write($userColumn);
                 $this->loginSuccessRedirect();
             }
             else
             {
                 $loginError=$this->getLoginError($result->getCode());
             }
          }
          else{
            $errorMessage=$form->getMessages();  
          }
          
       }
       
       
        $viewModel=new ViewModel(array(
            'form'=>$form,
            'errorMessage'=>$errorMessage,
            'loginError'=>$loginError
        ));
        return $viewModel;
    }
    
    
    
    
    
    
    protected function getLoginError($errorCode)
    {
        $errorMessage;
        switch($errorCode)
        {
        case Result::FAILURE_IDENTITY_NOT_FOUND:
        /** do stuff for nonexistent identity **/
        break;

        case Result::FAILURE_CREDENTIAL_INVALID:
        /** do stuff for invalid credential **/
        break;

        case Result::SUCCESS:
        /** do stuff for successful authentication **/
        break;

        default:
        /** do stuff for other failure **/
        break;
        }
        return $errorMessage="Login failed";
    }
    
    
    protected function loginSuccessRedirect()
    {
        
    }
}
