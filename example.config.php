<?php
/*
config.php - DFTBQuotes configuration file
Copyright 2012, Dimitri Molenaars (tyrope.nl)
Licensed under the GNU General Public License

More info:
* https://github.com/elad661/DFTBQuotes
*/

//MySQL stuff
$conf['sql_server'] = "localhost"; //MySQL server to connect to. (In most cases this is 'localhost')
$conf['sql_user'] = ""; //MySQL username
$conf['sql_pass'] = ""; //MySQL password
$conf['sql_db'] = "dftbquotes"; //MySQL database
$conf['sql_tbl_prefix'] = "dftbq_"; //Prefixes to add to the table names.
$conf['theme'] = "default"; //Active theme
$cong['captcha_enable'] = "TRUE"; //Enable reCAPTCHA
$cong['captcha_pubkey'] = "0000000000000000000000000000000000000000"; //reCAPTCHA Public Key (Generate At http://dft.ba/-createcapt)
$cong['captcha_prikey'] = "0000000000000000000000000000000000000000"; //reCAPTCHA Private Key (Generate At http://dft.ba/-createcapt)

?>

