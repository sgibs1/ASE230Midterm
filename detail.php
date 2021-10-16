<html>
<?PHP
session_start();
require('csv_util.php');                     //require the neccesary files
require('auth/auth.php');

$quotes=readCSV('quotes.csv');              //pull data from csv files
$authors=readCSV('authors.csv');
?>
<H1>
  "<?PHP echo $quotes[$_GET['i']][0]; ?>"                <!--display the data for the selected quotes -->
</H1>
<br>
<H2>
  -<?PHP echo $authors[$quotes[$_GET['i']][1]][0]; ?>
</H2>
<?PHP if (is_logged() == true) { ?>
<h5><a href="delete.php?i=<?= $_GET['i'] ?>">Delete Quote</a></h5>        <!--Only display options to delete and modify to logged in users -->
<h5><a href="modify.php?i=<?= $_GET['i'] ?>">Modify Quote</a></h5>
<?PHP } ?>
</html>
