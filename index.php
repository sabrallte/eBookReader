<!DOCTYPE html>
<html>
<body>

	<h1>Ebook Reader</h1>

<?php
	// Dateipfad festlegen
	$path = 'ebook/';
	
	//History Datei festlegen
	$filehistory = "cfg/history";
	
	// Array erzeugen mit Daten
	$results = scandir ( $path );
	
	//darstellen der History, daten aus History file laden
	if (($history = file($filehistory))!=FALSE) {
		
		//leerzeichen und Zeilenumbr¸che (verursacht durch den import aus TXT) entfernen
		$history = array_map('trim', $history);
		
		//als Table ausgeben
		print '<p><table>
			<tr>';
		//Array History durchlaufen, jedes einzelne Element in historyresult (string) 
		foreach ($history as $historyresult) {
						
			//String wieder aufdriesenln nach autor,titel, index und dateiname... ->uneffektiv
			$pathtofile = explode("/",$historyresult);
			$autorbook = explode ("-",$pathtofile[2]);
			
			//tabellenspalte anlegen
			print '<td>';
			
			//Link erzeugen zu Buch
			print "<a href='show.php?AutorIndex=". $pathtofile[1]. 
				"&Autor=$autorbook[0]&Booktitle=$autorbook[1]&Filename=$pathtofile[2]'>";
			
			//bilder suchen

			if (($images = glob("$historyresult.{jpg,jpeg,gif,png}", GLOB_BRACE))!=FALSE)
				print '<img src="'.$images[0].'" alt="'.$autorbook[1].'" width="150" hight="auto" >';
			else 				
				print '<img src="cfg/placeholder.jpg" alt="'.$autorbook[1].'" width="150" hight="auto">';
		}

		
		//Link und Tabellenspalte schlieﬂen
		print 	'</a></td></tr></table></p>';
			
	}
		

	// alle Pfade/files Durchlaufe
	for($i = 0; $i < count ( $results ); $i ++) {
		$result = $results [$i];
		
		// Datei oder Pfad?
		if ($result === '.' or $result === '..')
			continue;
			
			// nur Verzeichnisse darstellen als Link
		if (is_dir ( $path . $result )) {
			
			// Dateien im atuellen Verzeichnis z‰hlen (wieviel B¸chern enthalten)
			$num_files = count ( glob ( "$path$result/*.txt" ) );
			
			// Link erzeugen zu autoren¸bersicht (makelista.php) in klammern dahinter anzahl der B¸cher im Ordner anzeigen
			print "<a href='makelistA.php?AutorIndex=$result'>$result ($num_files)</a>  ";
		}
		// delimiter
		if ($i != count ( $results ) - 1)
			print '|';
	}
?>


</body>
</html>
