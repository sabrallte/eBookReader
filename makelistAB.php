<!DOCTYPE html>
<html>
<body>

<h1>Autor Name</h1>



<?php
	$path = "ebook/".$_GET["AutorIndex"];
	//echo $path;
	
	//Array erzeugen mit Daten;
	$results = scandir($path);
	sort($results);

	//alle Pfade/files Durchlaufen
	for ($i=0;$i<count($results);$i++) {

		$result=$results[$i];
	    $info = pathinfo($result);
	    $autor = explode("-", $result);
	    
	    if ($result === '.' or $result === '..') 
	    	continue;
		if (($info["extension"] == "txt") && strcmp($autor[0],$_GET["Autorname"])) {
			$autor = explode("-", $result);
			$booktitle = explode(".",$autor[1]);
			echo "<a href='show.php?Autorindex=".$_GET["AutorIndex"]."&Autor=$autor[0]&Booktitle=$booktitle[0]&Filename=$result'>$autor[0] - $booktitle[0]</a>";
		    
	        //delimiter
	        if($i!=count($results)-1) echo '<br>'; 
	    }
	}
	
?>
	
<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>


</body>
</html> 