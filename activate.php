<?php

$adminMenu = new BOL_MenuItem();

$adminMenu->prefix = 'admin';
$adminMenu->key = 'sidebar_menu_item_permission_modlogger';
$adminMenu->type = 'admin_privacy';
$adminMenu->routePath = 'modlogger.admin';
$adminMenu->visibleFor = 2;
$adminMenu->order = 4;

BOL_NavigationService::getInstance()->saveMenuItem($adminMenu);