<!DOCTYPE html>
<html>
<body>

<h1>Autor Name</h1>



<?php
	//Dateipfad festlegen
	
	$path = "ebook/".$_GET["AutorIndex"];
	//echo $path;
	
	//Array erzeugen mit Daten;
	$results = scandir($path);
	sort($results);
	array_unique($results);
	
	
	//alle Pfade/files Durchlaufe
	foreach ( $results as $result)  {
		
		//Fileextension der aktuellen Datei herrausfinden
		$file_type = strtolower( end( explode('.', $result ) ) );

		//Prüfen ob Extension der aktuellen Datei TXT ist und der Autorname gelesen werden kann
		if (($file_type == "txt") 
		&& ($autorname = explode("-", $result))!=FALSE
		&& ($result != '.' or $result != '..')) {
	       	echo "<a href='makelistAB.php?AutorIndex=".$_GET["AutorIndex"]."&Autorname=$autorname[0]'>$autorname[0]</a>  ";
		    
	        //delimiter
	        echo '<br>'; 
	    }
	}
?>
	
<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>


</body>
</html> 