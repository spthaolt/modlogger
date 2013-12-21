<?php

/**
* 
*/
class MODLOGGER_CTRL_Admin extends ADMIN_CTRL_Abstract
{
  public function onBeforeRender() {
    if ( OW::getRequest()->isAjax() )
      return;
    $this->addMenuComponent();
    $this->setPageHeading( OW::getLanguage()->text( 'modlogger', 'title_modlogger' ) );
    $this->setPageHeadingIconClass( 'ow_ic_gear' );
    OW::getDocument()->addStyleSheet(MODLOGGER_BOL_Service::getPlugin()->getStaticCssUrl().'admin.css');
    OW::getDocument()->addOnloadScript("
      \$('<span id=\"heading-version\">".MODLOGGER_BOL_Service::getVersion()."</span>').insertAfter($('.ow_page > h1'));
    ");
    OW::getDocument()->addOnloadScript("
      \$('<ul id=\"btn-enter-license\" class=\"ow_bl\"><li><a href=\"#\" class=\"ow_mild_red\">Enter License</a></li></ul>').insertAfter($('.ow_page > h1'));
    ");
  }

  function logViewer() {
    
  }

  function trackingRules() {
    
  }

  function help() {
    
  }

  function addMenuComponent() {
    $language = OW::getLanguage();
    $menuItems = array();

    $item = new BASE_MenuItem();
    $item->setLabel( $language->text( 'modlogger', 'admin_menu_logviewer' ) );
    $item->setUrl( OW::getRouter()->urlForRoute( 'modlogger.admin' ) );
    $item->setKey( 'general' );
    $item->setIconClass( 'ow_ic_moderator' );
    $item->setOrder( 0 );
    $menuItems[] = $item;

    $item = new BASE_MenuItem();
    $item->setLabel( $language->text( 'modlogger', 'admin_menu_rules' ) );
    $item->setUrl( OW::getRouter()->urlForRoute( 'modlogger.admin_rules' ) );
    $item->setKey( 'about' );
    $item->setIconClass( 'ow_ic_gear_wheel' );
    $item->setOrder( 1 );
    $menuItems[] = $item;

    $item = new BASE_MenuItem();
    $item->setLabel( $language->text( 'modlogger', 'admin_menu_help' ) );
    $item->setUrl( OW::getRouter()->urlForRoute( 'modlogger.admin_help' ) );
    $item->setKey( 'about' );
    $item->setIconClass( 'ow_ic_help' );
    $item->setOrder( 2 );
    $menuItems[] = $item;

    $menu = new BASE_CMP_ContentMenu( $menuItems );
    $this->addComponent( 'menu', $menu );
  }
}