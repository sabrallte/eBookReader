<!DOCTYPE html>
<html>

<!-- bei jedem Scrollen die aktuelle Position speichern -->
<body onScroll="saveScroll()">


<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>



<?php

	//pfad zu den Büchern Setzen
	$path = "ebook/".$_GET["AutorIndex"]."/";
	
	//Dateiname des anzuzeigenden Buches aus GET Variable lesen und in lokaler speichern
	$filename = $_GET["Filename"];
	//$file = "cfg/".$_GET["Filename"].".pos";
	
	//Überschrift, Autorname und Buchtitel ausgeben
	echo "<h1><bold>Booktitle:</bold> ".$_GET["Booktitle"]."</h1>";
	echo "<h2>Autor: ".$_GET["Autor"]."</h2>";
	
	//prüfen ob es ein Bild zu dem Buch gibt, falls ja darstellen sonst nichts
	if (($images = glob("$path$filename.{jpg,jpeg,gif,png}", GLOB_BRACE))!=FALSE)
		echo '<img src="'.$images[0].'" alt="'.$filename.'" width="150" hight="auto" >';
	
	echo "<br>";
	
	//Text von Buch aus Datei lesen und auf Bildschirm darstellen
	echo file_get_contents( "ebook\\".$_GET["AutorIndex"]."\\".$_GET["Filename"].".txt" );

?>

<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>

</body>
</html> 