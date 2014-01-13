<?php


namespace Auth\Model\Entity;
use Auth\Model\PropertyName;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;

/**
 * Description of LoginHelp
 *
 * @author victor
 */
class LoginHelp extends AbstractUserEntity{
    
    
   
   public function exchangeArray($data){
       $this->user_email=(isset($data[PropertyName::USER_EMAIL]))? $data[PropertyName::USER_EMAIL] : null;
   }
   
   public function getArrayCopy(){
       return get_object_vars($this);
   }
   
   public function getInputFilter() {
      if($this->inputFilter==null)
      {
          $inputFilter= new InputFilter();
          $inputFilter->add(array(
              'name'=>  PropertyName::USER_EMAIL,
              'required'=>true,
              
              'validator'=>array(
                  array(
                      'name'=>'StringLength',
                      'options'=>array(
                          'encoding'=>'UTF-8',
                          'max'=>100,
                          'min'=>6
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
                  array('name'=>'StripTags'),
                  array('name'=>'StringTrim')
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
