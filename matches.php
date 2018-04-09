<?php
require('Requests.php');
require('config.php');

$matchId = "cfa4e9bc-c270-439c-bc21-510adb065e58"; // paste a match id
$region = "pc-eu"; // same as in player.php

Requests::register_autoloader();
$headers = array(
    'Authorization' => $apiKey,
    'Accept' => 'application/vnd.api+json'
);
$getMatch = Requests::get('https://api.playbattlegrounds.com/shards/'.$region.'/matches/'.$matchId.'', $headers);

$getMatchContent = json_decode($getMatch->body, true);

/* general stats from the match */
$type = $getMatchContent['data']['type'];
$matchId = $getMatchContent['data']['id'];
$createdAt  = $getMatchContent['data']['attributes']['createdAt'];
$duration = $getMatchContent['data']['attributes']['duration'];
$gameMode = $getMatchContent['data']['attributes']['gameMode'];
$mapName = $getMatchContent['data']['attributes']['mapName'];
$patchVersion = $getMatchContent['data']['attributes']['patchVersion'];
$shardId = $getMatchContent['data']['attributes']['shardId'];
$stats = $getMatchContent['data']['attributes']['stats'];
$tags = $getMatchContent['data']['attributes']['tags'];
$titleId = $getMatchContent['data']['attributes']['titleId'];


/* player stats from the match */
$playerId = "account.36250db7a9664f1d8faa8c6148d573b0"; // specified player for "Specified Player"

$countPlayers = count($getMatchContent['included']) + 1;

$i=0;
while($countPlayers > $i) {
	if($getMatchContent['included'][$i]['type'] == "participant") {
		if($getMatchContent['included'][$i]['attributes']['stats']['playerId'] == $playerId) {
			$id = $getMatchContent['included'][$i]['id'];
			$actor = $getMatchContent['included'][$i]['attributes']['actor'];
			$shardId = $getMatchContent['included'][$i]['attributes']['shardId'];
			$DBNOs = $getMatchContent['included'][$i]['attributes']['stats']['DBNOs'];
			$assists = $getMatchContent['included'][$i]['attributes']['stats']['assists'];
			$boosts = $getMatchContent['included'][$i]['attributes']['stats']['boosts'];
			$damageDealt = $getMatchContent['included'][$i]['attributes']['stats']['damageDealt'];
			$deathType = $getMatchContent['included'][$i]['attributes']['stats']['deathType'];
			$headshotKills = $getMatchContent['included'][$i]['attributes']['stats']['headshotKills'];
			$heals = $getMatchContent['included'][$i]['attributes']['stats']['heals'];
			$killPlace = $getMatchContent['included'][$i]['attributes']['stats']['killPlace'];
			$killPoints = $getMatchContent['included'][$i]['attributes']['stats']['killPoints'];
			$killPointsDelta = $getMatchContent['included'][$i]['attributes']['stats']['killPointsDelta'];
			$killStreaks = $getMatchContent['included'][$i]['attributes']['stats']['killStreaks'];
			$kills = $getMatchContent['included'][$i]['attributes']['stats']['kills'];
			$lastKillPoints = $getMatchContent['included'][$i]['attributes']['stats']['lastKillPoints'];
			$lastWinPoints = $getMatchContent['included'][$i]['attributes']['stats']['lastWinPoints'];
			$longestKill = $getMatchContent['included'][$i]['attributes']['stats']['longestKill'];
			$mostDamage = $getMatchContent['included'][$i]['attributes']['stats']['mostDamage'];
			$name = $getMatchContent['included'][$i]['attributes']['stats']['name'];
			$playerId = $getMatchContent['included'][$i]['attributes']['stats']['playerId'];
			$revives = $getMatchContent['included'][$i]['attributes']['stats']['revives'];
			$rideDistance = $getMatchContent['included'][$i]['attributes']['stats']['rideDistance'];
			$roadKills = $getMatchContent['included'][$i]['attributes']['stats']['roadKills'];
			$teamKills = $getMatchContent['included'][$i]['attributes']['stats']['teamKills'];
			$timeSurvived = $getMatchContent['included'][$i]['attributes']['stats']['timeSurvived'];
			$vehicleDestroys = $getMatchContent['included'][$i]['attributes']['stats']['vehicleDestroys'];
			$walkDistance= $getMatchContent['included'][$i]['attributes']['stats']['walkDistance'];
			$weaponsAcquired = $getMatchContent['included'][$i]['attributes']['stats']['weaponsAcquired'];
			$winPlace = $getMatchContent['included'][$i]['attributes']['stats']['winPlace'];
			$winPoints = $getMatchContent['included'][$i]['attributes']['stats']['winPoints'];
			$winPointsDelta = $getMatchContent['included'][$i]['attributes']['stats']['winPointsDelta'];

		}
	}
	$i++;
}
?>

