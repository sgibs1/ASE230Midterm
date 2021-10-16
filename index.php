<html>
<?PHP
session_start();
require('csv_util.php');      //require neccesary files
require('auth/auth.php');
$quotes=readCSV('quotes.csv');    //input csv files
$authors=readCSV('authors.csv');
if (is_logged() == true) {           //Checked if logged in to display the status to the user
  echo 'Logged in';
 }
 else {
   echo 'Logged out';
 }
 ?>
 <h3><a href="auth/signin.php">Sign In</a></h3>     <!-- Links to corresponding sign in, sign up, and sign out pages -->
 <h3><a href="auth/signup.php">Sign Up</a></h3>
 <h3><a href="auth/signout.php">Sign Out</a></h3>
 <?PHP
for($i = 0; $i < count($quotes) ; $i++) {
  ?>
    <H1>
      "<?PHP echo $quotes[$i][0]; ?>"                 <!-- This for loop displays quotes and authors from the csv files. -->
    </H1>
    <br>
    <H2>
      -<?PHP echo $authors[$quotes[$i][1]][0]; ?>
    </H2>
    <h5><a href="detail.php?i=<?= $i ?>">Detail Page</a></h5>     <!-- Link to detail pages -->
  <?PHP
}
if (is_logged() == true) {
?>
<h2><a href="create.php?i=<?= $i ?>">Add Quote</a></h2>        <!-- If a user if logged in we display an add option for quotes. --> 
</html>
<?PHP } ?>
