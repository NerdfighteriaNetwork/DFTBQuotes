<?php /*
footer.php - DFTBQuotes template footer loader
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

footer.php loads in the static footer of every page, and sends all parts of the template to the browser.

More info: https://github.com/elad661/DFTBQuotes 
 */

//prepare template navigation bar
if(file_exists('themes/'.$conf['theme'].'/footer.htm')){
    $footer = new TemplatePower('themes/'.$conf['theme'].'/footer.htm');
}else{ //fallback on default template if the file doesn't exist.
    $footer = new TemplatePower('themes/default/footer.htm');
}
$footer->prepare();

$header->printToScreen();
$menu->printToScreen();
$content->printToScreen();
$footer->printToScreen();
?>
