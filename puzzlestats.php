<?php
	require_once "config.php";
	require_once "html.php";
	require_once "db-func.php";
	require_once "utils.php";

	// Redirect to the login page, if not logged in
	$uid = isLoggedIn();
			
	// Start HTML
	head("puzzlestats");
	
	if (isBlind($uid)) {
		echo '<h3>This page may contain spoilers</h3>';
		foot();
	}

	echo '<h1 style="margin-top: 0em; margin-bottom: 0em;">Puzzle Status Numbers</h1>';
	echo '<table>';
	
	$completed = array(8, 13, 6);
	makeStatusTable($completed, 'Completed Puzzles', 'complete-stats');
	
	$written = array(2, 12);
	makeStatusTable($written, 'Fact Check / Revision', 'writing-stats');
	
	$testing = array(18, 17, 4, 7, 5);
	makeStatusTable($testing, 'Testing', 'testing-stats');
	
	$ideas = array(1);
	makeStatusTable($ideas, 'Development', 'pending-stats');
	
	$dead = array(9, 10, 16);
	makeStatusTable($dead, 'Dead / Admin', 'dead-stats');
	
	echo '</table>';
	
	foot();

function makeStatusTable($arr, $name, $class)
{
	$count = 0;

	foreach ($arr as $status) {
		$puzzles = getPuzzlesWithStatus($status);
		$number = count($puzzles);
		$count += $number;
	}

		
	echo "<tr><th colspan='2' class='$class'>$name: $count</th></tr>";
	foreach ($arr as $status) {
		$puzzles = getPuzzlesWithStatus($status);
		$statusName = getPuzzleStatusName($status);
		$number = count($puzzles);

		if ($number > 0)
			echo "<tr><td class='$class'>$number</td><td class='$class'>$statusName</td></tr>";
			
	}
	
	if ($count == 0)
		echo "<tr><td colspan='2' class='$class'>(no puzzles)</td></tr>";
}	
	
?>
