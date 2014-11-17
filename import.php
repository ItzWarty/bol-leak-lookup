<?php
require(dirname(__FILE__).'/include/.config.php');
require(dirname(__FILE__).'/data/BOL players - IP Redacted.php');
# ini_set('memory_limit', '512M');
set_time_limit (13333337);
$db = new PDO($web_config["PDO_DSN"], $web_config["PDO_USER"], $web_config["PDO_PASS"]);
$sql = "INSERT INTO players (id,username,summonername,ipaddress,region,counts,elo,date) VALUES (:id,:username,:summonername,:ipaddress,:region,:counts,:elo,:date)";
$q = $db->prepare($sql);
foreach($players as $player) {
   try {
      $q->execute(
         array(
            ':id'=>$player['ID'],
            ':username'=>$player['user'],
            ':summonername'=>$player['name'],
            ':ipaddress'=>$player['IP'],
            ':region'=>$player['region'],
            ':counts'=>$player['counts'],
            ':elo'=>$player['Elo'],
            ':date'=>$player['date'],
         )
      );
   } catch (Exception $e) {
      echo "error with player </br>";
      echo var_dump($player);
      echo var_dump($e);
   }
}
echo "imported </br>";

require(dirname(__FILE__).'/footer.php');
?>