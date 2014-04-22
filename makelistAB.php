<!DOCTYPE html>
<html>
<body>





<?php
	echo '<h1>Autor Name: '.$_GET["Autorname"].'</h1>';
	$path = "ebook/".$_GET["AutorIndex"]."/";
	//echo $path;
	echo "<table border=1>";
	
	//Array erzeugen mit Daten;
	$results = scandir($path);
	sort($results);
	//$file_picture = array('jpg', 'jpeg', 'png', 'gif');
	

	//alle Pfade/files Durchlaufen
	foreach ( $results as $file ) {
		
		//alle Dateieindungen als klein behandeln
		$file_type = strtolower( end( explode('.', $file ) ) );
		
		//Autor und Buchtitel aus dem Dateinamen extrahieren
		$filename = explode (".", $file);
		$autortitle = explode("-", $filename[0]);



	    //Prüfen ob Extension der aktuellen Datei TXT ist und Autoren übereinstimmen
		if (($file_type== "txt") 
		&& strcmp($autortitle[0],$_GET["Autorname"])
		
		//prüfen das es nicht um Verzeichnissinformationen handelt
		&& ($file != '.' or $file != '..')) {
			
			//Tabellenspalte anlegen
			echo "<tr>";
			echo '<td align="center" valign="middle">';

			//Link erzeugen zu Show.php mit GET anweißungen (Index,Autor,Titel,Dateiname)
			echo "<a href='show.php?AutorIndex=". $_GET["AutorIndex"]. "&Autor=$autortitle[0]&Booktitle=$autortitle[1]&Filename=$filename[0]'>";
			
			//prüfen ob Bilder zum dem Buch existieren, Falls ja-> Darstellen sonst Platzhalter Grafik
			if (($images = glob("$path$filename[0].{jpg,jpeg,gif,png}", GLOB_BRACE))!=FALSE)
				echo '<img src="'.$images[0].'" alt="'.$filename[0].'" width="150" hight="auto" >';
			else 				
				echo '<img src="cfg/placeholder.jpg" alt="'.$filename[0].'" width="150" hight="auto">';
			
			//Tablenspalte schließen
			echo "</td>";
			
			//Buchtitel	neue Tabellenspalte
			echo "<td>";
			echo "$autortitle[1]</a>";
			
			//Tablenzeile schließen
			echo "</td>";
			echo "</tr>";
			
	    }
	}
	echo "</table>";
?>
	
<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>


</body>
</html> 