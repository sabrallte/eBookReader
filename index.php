<!DOCTYPE html>
<link rel="stylesheet" href="cfg/stylesheet.css" type="text/css" media="screen">
<html>
	<head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head>
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
			
			// Dateien im atuellen Verzeichnis zaehlen (wieviel Buechern enthalten)
			if (glob ( "$path$result/*.txt" ) === false)
				$num_files = 0;
			else
				$num_files = count ( glob ( "$path$result/*.txt" ) );


			// Link erzeugen zu autorenuebersicht (makelista.php) in klammern dahinter anzahl der Buecher im Ordner anzeigen
			print '<p class="info">'; 
			
			if ($num_files ==! 0) 
				print "<a href='makelistA.php?AutorIndex=$result'>$result ($num_files)</a>";				
	
	
		}
		
	}
	print '</div>';
	//************************************************************************************************
	
	//darstellen der History, daten aus History file laden
	if (($history = file($filehistory))!=FALSE) {
		
		//leerzeichen und Zeilenumbrueche (verursacht durch den import aus TXT) entfernen
		$history = array_map('trim', $history);
		
		//als Table ausgeben
		print '<h3>Zuletzt ge&ouml;ffnete B&uuml;cher:</h3>';
		print '<p><table><tr>';

			
			$zaehler=0;
		//Array History durchlaufen, jedes einzelne Element in historyresult (string) 
		
		foreach ($history as $historyresult) {
			$zaehler=$zaehler+1;
			
			//String wieder aufdriesenln nach autor,titel, index und dateiname... ->uneffektiv
			$pathtofile = explode("/",$historyresult);
			$autorbook = explode ("-",$pathtofile[2]);
			
			//tabellenspalte anlegen
			print '<td class="HISTORY">';
			
			//Link erzeugen zu Buch
			//Achtung, der LINK muss das BILD und den Buch/Autor umschliessen damit es
			//einwandfrei zum Buch verlingt!!!
			print "<a href='show.php?AutorIndex=". $pathtofile[1]. 
				"&Autor=$autorbook[0]&Booktitle=$autorbook[1]&Filename=$pathtofile[2]'  title='$autorbook[1]'>";
			
			//bilder suchen

			if (($images = glob("$historyresult.{jpg,jpeg,gif,png}", GLOB_BRACE))!=FALSE)
				print '<img src="'.$images[0].'" alt="'.$autorbook[1].'" class="MAXSIZE" >';
			else 				
				print '<img src="cfg/placeholder.jpg" alt="'.$autorbook[1].'" class="MAXSIZE" >';
			
			print "<br/> $autorbook[1]";
				
			if ($zaehler==5){print '</tr><tr>';$zaehler=0;}
		
	
		
		//Link und Tabellenspalte schliessen
		print 	'</a>';
		}
		print '</tr></table></p>';
			
	}
		

?>


</body>
</html>