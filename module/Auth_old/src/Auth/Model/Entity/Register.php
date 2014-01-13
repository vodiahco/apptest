<?php
namespace Auth\Model\Entity;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

/**
 * Description of Register
 *
 * @author victor
 */
class Register {
  protected $inputFilter;
    
    public $user_email;
    public $user_pass;
    public $cpassword;
    public $first_name;
    public $last_name;
    
    
    public function exchangeArray($data){
        $this->user_email=(isset($data["user_email"])?$data["user_email"]:null);
        $this->user_pass=(isset($data["user_pass"])?$data["user_pass"]:null);
        $this->cpassword=(isset($data["cpassword"])?$data["cpassword"]:null);
        $this->first_name=(isset($data["first_name"])?$data["first_name"]:null);
        $this->last_name=(isset($data["last_name"])?$data["last_name"]:null);
    }
    
    public function getArrayCopy()
    {
      return get_object_vars($this);  
    }
    
    public function getInflatedArray(){
        $data=array();
        
        $data["user_email"]=$this->user_email;
        $data["user_pass"]=$this->user_pass;
        $data["first_name"]=$this->first_name;
        $data["last_name"]=$this->last_name;
       return $data;
    }
    
    public function getInputFilter() {
        if(!$this->inputFilter)
        {
            $inputFilter= new InputFilter();
            $inputFilter->add(array(
                'name'=>'user_email',
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>100,
                    )
                       )
                ),
                'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                )
            ));
            
            $inputFilter->add(array(
                'name'=>'user_pass',
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>100,
                    )
                       )
                ),
                'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                )
            ));
            
            $inputFilter->add(array(
                'name'=>'cpassword',
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>100,
                    )
                       ),
                     array('name'=>'Identical','options'=>array('token'=>'user_pass'))
                ),
                'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                )
            ));
            $inputFilter->add(array(
                'name'=>'first_name',
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>100,
                    )
                       )
                ),
                'filters'=>array(
                    array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),

                )
            ));
            
            $inputFilter->add(array(
                'name'=>'last_name',
                'required'=>true,
                
                'validators'=>array(
                   array('name'=>'StringLength',
                    'options'=>array(
                        'encoding'=>'UTF-8',
                        'min'=>1,
                        'max'=>100,
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
