<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Auth\Model\Form\LoginhelpForm;
use Auth\Model\Entity\LoginHelp;
use Auth\Model\Mapper\LoginHelpMapper;
use Auth\Model\PropertyName;
/**
 * Description of ActivateController
 *
 * @author victor
 */
class LoginhelpController extends AbstractActionController {
    
    
    public function indexAction() {
       $errorMessage=""; 
       $successMessage="";
       $form= new LoginhelpForm();
       $request=$this->getRequest();
       if($request->isPost())
       {
           $entity= new LoginHelp();
           $data=$request->getPost();
           $entity->exchangeArray($data);
           $form->setData($data);
           if($form->isValid())
           {
               $sm= $this->getServiceLocator();
               $adapter= $sm->get(PropertyName::ZEND_DB_ADAPTER_ID);
               $mapper=new LoginHelpMapper($adapter);
               $email=$entity->user_email;
               $result=$mapper->resetLink($email);
               if($result!=null)
               $successMessage="A password reset link has been sent to $email";  
               else
                    $successMessage="Account not found";  
           }
       }
       
       
       
        $view = new ViewModel(array(
            'form'=>$form,
            'errorMessage'=>$errorMessage,
            'successMessage'=>$successMessage,
        ));
        return $view;
    }
    
}
