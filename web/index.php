<title>DoDS Stats</title>
<link rel="stylesheet" href="./assets/css/tailwind.output.css" />

<?php



// vars
$player_rank = 1;


include 'database.php';


echo "Hello world<br>";


// Create connection
$conn = new mysqli($servername,$username,$password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";



$sql = "SELECT name, steamid, score FROM dodstats ORDER BY score LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Rank: " . $player_rank++ . " Name: " . $row["name"]. " - Steamid: " . $row["steamid"]. " - Score " . $row["score"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();





?>



            <!-- With avatar -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              DoDS Stats
            </h4>
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Rank</th>
                      <th class="px-4 py-3">Name</th>
                      <th class="px-4 py-3">Points</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                            <p class="font-semibold"><?php echo $player_rank++ ?></p>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <?php echo $player_rank++ ?>
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <?php echo $player_rank++ ?>
                    </tr>


                    </tbody>
                </table>
              </div>
              <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >