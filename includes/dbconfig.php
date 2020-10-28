<?php

/**
 * @author mohamed hussein
 * @copyright 2017
 */

//enable output buffer


//start session
session_start();


//database credentials

define('DBHOSTNAME','localhost');
define('DBUSERNAME','root');
define('DBPASSWORD','root');
define('DBNAME','appstore');

//connet to mysql database
//$conn=mysql_connect(DBHOSTNAME,DBUSERNAME,DBPASSWORD) or die('connection to database failed due to '.mysql_error());
//select required database
//$conn=mysql_select_db(DBNAME)or die('selecting database failed due to '.mysql_error());

$mysqli =new mysqli(DBHOSTNAME,DBUSERNAME,DBPASSWORD,DBNAME);

?>