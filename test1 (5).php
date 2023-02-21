<?php

session_start();

//$_SESSION['c'] = [];	

$_SESSION['c'][] += time();

print_r( $_SESSION['c'] );

?>