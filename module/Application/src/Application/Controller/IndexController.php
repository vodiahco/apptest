<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
//        $sm= $this->getServiceLocator();
//        $db=$sm->get("Zend\Db\Adapter\Adapter");
//        $select=$db->query("select * from vinx_users");
//        print_r($select);
//        $adapter=new \Zend\Db\Adapter();
//        $authAdapter= new Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter($adapter);
       // $authAdapter->
        
        return new ViewModel();
    }
}
