<?php

/**
* 
*/
class MODLOGGER_BOL_Service 
{
  protected static $classInstance = null;

  public static function getInstance() {
    if ( !( self::$classInstance instanceof MODLOGGER_BOL_Service ) ) {
      self::$classInstance = new self();
    }
    return self::$classInstance;
  }

  public static function dbInject() {
    $dbo = &OW::getDbo();

    if (self::getDatabasePrivatePropertyValue($dbo,'isProfilerEnabled'))
      return;
    
    self::setDatabasePrivatePropertyValue($dbo,'isProfilerEnabled',true);
    self::setDatabasePrivatePropertyValue($dbo,'profiler',UTIL_Profiler::getInstance('db'));
    self::setDatabasePrivatePropertyValue($dbo,'queryCount',0);
    self::setDatabasePrivatePropertyValue($dbo,'queryExecTime',0);
    self::setDatabasePrivatePropertyValue($dbo,'totalQueryExecTime',0);
    self::setDatabasePrivatePropertyValue($dbo,'queryLog',array());

    self::getInstance();
  }

  protected static function setDatabasePrivatePropertyValue(&$obj, $propName, $value) {
    $dbClass = new ReflectionClass('OW_Database');
    $prop = $dbClass->getProperty($propName);
    $prop->setAccessible(true);
    $prop->setValue($obj, $value);
  }

  protected static function getDatabasePrivatePropertyValue($obj, $propName, $value) {
    $dbClass = new ReflectionClass('OW_Database');
    $prop = $dbClass->getProperty($propName);
    $prop->setAccessible(true);
    return $prop->getValue($dbo);
  }

  public function __destruct() {
    var_dump(serialize(OW::getDbo()->getQueryLog()));
  }
}