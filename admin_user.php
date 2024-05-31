<?php 
include "header.php"; 

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_type = $_POST["user_type"];
    
    // Display submitted data in a table
    echo "<h2>Submitted Data</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th><th>Password</th><th>User Type</th></tr>";
    echo "<tr><td>$name</td><td>$email</td><td>$password</td><td>$user_type</td></tr>";
    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styles.css">
   <title>@ben's</title>
    
</head>
<body>
   <div class="form-container">
      <h1>Add a user</h1>
      <form action="" method="post">
         <label for="name">Name:</label>
         <input type="text" name="name" id="name" required placeholder="Enter your name">

         <label for="email">Email:</label>
         <input type="email" name="email" id="email" required placeholder="Enter your email">

         <label for="password">Password:</label>
         <input type="password" name="password" id="password" required placeholder="Enter your password">

         <label for="cpassword">Confirm Password:</label>
         <input type="password" name="cpassword" id="cpassword" required placeholder="Confirm your password">

         <label for="user_type">User Type:</label>
         <select name="user_type" id="user_type">
            <option value="admin">Admin</option>
            <option value="user">User</option>
         </select>

         <input type="submit" name="submit" value="Register Now">
      </form>
   </div>
</body>
</html>

<?php
include 'config.php';

// Fetch all users from the database
$query = "SELECT * FROM user_form";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>


   <h2>Registered Users</h2>
   <table>
      <tr>
         <th>Name</th>
         <th>Email</th>
         <th>User Type</th>
      </tr>
      <?php
      // Loop through each row of the result set
      while ($row = mysqli_fetch_assoc($result)) {
         echo "<tr>";
         echo "<td>" . $row['name'] . "</td>";
         echo "<td>" . $row['email'] . "</td>";
         echo "<td>" . $row['user_type'] . "</td>";
         echo "</tr>";
      }
      ?>
   </table>
</body>
<?php include 'footer.php' ?>
</html>

