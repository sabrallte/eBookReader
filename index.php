<!DOCTYPE html>
<link rel="stylesheet" href="test.css" type="text/css" media="screen">
<html>
<body bgcolor="#CED8F6">

	

<?php



	// Dateipfad festlegen
	$path = 'ebook/';
	
	//History Datei festlegen
	$filehistory = "cfg/history";
	
	// Array erzeugen mit Daten
	$results = scandir ( $path );
	
		//************************************************************************************************
		print '<div style="background-color:black">';
		// alle Pfade/files Durchlaufe
	for($i = 0; $i < count ( $results ); $i ++) {
		$result = $results [$i];
		
		// Datei oder Pfad?
		if ($result === '.' or $result === '..')
			continue;
			
			// nur Verzeichnisse darstellen als Link
		if (is_dir ( $path . $result )) {
			
			// Dateien im atuellen Verzeichnis zählen (wieviel Büchern enthalten)
			$num_files = count ( glob ( "$path$result/*.txt" ) );
			
			// Link erzeugen zu autorenübersicht (makelista.php) in klammern dahinter anzahl der Bücher im Ordner anzeigen
			print '<p class="info">'; 
			print "<a href='makelistA.php?AutorIndex=$result'>$result ($num_files)";
	
	
		}
		
	}
	print '</div>';
	//************************************************************************************************
	
	//darstellen der History, daten aus History file laden
	if (($history = file($filehistory))!=FALSE) {
		
		//leerzeichen und Zeilenumbrüche (verursacht durch den import aus TXT) entfernen
		$history = array_map('trim', $history);
		
		//als Table ausgeben
		print '<p><table>
			<tr>';
			
			$zähler=0;
		//Array History durchlaufen, jedes einzelne Element in historyresult (string) 
		foreach ($history as $historyresult) {
			$zähler=$zähler+1;
			
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
				print '<img src="placeholder.jpg" alt="'.$autorbook[1].'" width="150" hight="auto">';
			
				print('<p>');
				print '<td>'; echo ($autorbook[1]);print('</p>');print '</td>';
				
				if ($zähler==4){print '<tr>';$zähler=0;}
		}
	
		
		//Link und Tabellenspalte schließen
		print 	'</a></table></p></td></tr>';
			
	}
		

?>


</body>
</html>