<html>
<?php
require('csv_util.php');
$quotes=readCSV('quotes.csv');       //input data from csv files
$authors=readCSV('authors.csv');

$newQuotes=addQuote($quotes, $authors);            //add a new quote to the quotes csv file.
$newAuthors=addAuthor($authors);                      //add new author to the authors file

writeCSV('quotes.csv', $newQuotes);                  //overwrite the new data to the corresponding files
writeCSV('authors.csv', $newAuthors);
?>
<h1>Quote has been added.</h1>
<h1><a href="index.php">Return to Index</a></h1>
</html>
