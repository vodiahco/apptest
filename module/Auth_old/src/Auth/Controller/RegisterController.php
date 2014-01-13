<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Auth\Model\Form\RegisterForm;
use Auth\Model\Entity\Register;
use Zend\View\Model\ViewModel;
use Auth\Model\Mapper\RegisterMapper;
/**
 * Description of RegisterController
 *
 * @author victor
 */
class RegisterController extends AbstractActionController{
    
    
    public function indexAction() {
        parent::indexAction();
        $form= new RegisterForm();
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
             $registerMapper= new RegisterMapper($adapter);
             $registerMapper->register($registerEntity);
             
            }
            else{
                print_r($form->getMessages());
            }
        }
        
        $view= new ViewModel(array(
            'form'=>$form
        ));
        return $view;
    }
}
