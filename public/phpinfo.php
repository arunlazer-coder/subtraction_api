<?php 

$value = 'project';
$position = 1;
$count = 2;

if (strlen($value) > $position && strlen($value) > $position+$count) {
    $b = str_split($value);

    $position = $position-1;

    $position_value = array( $b[$position] );

    unset($b[$position]);

    $new_position = $position + $count;

    array_splice($b, $new_position, 0, $position_value);

    $answer = implode('', $b);

    print_r($answer);
}
else{
    echo 'invalid ';
}




