<?php
namespace Auth\Model\Form;
use Zend\Form\Form;
use Auth\Model\PropertyName;


/**
 * Description of LoginForm
 *
 * @author victor
 */
class LoginForm extends Form {
    
    function __construct($name="Login") {
        parent::__construct($name);
       $this->add(array(
          'name'=>  PropertyName::USER_EMAIL,
           'type'=>'text',
           'options'=>array(
               'label'=>"Username: "
           )
       ));
       
       $this->add(array(
          'name'=>  PropertyName::USER_PASS,
           'type'=>'password',
           'options'=>array(
               'label'=>"Password: "
           )
       ));
       
       $this->add(array(
          'name'=>'submit',
           'type'=>'submit',
          'attributes'=>array(
              'value'=>'Login'
          )
       ));
    }


    
}
