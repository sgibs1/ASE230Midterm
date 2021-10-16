<html>
<?php
require('csv_util.php');
$quotes=readCSV('quotes.csv');            //Read the csv files
$authors=readCSV('authors.csv');

$authors=replaceAuthor($authors);         //replace data in an array
$quotes=replaceQuote($quotes);
writeCSV('quotes.csv', $quotes);          //ovewrite the csv file with the updated array
writeCSV('authors.csv', $authors);
?>
<h1>Quote has been modified.</h1>
<h1><a href="index.php">Return to Index</a></h1>
</html>
