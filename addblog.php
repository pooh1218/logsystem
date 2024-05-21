<?php
session_start();
include ("config.php");

if (!isset($_SESSION["email"])) {
    header("Location: index.php");
}

if ($_POST) {
    $title = $_POST["title"];
    $text = $_POST["text"];
    $user = $_SESSION["username"];
    $titlenumber = strlen($title);
    if ($titlenumber > 80) {
        $errormsg = "Title is too long.";
    } else {
        if ($title != "" && $text != "") {
            $query = $link->prepare("INSERT INTO blog SET blogtitle=?, blogtext=?, user=?, time=?");
            $addblog = $query->execute(array($title, $text, $user, date("Y-m-d H:i:s")));
            if ($addblog) {
                $errormsg = "Text Added.";
            } else {
                $errormsg = "Could not add text.";
            }
        } else {
            $errormsg = "Do not leave empty space!";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <form method="POST">
                    <input type="text" name="title" class="form-control" placeholder="Title">
                    <textarea name="text" class="form-control mt-1" cols="30" row="10" placeholder="Text"></textarea>
                    <?php
                    if (!empty($errormsg)) {
                        ?>
                        <div class="alert alert-success mt-1" role="alert">
                            <?php echo $errormsg; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="submit" class="btn btn-warning mt-1">Publish</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>