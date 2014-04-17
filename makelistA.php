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
	for ($i=0;$i<count($results);$i++) {

		$result= $results[$i];
	    $info = pathinfo($result);

	    if ($result === '.' or $result === '..') continue;
		if (($info["extension"] == "txt") && ($autorname = explode("-", $result))!=FALSE) {
	       	echo "<a href='makelistAB.php?AutorIndex=".$_GET["AutorIndex"]."&Autorname=$autorname[0]'>$autorname[0]</a>  ";
		    
	        //delimiter
	        if($i!=count($results)-1) echo '<br>'; 
	    }
	}
?>
	
<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>


</body>
</html> 