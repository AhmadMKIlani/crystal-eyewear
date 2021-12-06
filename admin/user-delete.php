<?php
require "../includes/db.php";
$sql = $connection->prepare("DELETE FROM user WHERE id = {$_GET['id']}");
$sql->execute();
header ("location:users.php");