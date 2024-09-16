<?php

// vars
$player_rank = 1;

// Functions
function secondsToHoursMinutes($seconds) { 
      
    // Calculate the hours 
    $hours = floor($seconds / 3600); 
  
    // Calculate the remaining seconds 
    // into minutes 
    $minutes = floor(($seconds % 3600) / 60); 
  
    // Return the result as an  
    // associative array 
    return [ 
        'hours'   => $hours, 
        'minutes' => $minutes, 
    ]; 
} 

// Includes
include 'database.php';

// Database Connection
// Create
$conn = new mysqli($servername,$username,$password,$database);

// Check
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully<br>";

// Get top 10 players by score as long as they have played for more than 60 seconds and score isn't 0
$sql = "SELECT name, steamid, score, timeplayed, kills, deaths FROM dodstats WHERE timeplayed > '60' AND score != '0' ORDER BY score DESC LIMIT 10";
$result = $conn->query($sql);

?>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<title>DoDS Stats</title>
<body>
<h4>DoDS Stats</h4>
<table style="width:50%">
<thead>
    <tr>
        <th>Rank</th>
        <th>Name</th>
        <th>Points</th>
        <th>Time</th>
        <th>kpd</th>
    </tr>
</thead>
<tbody>

<?php
// Loop
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "Rank: " . $player_rank++ . " Name: " . $row["name"]. " - Steamid: " . $row["steamid"]. " - Points " . $row["score"]. "<br>";

    // Convert timeplayed to readable
    $duration = secondsToHoursMinutes($row["timeplayed"]);
    $timeplayed_neat = "{$duration['hours']}:{$duration['minutes']}h"; 

    // Check for nill deaths to avoid divide by zero error
    if ($row["deaths"] == 0) {
        $kpd = 'n/a';
    } else {
        $kpd = round($row["kills"]/$row["deaths"],1);
    }
?>
    <tr>
        <td><?php echo $player_rank++ ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["score"] ?></td>
        <td><?php echo $timeplayed_neat ?></td>
        <td><?php echo $kpd ?></td>
    </tr>
<?php
}
} else {
  echo "0 results";
}
$conn->close();

?>
</tbody>
</table>
</body>
</html>