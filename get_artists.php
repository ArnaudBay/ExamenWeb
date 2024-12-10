<?php
require 'functions.php';
$artists = get_artists();
echo json_encode($artists);
?>
