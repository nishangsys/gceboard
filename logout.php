
<?php
include 'includes/functions.php';
// Turn off all error reporting
error_reporting(0);
session_start();
$name=$_SESSION['user_name'];
	$date=date('d-m-Y');
	$time=date('G:i');
			

session_destroy();


		//	echo '<meta http-equiv="Refresh" content="0; url=index.php?logout=Your have successfuly logged out">';


echo "<script>window.open('login.php?logout=Your have successfuly logged out ','_self')</script>";

backup_tables('localhost','u182156984_stlouisapp','Cpadmin@123','u182156984_stlouisapp');;
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*') {
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result)) {
			$tables[] = $row[0];
		}
	} else {
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}	
	//cycle through
	foreach($tables as $table) {
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);		
		//$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) {
			while($row = mysql_fetch_row($result)) {
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) {
					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	if(!is_dir("backup")) {
		mkdir("backup",0777);
	}
	
	$handle = fopen('./backup/db-backup-'.date('d-m-Y').'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

logout();


?>