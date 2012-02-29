<?php
/*
install.php - DFTBQuotes easy installer script
Copyright (C) 2012 Jason Spriggs (jasonspriggs.com) <jason@jasonspriggs.com>
				   Ahren Bader-Jarvis (djahren.com) <djahren@djahren.com>

    This file is part of DFTBQuotes.

    DFTBQuotes is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    DFTBQuotes is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with DFTBQuotes.  If not, see <http://www.gnu.org/licenses/>.

install.php creates the table schema for DFTBQuotes and gathers basic information for the config.

More info: https://github.com/elad661/DFTBQuotes 
*/

require_once("config.php");
$errors = array();

//check to see if config.php has been filld out.
$count = 0;
foreach($conf as $conf_setting){if($conf_setting){$count++;}}
if($count!=sizeof($conf)){$errors[]="config.php is not properly configured. Please fill it out with your database information.";}

$link = mysql_connect($conf['sql_server'], $conf['sql_user'], $conf['sql_pass']);
if (!$link) {
    $errors[] = 'Could not connect to server: ' . mysql_error();
}

$install_fh = @fopen("install.sql", 'r');
if($install_fh){	
	$sql = fread($install_fh, filesize("install.sql"));
	
	$find = array("localhost", "dftbquotes", "dftbq_");
	$replace = array($conf['sql_server'], $conf['sql_db'], $conf['sql_tbl_prefix']);
	$sql = str_replace($find, $replace, $sql);
	
	$query=mysql_query($sql);
	if(!$query){$errors[]="The install query failed: ".mysql_error();}
	
	fclose($install_fh);
}
else{
	$errors[]= "Couldn't open install template. Make sure install.sql is in the same folder as install.php";
}
mysql_close($link);

if(!sizeof($errors)){ //if errors array contains no errors
	echo "Congratulations! DFTBQuotes is now installed!";		
}
else{ //erros occured, list errors
	echo "Sadpanda. DFTBQuotes failed to install. The following errors have occured: <br /><br />";
	foreach($errors as $error){
		echo $error." <br /><br />";
	}
}
?>