<?php 
defined("MAIN_DIR") ? null : define("MAIN_DIR", dirname(__DIR__));
defined("INCLUDES_DIR") ? null : define("INCLUDES_DIR", dirname(__FILE__));

require_once(INCLUDES_DIR."/db_config.php");

require_once(INCLUDES_DIR."/functions.php");

require_once(INCLUDES_DIR."/session.php");

require_once(INCLUDES_DIR."/database.php");

require_once(INCLUDES_DIR."/database_object.php");

require_once(INCLUDES_DIR."/pagination.php");
require_once(INCLUDES_DIR."/project.php");
require_once(INCLUDES_DIR."/member.php");
require_once(INCLUDES_DIR."/task.php");
require_once(INCLUDES_DIR."/daily_tracker.php");
?>