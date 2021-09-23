<?php 

defined ('_JEXEC') or die('resticted aceess');

$options 	= $displayData['options'];
$total_votes = 0;

foreach ($options as $key => $option) {
	$total_votes = $total_votes + $option->votes;
}

// output
$output = '<div class="sp-poll-result">';
foreach ($options as $value) {

	if($total_votes) {
		$percentage = round($value->votes/$total_votes, 2)*100;
	} else {
		$percentage = 0;
	}

	$output .= '<div class="sp-poll-resul-item">';
	$output .= '<p class="poll-info"><span class="poll-question">' . $value->poll . '</span><span class="poll-votes">' . $value->votes . ' Votes</span></p>';

	$output .= '<div class="progress">';

	$progress = ' progress-bar-default';
	if($percentage>60) {
		$progress = ' progress-bar-danger';
	} elseif($percentage>50) {
		$progress = ' progress-bar-warning';
	} elseif($percentage>40) {
		$progress = ' progress-bar-success';
	} elseif($percentage>30) {
		$progress = ' progress-bar-info';
	} elseif($percentage>20) {
		$progress = ' progress-bar-primary';
	}

	$output .= '<div class="progress-bar'. $progress .'" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: ' . $percentage . '%;">';
	$output .= $percentage . '%';
	$output .= '</div>';
	$output .= '</div>';

	$output .= '</div>';

	$total_vote[] = $value->votes;
}
$output .= '</div>';

echo $output;