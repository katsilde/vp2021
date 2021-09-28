<?php
	require_once("../../config.php");
	require_once("fnc_film.php");
	//kontrolliks et kõik toimib(kas õige asukoht märgitud) --> echo $server_host;
	$author_name = "Katrin Silde";
	$film_store_notice = null;
	//kas klikiti submiti
	if(isset($_POST["film_submit"])){
		if(!empty($_POST["title_input"]) and !empty($_POST["genre_input"])and !empty($_POST["studio_input"]) and !empty($_POST["director_input"])){
			$film_store_notice = store_film($_POST["title_input"], $_POST["year_input"], $_POST["duration_input"], $_POST["genre_input"], $_POST["studio_input"], $_POST["director_input"]);
		}else{
			$film_store_notice = "osa andmeid on puudu!";
			if(empty($_POST["title_input"])){
				$film_store_notice_title="andmed puudu";
			}else{
				$film_store_notice_title="";
			}if(empty($_POST["genre_input"])){
				$film_store_notice_genre="andmed puudu";
			}else{
				$film_store_notice_genre="";
			}if(empty($_POST["studio_input"])){
				$film_store_notice_studio="andmed puudu";
			}else{
				$film_store_notice_studio="";
			}if(empty($_POST["director_input"])){
				$film_store_notice_director="andmed puudu";
			}else{
				$film_store_notice_director="";
			}
		//välja peal kuvatava teksti värk
		/*}if(!empty($_POST["title_input"])){
			$title_input_name = $_POST["title_input"];
		} else {
			$title_input_name = "pealkiri";
		}*/
		}
	}
	

?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<p>Õppetöö toimus 2021 sügisel.</p>
	<hr>
	<h2>Eesti filmid</h2>
	<form method="POST">
		<label for="title_input">Filmi pealkiri: </label>
		<input type="text" name="title_input" id="title_input" placeholder="pealkiri" value="<?php echo isset($_POST["title_input"]) ? $_POST["title_input"] : ''; ?>">
		<label for="title_input"> <?php echo $film_store_notice_title;?> </label>
		<br>
		<label for="year_input">Valmimis aasta: </label>
		<input type="number" name="year_input" id="year_input" value="<?php echo date("Y"); ?>" min="1912">
		<br>
		<label for="duration_input">Kestus_minutites: </label>
		<input type="number" name="duration_input" id="duration_input" value="60" min="1">
		<br>
		<label for="genre_input">Filmi žanr: </label>
		<input type="text" name="genre_input" id="genre_input" placeholder="žanr" value="<?php echo isset($_POST["genre_input"]) ? $_POST["genre_input"] : ''; ?>">
		<label for="genre_input"> <?php echo $film_store_notice_genre;?> </label>
		<br>
		<label for="studio_input">Filmi tootja: </label>
		<input type="text" name="studio_input" id="studio_input" placeholder="tootja" value="<?php echo isset($_POST["studio_input"]) ? $_POST["studio_input"] : ''; ?>">
		<label for="studio_input"> <?php echo $film_store_notice_studio;?> </label>
		<br>
		<label for="director_input">Filmi lavastaja: </label>
		<input type="text" name="director_input" id="director_input" placeholder="lavastaja" value="<?php echo isset($_POST["director_input"]) ? $_POST["director_input"] : ''; ?>">
		<label for="director_input"> <?php echo $film_store_notice_director;?> </label>
		<br>
		<input type="submit" name="film_submit" value="salvesta">
	</form>
	<span><?php echo $film_store_notice;?></span>
</body>
</html>