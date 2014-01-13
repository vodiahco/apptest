<?php

namespace Auth\Model\Form;

use Zend\Form\Form;
use Auth\Model\PropertyName;

/**
 * Description of LoginhelpForm
 *
 * @author victor
 */
class LoginhelpForm extends Form {
    
    function __construct() {
        parent::__construct();
        $this->add(array(
            'name'=>  PropertyName::USER_EMAIL,
            'type'=>'email',
            
            'options'=>array(
                'label'=>'Enter account email: ',
                
            )
        ));
        
        $this->add(array(
            'name'=>'submit',
            'type'=>'Submit',
            'attributes'=>array(
                'value'=>'reset password'
            )
        ));
    }

}
