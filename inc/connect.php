<?php /*
connect.php - DFTBQuotes MySQL connector
Copyright (C) 2012 Ahren Bader-Jarvis <djahren@djahren.com>

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

connect.php starts an SQL connection, should one be required.

More info: https://github.com/elad661/DFTBQuotes
 */

$link = mysql_connect($conf['sql_server'], $conf['sql_user'], $conf['sql_pass']);
if (!$link) {
    die('Could not connect: ' . mysql_error()); }
if (!mysql_select_db($conf['sql_db'], $link)) {
    echo 'Could not select database';
    exit;
}
?>
