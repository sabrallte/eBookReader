<!DOCTYPE html>
<html>
<body>

<h1>Ebook Reader</h1>

<?php
	//Dateipfad festlegen
	$path = 'ebook' ;
	
		//Array erzeugen mit Daten
	    $results = scandir($path);
	    
	    //alle Pfade/files Durchlaufe
	    for ($i=0;$i<count($results);$i++   ) {
	        $result=$results[$i];
	        //Datei oder Pfad?
	        if ($result === '.' or $result === '..') continue;
			//nur Verzeichnisse darstellen als Link
	        if (is_dir($path . '/' . $result)) {
	             echo "<a href='makelistA.php?AutorIndex=$result'>$result</a>  ";
	
	        }
	        //delimiter
	        if($i!=count($results)-1) echo '|'; 
	    }
?>


</body>
</html> 