<?php
include("config.php");

$surnames = [
	"kalepu", "perudi", "perni", "gandham", "dharanikota", "vantulu", "doddi", "allaka", "inumarti", "gottam", "penta", "vunnada", "poyava", "chachava"
];
$names = [
	"kumar", "lakshmi", "sannasi", "ekalingam", "baburao", "gurubabu", "appanna", "pullarao", "suranna", "sambulingam", "tingara rao", "muripala rao"
];
$ends = [
	"rao", "reddy", "chowdary", "naidu", "sarma", "verma", "kumar", "singh", "raj", "jain"
];

for($i=0;$i<100;$i++){

	$name = $surnames[ rand(0,sizeof($surnames)-1) ] . ' ' . $names[ rand(0,sizeof($names)-1) ] . ' ' . $ends[ rand(0,sizeof($ends)-1) ];

	$query = "insert into users set 
	name = '" . $name . "',
	dob = '" . date("Y-m-d", time()-(86400*(365*rand(15,50)) )  ) . "',
	gender = '" . (rand(1,2)?'male':'female') . "',
	email = '" . str_replace(" ", "", $name )."@gmail.com" . "',
	mobile = '" . time() . "',
	username = '" . str_replace(" ", "", $name ) . "',
	password = '" . md5("tempsomething") . "' ";

	echo '<div>'. $query . "</div>";

	mysqli_query( $con, $query );
}

?>