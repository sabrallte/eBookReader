<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="cfg/stylesheet.css" type="text/css" media="screen">
	</head>
<body>
<body bgcolor="#CED8F6">




<?php
	print '<h1>Autor Name: '.$_GET["Autorname"].'</h1>';
	$path = "ebook/".$_GET["AutorIndex"]."/";
	//print $path;
	print "<table border=1>";
	
	//Array erzeugen mit Daten und sortieren;
	$results = scandir($path);
	sort($results);

	//alle Pfade/files Durchlaufen
	foreach ( $results as $file ) {
		
		//alle Dateieindungen als klein behandeln
		$file_type = strtolower( end( explode('.', $file ) ) );
		
		//Autor und Buchtitel aus dem Dateinamen extrahieren
		$filename = explode (".", $file);
		$autortitle = explode("-", $filename[0]);
		

	    //Pr�fen ob Extension der aktuellen Datei TXT 
		if (($file_type== "txt") 
		
		//pr�fen das Autoren �bereinstimmen + entferen von ungewohlten Leerzeichen
		and (trim($autortitle[0])==$_GET["Autorname"])
		
		//pr�fen das es nicht um Verzeichnissinformationen handelt
		and ($file != '.' or $file != '..')) {
			
			//Tabellenspalte anlegen
			print "<tr>";
			print '<td align="center" valign="middle">';

			//Link erzeugen zu Show.php mit GET anwei�ungen (Index,Autor,Titel,Dateiname)
			print "<a href='show.php?AutorIndex=". $_GET["AutorIndex"]. "&Autor=$autortitle[0]&Booktitle=$autortitle[1]&Filename=$filename[0]'>";
			
			//pr�fen ob Bilder zum dem Buch existieren, Falls ja-> Darstellen sonst Platzhalter Grafik
			if (($images = glob("$path$filename[0].{jpg,jpeg,gif,png}", GLOB_BRACE))!=FALSE)
				print '<img src="'.$images[0].'" alt="'.$filename[0].'" width="150" hight="auto" >';
			else 				
				print '<img src="cfg/placeholder.jpg" alt="'.$filename[0].'" width="150" hight="auto">';
			
			//Tablenspalte schlie�en
			print "</td>";
			
			//Buchtitel	neue Tabellenspalte
			print "<td>";
			print "$autortitle[1]</a>";
			
			//Tablenzeile schlie�en
			print "</td>";
			print "</tr>";
			
	    }
	}
	print "</table>";
?>
	
<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>


</body>
</html> 