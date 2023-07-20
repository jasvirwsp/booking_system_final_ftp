<?php
global $staging;
if($staging == 0){ //Please change staging value in general_config.php
$mysql_db_hostname = "localhost";
$mysql_db_dbname = "renatas_booking";
$mysql_db_username = "root";
$mysql_db_password = "";
}
if($staging == 1){
$mysql_db_hostname = "localhost";
$mysql_db_dbname = "wspclien_renatas_booking";
$mysql_db_username = "wspclien_renatas";
$mysql_db_password = "#nokiaN95";
}

if($mysql_db_dbname == "" || $mysql_db_username == ""){
    echo "Please configure Database Settings in wsp_rad>config>db_config.php";
    exit();
}

require_once(__DIR__."/FluentPDO/FluentPDO.php");
$pdo = new PDO("mysql:dbname=$mysql_db_dbname;host:$mysql_db_hostname;","$mysql_db_username","$mysql_db_password");
$fpdo = new FluentPDO($pdo);


//Debugger
// $fpdo->debug = function($BaseQuery) {
//     echo "query: " . $BaseQuery->getQuery(false) . "<br/>";
//     echo "parameters: " . implode(', ', $BaseQuery->getParameters()) . "<br/>";
//     echo "rowCount: " . $BaseQuery->getResult()->rowCount() . "<br/>";  
// };


?>
