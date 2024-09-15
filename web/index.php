<?php

// vars
$player_rank = 1;


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


include 'database.php';

// Create connection
$conn = new mysqli($servername,$username,$password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully<br>";

$sql = "SELECT name, steamid, score, timeplayed, kills, deaths FROM dodstats ORDER BY score LIMIT 10";
$result = $conn->query($sql);

?>
<html>
<title>DoDS Stats</title>
<link rel="stylesheet" href="./assets/css/tailwind.output.css" />

<body>
<h4>DoDS Stats</h4>
<table>
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

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "Rank: " . $player_rank++ . " Name: " . $row["name"]. " - Steamid: " . $row["steamid"]. " - Points " . $row["score"]. "<br>";

$duration = secondsToHoursMinutes($row["timeplayed"]);

$timeplayed_neat = "{$duration['hours']}:{$duration['minutes']}h"; 



?>
    <tr>
        <td><?php echo $player_rank++ ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["score"] ?></td>
        <td><?php echo $timeplayed_neat ?></td>
        <td><?php echo (round($row["kills"]/$row["deaths"],1)) ?></td>
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