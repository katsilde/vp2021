<?php
	$author_name = "Katrin Silde";
	//echo $author_name; //print
	//vaatan praegust ajahetke
	$full_time_now = date("d.m.Y H:i:s");
	//vaatan nädalapäeva
	$weekday_now = date("N");
	//echo $weekday_now;
	$weekday_names_et = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	//echo $weekday_names_et [$weekday_now - 1];
	//küsime ainult tunde
	$hour_now = date("H");
	$day_category = "tavaline päev";
	//vaatan täistundi
	$hour_now = date ("H");
	//kontrollin päeva
	if ($weekday_now <= 5) {
		$day_category="koolipäev";
		if ($hour_now < 8 or $hour_now >=23){
			$hour_category="uneaeg";
			
		}if ($hour_now >= 8 and $hour_now <=18){
			$hour_category="tundide aeg";
		}else {
			$hour_category="vaba aeg";
		}
	} else{
		$day_category = "puhkepäev";
		if ($hour_now < 8 or $hour_now >=23){
			$hour_category="uneaeg";
		}else {
			$hour_category="vaba aeg";
		}
	}
	// lisan lehele juhusliku foto
	$photo_dir = "photos/";
	//loen kataloogi sisu
	//	$all_files = scandir($photo_dir);
	// alguse ära võtmine
	$all_files = array_slice(scandir($photo_dir), 2);
	//var_dump($all_files);		väljastus
	
	//kontrollin ja võtan ainult fotod
	$allowed_photo_types = ["image/jpeg", "image/png"];
	$all_photos = [];
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		// isset kas on üldse värtused
		if (isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($all_photos, $file);
			}
		}
	}//foreach lõppeb
	
	$file_count = count($all_photos);
	//random number generator
	$photo_num = mt_rand(0, $file_count-1);
	//<img src="photos/pilt.jpg" alt="tallinna ülikool">
	$photo_html= '<img src=" '.$photo_dir .$all_photos[$photo_num] . ' " alt= "Tallinna Ülikool">';
	
	//koduses töös vist vaja
	//if($hour_now >=8 and $hour_now <=18) 
	//if($hour_now <7 and $hour_now >23)
?>
<!DOCTYPE html> 
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
	
</head>
<body>
	<h1><?php echo $author_name; ?></h1>
	
	<p>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	
	<img src="3700x1100_pildivalik187.jpg" alt="Tallinna Ülikool" width="600">
	
	<h4>Minu tehtud kodune täiendus</h4>
	<img src="duck.jpg" alt="part noaga" width="200">
	
	<p>Lehe avamise hetk: <span><?php echo $weekday_names_et [$weekday_now - 1].", ". $full_time_now .", täna on " . $day_category . ", hetkel on ". $hour_category; ?></span>.</p>
	<?php echo $photo_html; ?>
</body>
</html>