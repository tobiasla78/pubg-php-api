<?php
require('Requests.php');
require('config.php');

$region = "pc-eu"; // choose platform and region
$players = "eXamplee"; // choose a player (ign)

Requests::register_autoloader();
$headers = array(
    'Authorization' => $apiKey,
    'Accept' => 'application/vnd.api+json'
);
$getPlayer = Requests::get('https://api.playbattlegrounds.com/shards/'.$region.'/players?filter[playerNames]='.$players.'', $headers);

$getPlayerContent = json_decode($getPlayer->body, true);

/* Player data */
$type = $getPlayerContent['data'][0]['type'];
$id = $getPlayerContent['data'][0]['id'];
$createdAt = $getPlayerContent['data'][0]['attributes']['createdAt'];
$name = $getPlayerContent['data'][0]['attributes']['name'];
$patchVersion = $getPlayerContent['data'][0]['attributes']['patchVersion'];
$shardId = $getPlayerContent['data'][0]['attributes']['shardId'];
$stats = $getPlayerContent['data'][0]['attributes']['stats'];
$titleId = $getPlayerContent['data'][0]['attributes']['titleId'];
$updatedAt = $getPlayerContent['data'][0]['attributes']['updatedAt'];


/* Last match from player */
$lastMatchId = $getPlayerContent['data'][1]['relationships']['matches'][0]['id']; // change 0 to 1 if you want to have the second recent match id...


/* Example view in browser */
?>
<span>type: <?php echo $type; ?></span><br />
<span>id: <?php echo $id; ?></span><br />
<span>createdAt: <?php echo $createdAt; ?></span><br />
<span>name: <?php echo $name; ?></span><br />
<span>patchVersion: <?php echo $patchVersion; ?></span><br />
<span>shardId: <?php echo $shardId; ?></span><br />
<span>stats: <?php echo $stats; ?></span><br />
<span>titleId: <?php echo $titleId; ?></span><br />
<span>updatedAt: <?php echo $updatedAt; ?></span><br />


<span><strong>last matches (id):</strong></span><br />
<?php
/* display all recent matches */
$recentMatches = count($getPlayerContent['data'][0]['relationships']['matches']['data']);
$i=0;
while($recentMatches > $i) {
    echo "<span>" . $getPlayerContent['data'][0]['relationships']['matches']['data'][$i]['id'] . "</span><br />";
    $i++;
}
?>

