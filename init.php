<?php

// raw log file location: ow_pluginfiles/modlogger/log.raw
define('MODLOGGER_FILE_RAWLOG', OW::getPluginManager()->getPlugin('modlogger')->getPluginFilesDir().DS.'raw.log');

// drug injection
MODLOGGER_BOL_Service::dbInject();

// drawing routes for deers
OW::getRouter()->addRoute(new OW_Route('modlogger.admin', 'admin/modlogger', 'MODLOGGER_CTRL_Admin', 'logViewer'));
OW::getRouter()->addRoute(new OW_Route('modlogger.admin_logViewer', 'admin/modlogger/logViewer', 'MODLOGGER_CTRL_Admin', 'logViewer'));
OW::getRouter()->addRoute(new OW_Route('modlogger.admin_rules', 'admin/modlogger/rules', 'MODLOGGER_CTRL_Admin', 'trackingRules'));
OW::getRouter()->addRoute(new OW_Route('modlogger.admin_help', 'admin/modlogger/help', 'MODLOGGER_CTRL_Admin', 'help'));

