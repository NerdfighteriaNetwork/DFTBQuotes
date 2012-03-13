<?php

function parseQuoteLine($input){
    //remove timestamp
    $input_notime = preg_replace('/^[\[\(]*\d+[:]*\d*[:]*\d*[\]\)]*( |\t)*/', '', $input);

    //what type of objects are there?
    $nickname = '[~&@%+]?(?:[A-z[\]{}`^_\\|][A-z0-9[\]{}`^_\\|-]{0,29})';
    $ident = '[A-z0-9\-_\.]{1,10}';
    $host = '[A-z0-9]+[:\.]+[A-z0-9]+(?:[:\.]+|[A-z0-9]+)+';
    $channel = '#(?:[A-z0-9~!@#\$%\^&\*()_\+`\-=[{}\|\'";\./\\\<>\?]|])*';

    //While matching, make sure you specify if you want to catch the part first!
    // '('.$part.')' == catch
    // '(?:'.$part.')' == don't catch
    //join
    if(preg_match('/(?:|* |-!- |== |*** )?('.$nickname.') (?:([|(|)(?:'.$ident.')@(?:'.$host.')(]|\)|)|) (?:has |)joined ('.$channel.')/', $input_notime, $matches) || 
	preg_match('/(?:|*** )('.$nickname.') joined ('.$channel.') (?:'.$ident.')@(?:'.$host.')/', $input_notime, $matches)){
	$parsed = $matches[1].' joined '.$matches[2];
    }else{
	$parsed = $input_notime; //temp
    }
    return $parsed;
}

function parseQuote($input){
    //split input by line.
    $raw_arr = preg_split('/$\R?^/m', $input);

    //put each line into the parser
    $parsed = array();
    foreach($raw_arr as $line){
	$parsed[] = parseQuoteLine(rtrim($line));
    }
    $output = implode($parsed,"\n");
    return $output;
}

require_once('config.php');
if($conf['debug']){
    if(isset($_POST['text'])){
        $raw = $_POST['text'];
	$parsed = parseQuote($raw);
	?>
	<form action="?" method="post">
	    <fieldset>
		<table>
		    <tr>
			<th><label for="raw">Raw input:</label></th>
			<th><label for="parsed">Parsed Output:</label></th>
		    </tr><tr>
			<td>
			    <textarea readonly="readonly" name="raw" rows="20" cols="100"><?php echo $raw; ?></textarea>
			</td>
			<td>
			    <textarea readonly="readonly" name="parsed" rows="20" cols="100"><?php echo $parsed; ?></textarea>
			</td>
		    </tr>
		</table>
	    </fieldset>
	</form>
	<?php
    }
    ?>
    <form action="?" method="post">
	<fieldset>
	    <textarea name="text" rows="20" cols="100"></textarea><br />
	    <input type="submit" />
	</fieldset>
    </form>
    <?php
}
?>
