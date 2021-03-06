<?php
	$author_name = "Katrin Silde";
	//echo $author_name; //print
	
	//vaatan mida post meetodil saadeti
	//var_dump($_POST);
	$today_html = null;
	$adjective_error=null;
	$todays_adjective=null;
	//kontrollin kas klikiti submiti
	if(isset($_POST["submit_todays_adjective"])){
		//echo "klikiti nuppu";
		if(!empty($_POST["todays_adjective_input"])){	
			$today_html="<p>Tänane päev on " .$_POST["todays_adjective_input"] .".</p>";
			$todays_adjective=$_POST["todays_adjective_input"];
		}else{
			$adjective_error ="palun kirjutage tänase kohta omadussõna";
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
	
	//loeb fotode arvu ära fotode kaustas
	$file_count = count($all_photos);
	//random number generator, genereerib ühe arvu fotode koguse seast
	$photo_num = mt_rand(0, $file_count-1);
	//<img src="photos/pilt.jpg" alt="tallinna ülikool">
	
	//pärast juhusliku foto loosimist ja selle näitamise jaoks HTML koodi moodustamist
	$photo_html= '<img src=" '.$photo_dir .$all_photos[$photo_num] . ' " alt= "Tallinna Ülikool">';
	$photo_list_html="\n <ul> \n";
	
	//tsükkel
/*	for($i=algväärtus; $i<piirväärtus; $i muutumine){...}
	$i+=5 on $i=$i+5,  $i++
	<ul>
	<li>pildifail.jpg</li>
	...
	<li>pildifail.jpg</li>
	</ul> */

	
	for ($i=0; $i<$file_count; $i++){
		$photo_list_html.="<li>" .$all_photos[$i] ."</li> \n";
	}
	$photo_list_html.="</ul> \n";  //.= pane juurde
	
	/*kas kasutaja klikkis selle uue, foto valimise vormi submit nuppu
			Kui jah, siis tuleb moodustada HTML kood just valitud pildi näitamiseks*/
			
	$chosen_picture = null; 
	if(isset($_POST["submit_todays_adjective"])){
		//echo "klikiti nuppu";
		if(!empty($_POST["chosen_picture_nr"])){	
			$selected = $_POST["chosen_picture_nr"];
			echo 'You have chosen: ' . $selected;
			$chosen_picture='<img src=" '.$photo_dir .$all_photos["chosen_picture_nr"] . ' " alt= "Tallinna Ülikool">';
		}else{
			$chosen_picture = $photo_html;
		}
	}
	
	//select elemenndi moodustamine
	$photo_select_html='<select name="photo_select">' ."\n";
	for ($i=0; $i<$file_count; $i++){
		$photo_select_html.= '<option value="' .$i .'">' .$all_photos[$i] ."</option> \n";
	}
	$photo_select_html .="</select> \n";
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
	
	<hr>
	<!--ekraanivorm-->
	<form method="POST">
		<input type="text" name="todays_adjective_input" placeholder="tänase päeva ilma omadus" value="<?php echo $todays_adjective; ?>">
		<input type="submit" name="submit_todays_adjective" value="saada ära">
		<span><?php echo $adjective_error; ?></span>
	</form>
		
	<hr>
	
	
	<form method="POST">
		<input type="number" name="chosen_picture_nr" value="<?php echo $photo_select_html ?>" >

	</form>
	<?php 
		echo $chosen_picture; 
		echo $photo_html; 
		echo $photo_list_html;
	?>
</body>
</html>