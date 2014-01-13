<?php
namespace Auth\Model\Entity;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Description of Login
 *
 * @author victor
 */
class Login implements InputFilterAwareInterface {
    
    protected $inputFilter;
    
    public $username;
    public $password;
    
    
    public function exchangeArray($data){
        $this->username=(isset($data["username"])?$data["username"]:null);
        $this->password=(isset($data["password"])?$data["password"]:null);
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
                'name'=>'username',
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
                'name'=>'password',
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
