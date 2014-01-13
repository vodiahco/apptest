<?php

namespace Auth\Helper;

/**
 * Description of PropertyName
 * 
 * @author victor
 */
class RouteName {
    
   protected static $homeRoute="home";
    protected static $activationUrl="activate";
    protected static $loginUrl="login";
    protected static $registerUrl="register";
   
    
    
    public static function getHomeRoute() {
        return self::$homeRoute;
    }

    public static function getActivationUrl() {
        return self::$activationUrl;
    }

    public static function getLoginUrl() {
        return self::$loginUrl;
    }

    public static function getRegisterUrl() {
        return self::$registerUrl;
    }


}
