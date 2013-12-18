<?php

/**
* 
*/
class MODLOGGER_BOL_Service 
{
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

  public static function collectLogs() {
    var_dump(serialize(OW::getDbo()->getQueryLog()));
  }
}