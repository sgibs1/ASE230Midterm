<html>
<?PHP
session_start();
require('auth/auth.php');       //Only display the login form if a user is logged in
if (is_logged() == true) { ?>
<body>
<h2>HTML Forms</h2>

<form method="post" action="processModify.php?i=<?= $_GET['i'] ?>">
  <label for="author">Author's Name</label><br>
  <input type="text" name="author" placeholder="Author"><br>       <!--Form sends data to another php page to process and confirm -->
  <label for="quote">Quote</label><br>
  <input type="text" id="lname" name="quote" placeholder="Quote"><br><br>
  <input type="submit" value="Submit">
</form>

</body>
<?PHP }
else {
  echo "Must be logged in";
}
?>
<h3><a href="index.php">Return to Index</a></h3>
</html>
