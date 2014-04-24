<!DOCTYPE html>
<html>
<body>

<h1>Autor Name</h1>



<?php
	//Dateipfad festlegen
	
	$path = "ebook/".$_GET["AutorIndex"];

	
	//Array erzeugen mit Daten;
	$results = scandir($path);
	
	//Sortieren a-z
	sort($results);
	
	//Jeder Autor einzigartig
	array_unique($results);
	
	
	//alle Pfade/files Durchlaufe
	foreach ( $results as $result)  {
		
		//Fileextension der aktuellen Datei herrausfinden
		$file_type = strtolower( end( explode('.', $result ) ) );

		//Prüfen ob Extension der aktuellen Datei TXT ist und der Autorname gelesen werden kann
		if (($file_type == "txt") 
		&& ($autorname = explode("-", $result))!=FALSE
		&& ($result != '.' or $result != '..')) {
			
			//zählen der vorhandenen Bücher pro Autor
			$num_books = count(glob("$path/$autorname[0]-*.txt"));
	
			//Link erzeugen zu Büchern des Autors, übergabe der Parameter als GET, ausgabe Anzahl der Bücher Pro Autor
	       	print "<a href='makelistAB.php?AutorIndex=".$_GET["AutorIndex"]."&Autorname=$autorname[0]'>$autorname[0] ($num_books)</a>";
		    
	        //delimiter
	        print '<br>'; 
	    }
	}
?>
	
<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>


</body>
</html> 