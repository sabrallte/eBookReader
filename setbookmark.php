<?php 
	$file = "cfg/bookmark/".$_GET["filename"];
	if (file_put_contents($file, $_GET["pos"])==FALSE)
		return;
		
?>