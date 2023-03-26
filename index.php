<!DOCTYPE html>
<html>
<head>
	<title>Pencarian music</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Pencarian Musik</h1>
	<form method="GET" action="">
		<label for="search">Cari lagu:</label>
		<input type="text" name="search" id="search">
		<input type="submit" value="Cari">
	</form>
	<?php
		if(isset($_GET['search'])) {
			$searchTerm = urlencode($_GET['search']);
			$url = "https://itunes.apple.com/search?term=$searchTerm&media=music";
			$response = file_get_contents($url);
			$result = json_decode($response);

			if(!empty($result->results)) {
				echo "<ul>";
				foreach($result->results as $item) {
					echo "<li>";
					echo "<a href='" . $item->trackViewUrl . "' target='_blank'>";
					echo "<img src='" . $item->artworkUrl100 . "' alt='" . $item->trackName . "'>";
					echo "</a>";
					echo "<h2>" . $item->trackName . "</h2>";
					echo "<p>" . $item->artistName . "</p>";
					echo "</li>";
				}
				echo "</ul>";
			} else {
				echo "Tidak ada hasil ditemukan.";
			}
		}
	?>
</body>
</html>
