<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User login system</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="container">
    <div class="alert alert-success my-5">
      Welcome ! You are now signed in to your account.
    </div>
    <!-- User profile -->
    <div class="row justify-content-center">
      <div class="col-lg-5 text-center">
        <img src="./img/user.gif" class="img-fluid rounded" alt="User avatar" width="180">
        <h4 class="my-4">Hello, <?= htmlspecialchars($_SESSION["username"]); ?></h4>
        <a href="./addblog.php" class="btn btn-primary">Add text</a>
      </div>

      <div>
        <?php
        // Step 1: Connect to the MySQL database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "registered";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Step 2: Retrieve data from the database
        $sql = "SELECT blogtitle, blogtext, user, time FROM blog";
        $result = $conn->query($sql);

        // Step 3: Loop through the data and display it
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-6'>";
            echo "<div class='blog-post'>";
            echo "<h2 class='blog-title'><strong>Title:</>" . $row["blogtitle"] . "</h2>";
            echo "<p class='blog-content'><strong>Text:</strong> " . $row["blogtext"] . "</p>";
            echo "<p class='blog-content'><strong>User:</strong> " . $row["user"] . "</p>";
            echo "<p class='blog-content'><strong>Time:</strong> " . $row["time"] . "</p>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "<p>No data found</p>";
        }
        $conn->close();
        ?>
      </div>


    </div>
  </div>
</body>

</html>