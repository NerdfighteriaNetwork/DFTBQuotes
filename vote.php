<?php /*
vote.php - DFTBQuotes vote loging
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

Vote.php Submits user's vote via the post parameters: quote_id, and post element with name of either "up" or "down" depending. 
1.0.0 Supports limiting to 1 vote via IP address, updating user's vote, keeping a running tally of votes per quote, and a simple textual display.

More info: https://github.com/elad661/DFTBQuotes 
*/

require("config.php");
//connect to db
require_once("inc/connect.php");

//header here

$user_ip = $_SERVER['REMOTE_ADDR']; //the end user's IP address
$allow_post = TRUE;
$posted=FALSE;

if(isset($_POST['quote_id'])){
	//insert vote into database
	$quote_id = $_POST['quote_id'];
	
	if(isset($_POST['up'])){
		$score_mod = 1;
		$is_positive = TRUE;
	}
	else if(isset($_POST['down'])){
		$score_mod = -1; 
		$is_positive = FALSE;
	}
}
else{echo "Error: No quote specified."; $allow_post=FALSE;}

if($allow_post){
	$prev_vote = mysql_query("SELECT * FROM ".$conf['sql_tbl_prefix']."votes WHERE IP='$user_ip' AND quotes_quoteID='$quote_id'");
	if(!mysql_num_rows($prev_vote)){ //if the user has not made a previous vote, let them vote. 
		$query = mysql_query("INSERT INTO ".$conf['sql_tbl_prefix']."votes (positive, IP, quotes_quoteID) VALUES($is_positive, '$user_ip', '$quote_id')");
		if($query){$posted = TRUE;} 
	}
	else{ //if user has voted before but is changing their vote, update their vote
		$prev_vote = mysql_fetch_array($prev_vote);
		if($prev_vote['positive']!=$is_positive){
			$query = mysql_query("UPDATE ".$conf['sql_tbl_prefix']."votes SET positive='$is_positive' WHERE IP='$user_ip' AND quotes_quoteID='$quote_id'");
			if($query){$posted = TRUE;} 
		}
		
		else {
			echo "Naughty, naughty! You can&apos;t vote more than once. ";
		}	
	}
}

//total and post number of votes
if($posted){
	$vote_tally_exists = mysql_query("SELECT score FROM ".$conf['sql_tbl_prefix']."totVotes WHERE quotes_quoteID=$quote_id");
	if(mysql_num_rows($vote_tally_exists)){
		$cur_score = mysql_fetch_array($vote_tally_exists); $new_score = $cur_score['score']+$score_mod;
		mysql_query("UPDATE ".$conf['sql_tbl_prefix']."totVotes SET score=".$new_score." WHERE quotes_quoteID=$quote_id");
	}
	else{
		mysql_query("INSERT INTO ".$conf['sql_tbl_prefix']."totVotes (quotes_quoteID, score) VALUES($quote_id, ".$score_mod.")");
	}
	echo "Vote of ("; 
	if($is_positive){echo "+1";} else{echo "-1";}
	echo") recorded."; 
}
else {echo "Vote failed.";}

//footer here

mysql_close($link);
?>
