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
  <link rel="stylesheet" href="./css/main.css" />
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon" />
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <h4>Welcome ! You are now <br> signed in to your account.</h4>
        <!-- User profile -->
        <img src="./img/user.gif" class="img-fluid rounded" alt="User avatar" width="180">
        <h4 class="my-4">Hello, <?= htmlspecialchars($_SESSION["username"]); ?></h4>
        <a href="./addblog.php" class="btn btn-primary">Add text</a>
      </div>

      <div class="col-sm-9">
        <h4><small>RECENT POSTS</small></h4>
        <hr>
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
            echo "<h2>" . $row["blogtitle"] . "</h2>";
            echo "<h5><span class='glyphicon glyphicon-time'></span> " . $row["time"] . "</span></h5>";
            echo "<h5><span class='label label-danger'> " . $row["user"] . "</span></h5><br>";
            echo "<p>" . $row["blogtext"] . "</p><hr>";
          }
        } else {
          echo "<p>No data found</p>";
        }
        ?>
        <h4>Leave a Comment:</h4>
        <form role="form">
          <div class="form-group">
            <textarea class="form-control" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <br><br>

        <p><span class="badge badge-secondary">2</span> Comments:</p><br>

        <div class="row">
          <div class="col-sm-2 text-center">
            <img src="./img/blank-avatar.jpg" class="img-circle" height="65" width="65" alt="Avatar">
          </div>
          <div class="col-sm-10">
            <h4><?= htmlspecialchars($_SESSION["username"]); ?> <small>Sep 29, 2015, 9:12 PM</small></h4>
            <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit,
              sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <br>
          </div>
        </div>


      </div>
    </div>
  </div>
</body>

</html>