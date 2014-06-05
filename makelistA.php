<!DOCTYPE html>
<html>
	
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="cfg/stylesheet.css" type="text/css" media="screen">

</head>
<body>
<body bgcolor="#CED8F6">

<h1>Autor Name</h1>


<?php
	//Dateipfad festlegen
	
	$path = "ebook/".$_GET["AutorIndex"];

	
	//Array erzeugen mit Daten;
	$results = scandir($path);
		
	//Sortieren a-z
	sort($results);

	//Autoren Filtern
	for ($i=0;$i<count($results);$i++) {
	  $data = explode("-",$results[$i]);
	  $results[$i] = $data[0];
	}
	
	//Jeder Autor einzigartig
	$results = array_unique($results);

	
	//alle Pfade/files Durchlaufe
	foreach ( $results as $result)  {
		
		//Fileextension der aktuellen Datei herrausfinden
		$file_type = strtolower( end( explode('.', $result ) ) );
				
		//Pr�fen ob Extension der aktuellen Datei TXT ist und der Autorname gelesen werden kann
		if ($result != '.' and $result != '..') {
			
			//z�hlen der vorhandenen B�cher pro Autor
			$num_books = count(glob("$path/$result-*.txt"));
	
			//Link erzeugen zu B�chern des Autors, �bergabe der Parameter als GET, ausgabe Anzahl der B�cher Pro Autor
	       	print "<a href='makelistAB.php?AutorIndex=".$_GET["AutorIndex"]."&Autorname=$result'>$result ($num_books)</a>";
		    
	        //delimiter
	        print '<br>'; 
	    }
	}
?>
	
<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>


</body>
</html> 