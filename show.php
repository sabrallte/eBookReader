<!DOCTYPE html>
<html>
	
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

<?php
	//pfad zu den B�chern Setzen
	$path = "ebook/".$_GET["AutorIndex"]."/";
	
	//Dateiname des anzuzeigenden Buches aus GET Variable lesen und in lokaler speichern
	$filename = $_GET["Filename"];
	
	$filehistory = "cfg/history";
?>

<script type="text/javascript">

	function savepos() {
		var ypos = window.pageYOffset;
		//var pos = document.body.scrollTop;
		var http = new XMLHttpRequest();
		if (http != null) {
			http.open("GET", "setbookmark.php?pos=" + ypos + "&filename=" + <?php echo '"'.$filename.'"'?>, false);
			http.send();
		}
	}	
</script>

</head>

<?php

	//abrufen der letzten scrollposition falls das buch schonmal gelesen wurde
	if (($ypos= @file_get_contents("cfg/bookmark/".$filename))==FALSE)
		$ypos = 0;

	
	//Body �ffnen mit Attribute onscroll -> ypos (Scroll) position jedesmal speichern in cookie
	print '<body onunload="savepos()" onLoad="window.scrollTo(0,'.$ypos.')" bgcolor="#CED8F6">';
	
	print '<p><a href = "javascript:history.back()">Back</a>
	<a href="index.php">Home</a></p>';
		
	//�berschrift, Autorname und Buchtitel ausgeben
	print "<h1><bold>Booktitle:</bold> ".$_GET["Booktitle"]."</h1>";
	print "<h2>Autor: ".$_GET["Autor"]."</h2>";
	
	//pr�fen ob es ein Bild zu dem Buch gibt, falls ja darstellen sonst nichts
	if (($images = glob("$path$filename.{jpg,jpeg,gif,png}", GLOB_BRACE))!=FALSE)
		print '<img src="'.$images[0].'" alt="'.$filename.'" width="150" hight="auto" >';
	
	print "<br>";
	
	//Text von Buch aus Datei lesen und auf Bildschirm darstellen
	if (($text= file_get_contents( $path. $_GET["Filename"]. ".txt"))!= FALSE) {
		print nl2br($text);
		
		//pr�fen ob History Datei exisitiert, falls nicht anlegen
		if (file_exists($filehistory)==FALSE)
			fclose(fopen("$filehistory", "w"));
		
		//Aktuelles Buch in der History Hinterlegen
		if (($history = file($filehistory))!=FALSE) { //Daten aus History file in Array laden
		
			//leerzeichen und Zeilenumbr�che (verursacht durch den import aus TXT) entfernen
			$history = array_map('trim', $history);
		
			//aktuelles buch schon in Array vorhanden (wurde schon gelesen)?
			if (($pos=array_search($path.$filename, $history))!==FALSE)  {
					
				//eintrag aus Array l�schen
				unset($history[$pos]);
			}
		
			//aktuelles buch noch nicht im History Array vorhanden (wurde noch nicht gelesen)
			else {
		
				//history schon "voll" mit 10 Eintr�gen?
				if ((count($history))==10) {
					print_r (count($history));
					//letzten Eintrag in History verwerfen um Platz zu schaffen!
					unset($history[9]);
					echo "<p/>eintrag in array gel�scht weil array voll<br>";
				}
			}
		}
		
		//an letzter stelle neu einf�gen
		array_push($history, $path.$filename);
		
		//History speichern in datei
		if (file_put_contents($filehistory, implode(PHP_EOL, $history))==FALSE) {
			print "<p/>Fehler beim Schreiben der History!";
		}
		
	}
	else
		print "<p/>Fehler beim Ebook �ffnen!";
	
	

?>

<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>

</body>
</html> 