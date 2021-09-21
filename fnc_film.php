<?php
	$database = "if21_katrin_si";
	

	function read_all_films(){
		
		//loome andmebaasiühenduse, mysqli	| server, kasutaja
		$conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		//määrame vajaliku kodeeringu
		$conn->set_charset("utf8");
		//valmistan ette SQL päringu: SELECT * FROM film
		$stmt = $conn->prepare("SELECT * FROM film");
		echo $conn->error;
		//seon tulemused muutujatega 
		$stmt->bind_result($title_from_db, $year_from_db, $duration_from_db, $genre_from_db, $studio_from_db, $director_from_db);
		//täidan käsu
		$film_html = null;
		$stmt->execute();
		//võtan esimese kirje
			//$stmt->fetch();
		//võtan kirjeid kuni jätkub
		while($stmt->fetch()){
			//<h3> filmi nimi</h3>
			//<ul>
			//<li>valmimisaasta: 1976</li>
			//
			$film_html .= "<h3>" .$title_from_db ."</h3> \n";
			$film_html .="<ul> \n";
			$film_html .="<li>Valmimisaasta: ".$year_from_db ."</li> \n";
			$film_html .="<li>Kestus: ".$duration_from_db ."</li> \n";
			$film_html .="<li>Žanr: ".$genre_from_db ."</li> \n";
			$film_html .="<li>Tootja: ".$studio_from_db ."</li> \n";
			$film_html .="<li>Lavastaja: ".$director_from_db ."</li> \n";
			$film_html .="</ul> \n";
		}
		//sulgen käsu
		$stmt->close();
		//sulgeme andmebaasiühenduse
		$conn->close();
		return $film_html;			
	}
	function store_film($title_input, $year_input, $duration_input, $genre_input, $studio_input, $director_input){
		$conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		//määrame vajaliku kodeeringu
		$conn->set_charset("utf8");
		//SQL: INSERT INTO film(pealkiri, kestus, zanr, tootja, lavastaja) VALUES(Suvi, 1976, 83, "Tallinnfilm")
		$stmt = $conn->prepare("INSERT INTO film(pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
		echo $conn->error;
		//seome SQL käsuga päris andmed
		// i integer	d decimal	s string
		$stmt->bind_param("siisss", $title_input, $year_input, $duration_input, $genre_input, $studio_input, $director_input);
		//käsu täitmine
		$success = null;
		if($stmt->execute()){
			$success="salvestamine õnnestus";
		}else{
			$success="salvestamisel tekkis viga: " .$stmt->error;
		}
		
		//sulgen käsu
		$stmt->close();
		//sulgeme andmebaasiühenduse
		$conn->close();
		return $success;
	}