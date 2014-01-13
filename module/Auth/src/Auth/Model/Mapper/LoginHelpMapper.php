<?php


namespace Auth\Model\Mapper;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Auth\Model\PropertyName;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\Reflection;
use Auth\Model\Entity\LoginHelp;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

/**
 * Description of LoginHelpMapper
 *
 * @author victor
 */
class LoginHelpMapper implements EventManagerAwareInterface {
    
    public $dbAdapter;
    
    /**
     *
     * @var Zend\EventManager\EventManager 
     */
    protected $eventManager;
    
    public function __construct(AdapterInterface $adapter) {
        $this->dbAdapter= $adapter;
    }
    
    public function resetLink($email){
        if($email==null)
            return;
        $data=null;
      $adapter= $this->dbAdapter; 
      $sql= new Sql($adapter,  PropertyName::USER_TABLE);
      $select= $sql->select();
      $select->where(array(PropertyName::USER_EMAIL=>$email));
      $statement=$sql->prepareStatementForSqlObject($select);
      $result=$statement->execute();
      if($result->isQueryResult() && $result instanceof ResultInterface)
      {
         
       $resultSet= new HydratingResultSet(new Reflection(),new LoginHelp());
       $resultSet->initialize($result);
       
        foreach ($resultSet as $user) {
           if($data==null)
            $data=$user;
    }
    if($data!=null)
    $this->getEventManager()->trigger("forgotPasswordMatch",$this,array('content'=>$data,'email'=>$email));
      }
      return $data;
    }
    
    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->addIdentifiers(array(
            get_called_class(),
        ));
        $this->eventManager=$eventManager;
    }

    public function getEventManager() {
        if($this->eventManager==null)
        {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }

}
