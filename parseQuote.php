<?php

function parseQuoteLine($input){
    //remove timestamp
    $input_notime = preg_replace(" ^[\[]*\d+[:]*\d*[:]*\d*[\]]* ", '', $input);
    $parsed = $input_notime;

    return $parsed; //for now
}

function parseQuote($input){
    //split input by line.
    $raw_arr = preg_split('/$\R?^/m', $input);
    var_dump($raw_arr);
    foreach($raw_arr as &$line) $line = rtrim($line);

    //put each line into the parser
    $parsed = array();
    foreach($text_arr as $line){
	$parsed += parseQuoteInput($line);
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
		<label for="raw">Raw input:</label>
		<textarea name="raw">
		    <?php echo $raw; ?>
	        </textarea>
		<textarea name="parsed">
		  <?php echo $raw; ?>
		</textarea>
	    </fieldset>
	</form>
	<?php
    }else{
	?>
        <form action="?" method="post">
	    <fieldset>
		<textarea name="text"></textarea><br />
	    <input type="submit" />
	    </fieldset>
	</form>
        <?php
    }
}
?>
