<?php

namespace Auth\Model\Entity;


/**
 * Description of AbstractUserEntity
 *
 * @author victor
 */
abstract class AbstractUserEntity {
   
    /**
     *
     * @var Zend\InputFilter\InputFilter 
     */
    protected $inputFilter;
    
    public $user_email;
    public $user_pass;
    public $ID;
}
