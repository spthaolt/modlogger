<?php

/**
* 
*/
class MODLOGGER_CLASS_Database
{
  private $originalClassInstance;
  private $trackFunctions = array(
    'queryForColumn',
    'queryForObject',
    'queryForObjectList',
    'queryForRow',
    'queryForList',
    'queryForColumnList',
    'query',
    'delete',
    'insert',
    'update',
    'insertObject',
    'updateObject',
    'batchInsertOrUpdateObjectList',
  );
  
  public static function dbInject() {
    $params = array(
      'host' => OW_DB_HOST,
      'username' => OW_DB_USER,
      'password' => OW_DB_PASSWORD,
      'dbname' => OW_DB_NAME
    );
    if ( defined('OW_DB_PORT') && (OW_DB_PORT !== null) ) {
      $params['port'] = OW_DB_PORT;
    }
    if ( defined('OW_DB_SOCKET') ) {
      $params['socket'] = OW_DB_SOCKET;
    }

    if( OW_DEV_MODE || OW_PROFILER_ENABLE ) {
      $params['profilerEnable'] = true;
    }

    if( OW_DEBUG_MODE ) {
      $params['debugMode'] = true;
    }

    ksort($params); $connectionKey = serialize($params);

    $class = new ReflectionClass('OW');
    $property = $class->getProperty( 'dboInstance' );

    $property->setAccessible( true );
    $property->setValue( new MODLOGGER_CLASS_Database( $params ) );
    $property->setAccessible( false );
  }

  public function __construct( $params )
  {
      $this->originalClassInstance = OW::getDbo();
  }

  public function __call( $method, $args ) {
      if ( !method_exists( $this, $method ) ) {
        if (in_array($method, $this->trackFunctions)) {
          // TODO
        }
        return call_user_func_array( array( $this->originalClassInstance, $method ), $args );
      } else {
        return call_user_func_array( array( $this, $method ), $args );
      }
  }

  public function __get( $name ) {
      $class = new ReflectionClass( 'OW_Database' );
      $property = $class->getProperty( $name );

      $property->setAccessible( true );
      return $property->getValue( $this->originalClassInstance );
  }

}