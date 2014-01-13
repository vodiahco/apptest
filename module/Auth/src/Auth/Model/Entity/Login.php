<?php
namespace Auth\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Auth\Model\PropertyName;

/**
 * Description of Login
 *
 * @author victor
 */
class Login extends AbstractUserEntity implements InputFilterAwareInterface {
    
    

    
    
    public function exchangeArray($data){
        $this->user_email=(isset($data[PropertyName::USER_EMAIL])?$data[PropertyName::USER_EMAIL]:null);
        $this->user_pass=(isset($data[PropertyName::USER_PASS])?$data[PropertyName::USER_PASS]:null);
    }
    
    public function getArrayCopy()
    {
      return get_object_vars($this);  
    }
    
    
    public function getInputFilter() {
        if(!$this->inputFilter)
        {
            $inputFilter= new InputFilter();
            $inputFilter->add(array(
                'name'=>  PropertyName::USER_EMAIL,
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>6,
                        'max'=>100,
                             'messages'=>array(
                                   'stringLengthTooShort'=>"Too Short. Please enter at least %min% characters",
                                   'stringLengthTooLong'=>"Too long. Please enter at most %max% characters",
                                 )
                    )
                       ),
                     array(
                      'name'=>'EmailAddress',
                      'options'=>array(
                          'domain'=>false,
                          
                      )
                  )
                ),
                'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                )
            ));
            
            $inputFilter->add(array(
                'name'=>  PropertyName::USER_PASS,
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>6,
                        'max'=>100,
                               'messages'=>array(
                                   'stringLengthTooShort'=>"Too Short. Please enter at least %min% characters",
                                   'stringLengthTooLong'=>"Too long. Please enter at most %max% characters",
                                   
                                   
                                 )
                    )
                       )
                ),
                'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                )
            ));
            
            $this->inputFilter=$inputFilter;
        }
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        $this->inputFilter=$inputFilter;
    }

}
