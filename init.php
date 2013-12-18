<?php

// drug injection
MODLOGGER_BOL_Service::dbInject(); 

OW::getEventManager()->bind( 'core.after_master_page_render', array( 'MODLOGGER_BOL_Service', 'collectLogs' ) );