<h1>General Stats</h1>
<span>type: <?php echo $type; ?></span><br />
<span>matchId: <?php echo $matchId; ?></span><br />
<span>duration: <?php echo $duration; ?></span><br />
<span>gameMode: <?php echo $gameMode; ?></span><br />
<span>mapName: <?php echo $mapName; ?></span><br />
<span>patchVersion: <?php echo $patchVersion; ?></span><br />
<span>shardId: <?php echo $shardId; ?></span><br />
<span>stats: <?php echo $stats; ?></span><br />
<span>tags: <?php echo $tags; ?></span><br />
<span>titleId: <?php echo $titleId; ?></span><br />

<h1>Specified Player</h1>
<span>id: <?php echo $id; ?></span><br />
<span>actor: <?php echo $actor; ?></span><br />
<span>shardId: <?php echo $shardId; ?></span><br />
<span>DBNOs: <?php echo $DBNOs; ?></span><br />
<span>assists: <?php echo $assists; ?></span><br />
<span>boosts: <?php echo $boosts; ?></span><br />
<span>damageDealt: <?php echo $damageDealt; ?></span><br />
<span>deathType: <?php echo $deathType; ?></span><br />
<span>headshotKills: <?php echo $headshotKills; ?></span><br />
<span>heals: <?php echo $heals; ?></span><br />
<span>killPlace: <?php echo $killPlace; ?></span><br />
<span>killPoints: <?php echo $killPoints; ?></span><br />
<span>killPointsDelta: <?php echo $killPointsDelta; ?></span><br />
<span>killStreaks: <?php echo $killStreaks; ?></span><br />
<span>kills: <?php echo $kills; ?></span><br />
<span>lastKillPoints: <?php echo $lastKillPoints; ?></span><br />
<span>killStreaks: <?php echo $killStreaks; ?></span><br />
<span>lastWinPoints: <?php echo $lastWinPoints; ?></span><br />
<span>longestKill: <?php echo $longestKill; ?></span><br />
<span>mostDamage: <?php echo $mostDamage; ?></span><br />
<span>name: <?php echo $name; ?></span><br />
<span>playerId: <?php echo $playerId; ?></span><br />
<span>revives: <?php echo $revives; ?></span><br />
<span>rideDistance: <?php echo $rideDistance; ?></span><br />
<span>roadKills: <?php echo $roadKills; ?></span><br />
<span>teamKills: <?php echo $teamKills; ?></span><br />
<span>timeSurvived: <?php echo $timeSurvived; ?></span><br />
<span>vehicleDestroys: <?php echo $vehicleDestroys; ?></span><br />
<span>walkDistance: <?php echo $walkDistance; ?></span><br />
<span>weaponsAcquired: <?php echo $weaponsAcquired; ?></span><br />
<span>winPlace: <?php echo $winPlace; ?></span><br />
<span>winPoints: <?php echo $winPoints; ?></span><br />
<span>winPointsDelta: <?php echo $winPointsDelta; ?></span><br />