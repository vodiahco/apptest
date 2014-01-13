<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Auth\Model\Form\RegisterForm;
use Auth\Model\Entity\Register;
use Zend\View\Model\ViewModel;
use Auth\Model\Mapper\RegisterMapper;
use Auth\Helper\RouteName;
use Zend\Validator\Db\NoRecordExists;
use Auth\Model\PropertyName;
/**
 * Description of RegisterController
 *
 * @author victor
 */
class RegisterController extends AbstractActionController{
    
   
    
    public function indexAction() {
        $form= new RegisterForm();
        $errorMessage="";
        $request=$this->getRequest();
        if($request->isPost())
        {
            $data=$request->getPost();
            $registerEntity= new Register();
            $registerEntity->exchangeArray($data);
            $form->bind($registerEntity);
            $form->setData($data);
            $form->setInputFilter($registerEntity->getInputFilter());
            
            if($form->isValid())
            {
                $sm=$this->getServiceLocator();
                $adapter= $sm->get('ZendDbAdapter');
                $existValidator= new NoRecordExists(array(
                    'table'=>  PropertyName::USER_TABLE,
                    'field'=> PropertyName::USER_EMAIL,
                    'adapter'=>$adapter
                )); 
                
                
                if($existValidator->isValid($registerEntity->user_email))
                {
             
             $registerMapper= new RegisterMapper($adapter);
             $result=$registerMapper->register($registerEntity);
             if($result>0)
             {
               $this->redirect()->toUrl(RouteName::getLoginUrl());  
             }
             
                }
                else{
                    $errorMessage="Email already used";
                }
             
            }
            else{
                $errorMessage="Invalid entry";
            }
        }
        
        $view= new ViewModel(array(
            'form'=>$form,
            'errorMessage'=>$errorMessage,
        ));
        return $view;
    }
}
