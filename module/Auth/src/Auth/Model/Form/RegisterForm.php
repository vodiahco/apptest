<?php
namespace Auth\Model\Form;
use Zend\Form\Form;
use Auth\Model\PropertyName;

/**
 * Description of RegisterForm
 *
 * @author victor
 */
class RegisterForm extends Form {
  
    function __construct($name="Register") {
        parent::__construct($name);
        $this->add(array(
          'name'=>PropertyName::FIRST_NAME,
           'type'=>'text',
           'options'=>array(
               'label'=>"First name: "
           )
       ));
        
         $this->add(array(
          'name'=>PropertyName::LAST_NAME,
           'type'=>'text',
           'options'=>array(
               'label'=>"Last name: "
           )
       ));
       $this->add(array(
          'name'=>PropertyName::USER_EMAIL,
           'type'=>'email',
           'options'=>array(
               'label'=>"Email: "
           )
       ));
       
       $this->add(array(
          'name'=>PropertyName::USER_PASS,
           'type'=>'password',
           'options'=>array(
               'label'=>"Password: "
           )
       ));
       
       $this->add(array(
          'name'=>PropertyName::CONFIRM_PASS,
           'type'=>'password',
           'options'=>array(
               'label'=>"Confirm Password: ",
               
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
