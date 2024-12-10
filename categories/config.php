<?php
$connection = new mysqli ("localhost","root","","e-project");

if ($connection -> connect_error){
die ("Connection failed : " . $connection -> connect_error);

};
?>