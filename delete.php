<html>
<?PHP
session_start();
require('auth/auth.php');
if (is_logged() == true) {             //Check if a user is logged in and require neccesary files.
require('csv_util.php');
$quotes=readCSV('quotes.csv');                //Assign arrays read from the csv file via a function.
$authors=readCSV('authors.csv');

$newData=removeData($quotes);                //Remove selected array



writeCSV('quotes.csv', $newData);            //Overwrite the updated array
?>
<h1>Quote has been deleted.</h1>
</html>
<?PHP }
else {
  echo 'Must be logged in';
}
?>
<h1><a href="index.php">Return to Index</a></h1>
