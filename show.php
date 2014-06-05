<!DOCTYPE html>
<html>
	
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

<?php
	//pfad zu den Büchern Setzen
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

	
	//Body oeffnen mit Attribute onscroll -> ypos (Scroll) position jedesmal speichern in cookie
	print '<body onunload="savepos()" onLoad="window.scrollTo(0,'.$ypos.')" bgcolor="#CED8F6">';
	
	//float Menue damit der User immer zurück kann
	?>
	
	<style>
	div.floating-menu {position:fixed;left:650px;background:#fff4c8;border:1px solid #ffcc00;width:150px;z-index:100;}
	div.floating-menu a, div.floating-menu h3 {display:block;margin:0 0.5em;}
	</style>
	<div float:right class="floating-menu">
	<h3>Men&uuml</h3>
	<a href="javascript:history.back()">Zur&uuml;ck</a>
	<a href="index.php">Hauptmen&uuml;</a>

	</div>
	
	<?php
	
	print '<p><a href = "javascript:history.back()">Back</a>
	<a href="index.php">Home</a></p>';
		
	//Ueberschrift, Autorname und Buchtitel ausgeben
	print "<h1><bold>Booktitle:</bold> ".$_GET["Booktitle"]."</h1>";
	print "<h2>Autor: ".$_GET["Autor"]."</h2>";
	
	//pruefen ob es ein Bild zu dem Buch gibt, falls ja darstellen sonst nichts
	if (($images = glob("$path$filename.{jpg,jpeg,gif,png}", GLOB_BRACE))!=FALSE)
		print '<img src="'.$images[0].'" alt="'.$filename.'" width="150" hight="auto" >';
	
	print "<br>";
	
	//Text von Buch aus Datei lesen und auf Bildschirm darstellen
	if (($text= file_get_contents( $path. $_GET["Filename"]. ".txt"))!= FALSE) {
		print '<div id="text" align="justify" style="max-width:768px;">'.nl2br($text)."</div>";
		
		//pruefen ob History Datei exisitiert, falls nicht anlegen
		if (file_exists($filehistory)==FALSE)
			fclose(fopen("$filehistory", "w"));
		
		//Aktuelles Buch in der History Hinterlegen
		if (($history = file($filehistory))!=FALSE) { //Daten aus History file in Array laden
		
			//leerzeichen und Zeilenumbrüche (verursacht durch den import aus TXT) entfernen
			$history = array_map('trim', $history);
		
			//aktuelles buch schon in Array vorhanden (wurde schon gelesen)?
			if (($pos=array_search($path.$filename, $history))!==FALSE)  {
					
				//eintrag aus Array lï¿½schen
				unset($history[$pos]);
			}
		
			//aktuelles buch noch nicht im History Array vorhanden (wurde noch nicht gelesen)
			else {
		
				//history schon "voll" mit 10 Eintrï¿½gen?
				if ((count($history))==10) {
					print_r (count($history));
					//letzten Eintrag in History verwerfen um Platz zu schaffen!
					unset($history[9]);
					echo "<p/>eintrag in array gelï¿½scht weil array voll<br>";
				}
			}
		}
		
		//an letzter stelle neu einfï¿½gen
		array_push($history, $path.$filename);
		
		//History speichern in datei
		if (file_put_contents($filehistory, implode(PHP_EOL, $history))==FALSE) {
			print "<p/>Fehler beim Schreiben der History!";
		}
		
	}
	else
		print "<p/>Fehler beim Ebook oeffnen!";
	
	

?>

<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>

</body>
</html> 




