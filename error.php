<?php /*
error.php - DFTBQuotes error pages
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

More info: https://github.com/elad661/DFTBQuotes 
 */


//load file
if(file_exists('themes/'.$conf['theme'].'/errors.htm')){
    $content = new TemplatePower('themes/'.$conf['theme'].'/errors.htm');
}else{
    $content = new TemplatePower('themes/default/errors.htm');
}
//prepare file for modification
$content->prepare();

/* display proper error block.
Error codes:
 1 Invalid Page ID. (404)
 2 Authentication required. (401)
 3 Account not authorized. (403)
*/
switch($ERR_ID){
    case 1:
	$content->newBlock('ERROR_404');
	$content->assign('PID',$_GET['pid']);
	break;
    case 2:
	$content->newBlock('ERROR_401');
	$content->assign('PID',$_GET['pid']);
	break;
    case 3:
	$content->newBlock('ERROR_403');
	$content->assign('PID',$_GET['pid']);
	break;
    default:
	//no error speficied, or invalid error ID, show general 'something went wrong' error.
	$content->newBlock('ERROR_400');
	break;
    //end switch
}
?>
