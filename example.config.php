<?php /*

config.php - DFTBQuotes Configuration file
Copyright (C) 2012 Ahren Bader-Jarvis <djahren@djahren.com>
		   Dimitri Molenaars (tyrope.nl) <tyrope@tyrope.nl>

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

This file holds all the configurations needed for proper running of DFTBQuotes

More info: https://github.com/elad661/DFTBQuotes
*/

//MySQL stuff
$conf['sql_server'] = "localhost"; //MySQL server to connect to. (In most cases this is 'localhost')
$conf['sql_user'] = ""; //MySQL username
$conf['sql_pass'] = ""; //MySQL password
$conf['sql_db'] = "dftbquotes"; //MySQL database
$conf['sql_tbl_prefix'] = "dftbq_"; //Prefixes to add to the table names.
$conf['theme'] = "default"; //Active theme
$conf['captcha_enable'] = True; //Enable reCAPTCHA
$conf['captcha_pubkey'] = "0000000000000000000000000000000000000000"; //reCAPTCHA Public Key (Generate At http://dft.ba/-createcapt)
$conf['captcha_prikey'] = "0000000000000000000000000000000000000000"; //reCAPTCHA Private Key (Generate At http://dft.ba/-createcapt)

?>

