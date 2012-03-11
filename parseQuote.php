<?php

function parseQuoteLine($input){
    //remove timestamp
    $input_notime = preg_replace('/^[\[\(]*\d+[:]*\d*[:]*\d*[\]\)]*( |\t)*/', '', $input);

    //is this a join, part or quit?
    preg_match('(join|left|quit)', $input_notime, $matches);

    switch($matches){
	case 'join':
	    $parsed = 'JOIN'."\n".$input_notime; //temp
	    break;
	case 'left':
	    $parsed = 'PART'."\n".$input_notime; //temp
	    break;
	case 'quit':
	    $parsed = 'QUIT'."\n".$input_notime; //temp
	    break;
	default:
	    $parsed = 'MSG/ACTION'."\n".$input_notime; //temp
	    break;
	//end switch
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
	    <textarea name="text"></textarea><br />
	    <input type="submit" />
	</fieldset>
    </form>
    <?php
}
?>
