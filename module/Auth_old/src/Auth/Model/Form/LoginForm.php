<?php
namespace Auth\Model\Form;
use Zend\Form\Form;


/**
 * Description of LoginForm
 *
 * @author victor
 */
class LoginForm extends Form {
    
    function __construct($name="Login") {
        parent::__construct($name);
       $this->add(array(
          'name'=>'username',
           'type'=>'text',
           'options'=>array(
               'label'=>"Username: "
           )
       ));
       
       $this->add(array(
          'name'=>'password',
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
