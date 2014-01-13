<?php
namespace Auth\Model\Entity;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory;
use Auth\Model\PropertyName;
use Auth\Model\Entity\AbstractUserEntity;


/**
 * Description of Register
 *
 * @author victor
 */
class Register extends AbstractUserEntity{
    

    public $cpassword;
    public $first_name;
    public $last_name;
    

    public function exchangeArray($data){
        $this->user_email=(isset($data[PropertyName::USER_EMAIL])?$data[PropertyName::USER_EMAIL]:null);
        $this->user_pass=(isset($data[PropertyName::USER_PASS])?$data[PropertyName::USER_PASS]:null);
        $this->cpassword=(isset($data[PropertyName::CONFIRM_PASS])?$data[PropertyName::CONFIRM_PASS]:null);
        $this->first_name=(isset($data[PropertyName::FIRST_NAME])?$data[PropertyName::FIRST_NAME]:null);
        $this->last_name=(isset($data[PropertyName::LAST_NAME])?$data[PropertyName::LAST_NAME]:null);
    }
    
    public function getArrayCopy()
    {
      return get_object_vars($this);  
    }
    
    public function getInflatedArray(){
        $data=array();
        
        $data[PropertyName::USER_EMAIL]=$this->user_email;
        $data[PropertyName::USER_PASS]=$this->user_pass;
        $data[PropertyName::FIRST_NAME]=$this->first_name;
        $data[PropertyName::LAST_NAME]=$this->last_name;
       return $data;
    }
    
    public function getInputFilter() {
        if(!$this->inputFilter)
        {
            
            $inputFilter= new InputFilter();
            $factory= new Factory();
            $inputFilter->add($factory->createInput(array(
                'name'=>PropertyName::USER_EMAIL,
                //'required'=>true,
                 'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                ),
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
               
               
            )));
            
            $inputFilter->add(array(
                'name'=>PropertyName::USER_PASS,
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>6,
                        'max'=>40,
                               'messages'=>array(
                                   'stringLengthTooShort'=>"Too Short. Password must be %min% characters long",
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
            
            $inputFilter->add(array(
                'name'=>PropertyName::CONFIRM_PASS,
                //'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>100,
                         'messages'=>array(
                              'stringLengthTooShort'=>"Please enter at least %min% characters"
                                 )
                    ),
                       
                       ),
                     array('name'=>'Identical','options'=>array('token'=>'user_pass',
                          'messages'=>array(
                              'notSame'=>"Password must match"
                                 )
                         ),
                         )
                ),
                'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                )
            ));
            $inputFilter->add(array(
                'name'=>PropertyName::FIRST_NAME,
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>40,
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
            
            $inputFilter->add(array(
                'name'=>PropertyName::LAST_NAME,
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>40,
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
