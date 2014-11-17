<?php
if (!array_key_exists("user", $_POST)) {
   die("user not set in post data");
}
$user = $_POST["user"];
if (!isset($user) || trim($user)==='') {
   die("user must not be empty");
} // I have no clue what i'm doing in php

require(dirname(__FILE__).'/include/.config.php');

$db = new PDO($web_config["PDO_DSN"], $web_config["PDO_USER"], $web_config["PDO_PASS"]);
$sql = "SELECT * FROM `players` WHERE `username` like :user"; # yay internet
$q = $db->prepare($sql);
$q->execute(array(':user'=>$user));
$results = $q->fetchAll();
$any = false;
foreach ($results as $row) {
   echo $row["username"] . ' - ' . $row["ipaddress"] . ' :( <br/>';
   $any=true; //lol i have no clue what i'm doing
}
if (!$any) {
   echo "You're good! <br/>";
}
echo "<a href='./index.php'>try again</a></br>";
require(dirname(__FILE__).'/footer.php');
?>