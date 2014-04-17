<!DOCTYPE html>
<html>
<body>



<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>

<?php

echo "<h1><bold>Booktitle:</bold> ".$_GET["Booktitle"]."</h1>";
echo "<h2>Autor: ".$_GET["Autor"]."</h2>";
echo file_get_contents( "ebook\\".$_GET["Autorindex"]."\\".$_GET["Filename"] ); // get the contents, and echo it out.
?>

<p><a href = "javascript:history.back()">Back</a> 
<a href="index.php">Home</a></p>

</body>
</html> 