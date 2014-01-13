<?php
namespace Auth\Model\Form;
use Zend\Form\Form;

/**
 * Description of RegisterForm
 *
 * @author victor
 */
class RegisterForm extends Form {
  
    function __construct($name="Register") {
        parent::__construct($name);
        $this->add(array(
          'name'=>'first_name',
           'type'=>'text',
           'options'=>array(
               'label'=>"First name: "
           )
       ));
        
         $this->add(array(
          'name'=>'last_name',
           'type'=>'text',
           'options'=>array(
               'label'=>"Last name: "
           )
       ));
       $this->add(array(
          'name'=>'user_email',
           'type'=>'email',
           'options'=>array(
               'label'=>"Email: "
           )
       ));
       
       $this->add(array(
          'name'=>'user_pass',
           'type'=>'password',
           'options'=>array(
               'label'=>"Password: "
           )
       ));
       
       $this->add(array(
          'name'=>'cpassword',
           'type'=>'password',
           'options'=>array(
               'label'=>"Confirm Password: "
           )
       ));
       
       $this->add(array(
          'name'=>'submit',
           'type'=>'submit',
          'attributes'=>array(
              'value'=>'Sign up'
          )
       ));
    }
}
