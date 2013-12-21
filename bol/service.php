<?php

/**
* 
*/
class MODLOGGER_BOL_Service 
{
  protected static $classInstance = null;
  protected static $currentRoute = null;

  public static function getPlugin() {
    return OW::getPluginManager()->getPlugin('modlogger');
  }

  public static function getInstance() {
    if ( !( self::$classInstance instanceof MODLOGGER_BOL_Service ) ) {
      self::$classInstance = new self();
    }
    return self::$classInstance;
  }

  protected function __construct() {
    self::$currentRoute = self::getRoute();
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
    if (!self::isRoute('BASE_CTRL_Ping')) {
      var_dump(self::getVersion());
      flush();ignore_user_abort();
      file_put_contents(MODLOGGER_FILE_RAWLOG, base64_encode(serialize(OW::getDbo()->getQueryLog()))."\n", FILE_APPEND | LOCK_EX);
    }
  }

  public static function getVersion($build = null) {
    if (!$build)
      $build = self::getPlugin()->getDto()->getBuild();

    $major = intval(substr($build, 0, 2+(strlen($build)-6)));
    $minor = intval(substr($build, strlen($major), 2));
    $updates = intval(substr($build, -2));
    return "{$major}.{$minor}.{$updates}";
  }

  public static function getRoute() {
    try {
      return OW::getRouter()->route();
    } catch ( Exception $e ) {
      return false;
    }
  }

  public static function isRoute( $controller, $action = null ) {
    $route = self::$currentRoute;

    if ( !$route )
      return false;

    if ( $route["controller"] == $controller ) {
      if ( empty($action) || $route["action"] == $action ) {
        return true;
      }
    }
    return false;
  }
}