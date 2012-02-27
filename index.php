<?php /*
index.php - DFTBQuotes template/page loader
Copyright (C) 2012 Dimitri Molenaars (tyrope.nl) <tyrope@tyrope.nl>

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

index.php loads in the active template, and decides which pages should be displayed.
it also handles any errors that should be displayed, should they be displayed.

More info: https://github.com/elad661/DFTBQuotes 
 */

/* Error codes:
 0 No error.
 1 Invalid Page ID.
*/

require_once('inc/header.php');
require_once('inc/menu.php');
require_once('inc/connect.php');

if(isset($_GET['pid'])){
    //Load page ID, check if page is valid.
    if(!is_int($_GET['pid'])){
	$ERR_ID = 1;
    }else{
	//ask database if page exists
	$result = mysql_query("SELECT page, folder, auth FROM ".$conf['sql_tbl_prefix']."pages WHERE pageID='".$_GET['pid']."' LIMIT 1");
	if(mysql_num_rows($result) > 0){
	    $data = mysql_fetch_assoc($result);
	    $fileName = $data['folder'].$data['page'];
	    if($data['auth']){
		//authorization required.
		if(!isset($_SESSION['loggedIn'])){
		    //not logged in.
		    if(file_exists('themes/'.$conf['theme'].'/accessDenied.htm')){
			$content = new TemplatePower('themes/'.$conf['theme'].'/accessDenied.htm');
		    }else{
			$content = new TemplatePower('themes/default/accessDenied.htm');
		    }
		}elseif($_SESSION['loggedIn'] < $data['auth']){
		    //account not enough access.
		    if(file_exists('themes/'.$conf['theme'].'/accessDenied.htm')){
			$content = new TemplatePower('themes/'.$conf['theme'].'/accessDenied.htm');
		    }else{
			$content = new TemplatePower('themes/default/accessDenied.htm');
		    }
		}else{
		    //authorization accepted.
		    if(file_exists('themes/'.$conf['theme'].'/'.$fileName)){
			$content = new TemplatePower('themes/'.$conf['theme'].'/'.$fileName);
		    }else{
			$content = new TemplatePower('themes/default/'.$fileName);
		    }
		}
	    }else{
		//no authorization needed.
		if(file_exists('themes/'.$conf['theme'].'/'.$fileName)){
		    $content = new TemplatePower('themes/'.$conf['theme'].'/'.$fileName);
		}else{
		    $content = new TemplatePower('themes/default/'.$fileName);
		}
	    }
	}
    }
}else{
    // Load default page
    if(file_exists('themes/'.$conf['theme'].'/quotes.htm')){
	$content = new TemplatePower('themes/'.$conf['theme'].'/quotes.htm');
    }else{
	$content = new TemplatePower('themes/default/quotes.htm');
    }
}

// Should an error be displayed?
if(isset($ERR_ID)){
    $content->newBlock("ERROR_".$ERR_ID);
    $content->assign("PID",$_GET['pid']);
    $content->prepare();
}
$content->prepare();

require_once('inc/footer.php');
mysql_close($link);
?>
