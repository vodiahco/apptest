<?php
namespace Auth\Model\Mapper;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Auth\Model\Entity\Register;


/**
 * Description of RegisterMapper
 *
 * @author victor
 */
class RegisterMapper {
   
   public $tableGateway;
   
   public function __construct(AdapterInterface $adapter) {
       $resultSetPrototype=new ResultSet();
       $resultSetPrototype->setArrayObjectPrototype(new Register()); 
       $this->tableGateway= new TableGateway("tnb_users", $adapter, null, $resultSetPrototype);
   }
   
   
   public function register(Register $register){
    $data=$register->getInflatedArray();
    $this->tableGateway->insert($data);
   }
}
