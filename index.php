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

More info: https://github.com/elad661/DFTBQuotes 
*/

require_once('inc/header.php');
require_once('inc/menu.php');

//This part will actually get the proper file from the database/an array.
$content = new TemplatePower('themes/'.$conf['theme'].'/quotes.htm');
$content->prepare();

require_once('inc/footer.php');

?>
