<?php
namespace Auth\Helper\Listener;

/**
 * Description of SignupHelper
 *
 * @author victor
 */
class SignupHelper {
    
    
    /**
     * 
     * @param Zend\EventManager\EventManager $event
     */
    public static function onSignup($event){
        print_r($event->getParams());
        $thisObj=self::getSelf();
        $thisObj->sendWelcomeMail();
        $thisObj->sendActivationMail();
    }
    
    public static function onForgotPasswordMatch($event){
        print_r($event->getParams());
    }
    
    
    protected static function getSelf(){
        return new SignupHelper();
    }
    
    
    protected function sendWelcomeMail()
    {
        
    }
    
    protected function sendActivationMail()
    {
        
    }
}
