<?php
/*Copyright (C) 2013  thaolt@songphi.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

// raw log file location: ow_pluginfiles/modlogger/log.raw
define('MODLOGGER_FILE_RAWLOG', OW::getPluginManager()->getPlugin('modlogger')->getPluginFilesDir().DS.'raw.log');

// drug injection
MODLOGGER_BOL_Service::dbInject();

// drawing routes for deers
OW::getRouter()->addRoute(new OW_Route('modlogger.admin', 'admin/modlogger', 'MODLOGGER_CTRL_Admin', 'logViewer'));
OW::getRouter()->addRoute(new OW_Route('modlogger.admin_logViewer', 'admin/modlogger/logViewer', 'MODLOGGER_CTRL_Admin', 'logViewer'));
OW::getRouter()->addRoute(new OW_Route('modlogger.admin_rules', 'admin/modlogger/rules', 'MODLOGGER_CTRL_Admin', 'trackingRules'));
OW::getRouter()->addRoute(new OW_Route('modlogger.admin_help', 'admin/modlogger/help', 'MODLOGGER_CTRL_Admin', 'help'));

