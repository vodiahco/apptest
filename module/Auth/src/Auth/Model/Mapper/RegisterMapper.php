<?php
namespace Auth\Model\Mapper;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Auth\Model\Entity\Register;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManager;
use Auth\Model\PropertyName;


/**
 * Description of RegisterMapper
 *
 * @author victor
 */
class RegisterMapper  implements EventManagerAwareInterface  {
   
   public $tableGateway;
   
   /**
    *
    * @var Zend\EventManager\EventManager
    */
   protected $eventManager;

   
   public function __construct(AdapterInterface $adapter) {
       $resultSetPrototype=new ResultSet();
       $resultSetPrototype->setArrayObjectPrototype(new Register()); 
       $this->tableGateway= new TableGateway(PropertyName::USER_TABLE, $adapter, null, $resultSetPrototype);
   }
   
   
   
   public function register(Register $register){
     
    $data=$register->getInflatedArray();
    $affectedRows=$this->tableGateway->insert($data);
    if($affectedRows>0)
    {
        $this->getEventManager()->trigger("signup",$this,array("content"=>$affectedRows));   
    }
    return $affectedRows;
   }
   
   
    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->addIdentifiers(array(
            get_called_class(),
        ));
        $this->eventManager=$eventManager;
    }

    public function getEventManager() {
        if($this->eventManager===null)
        {
            $this->setEventManager(New EventManager());
        }
        return $this->eventManager;
    }
}
