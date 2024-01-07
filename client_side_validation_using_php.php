<!-- Fetching images from database after matching the name in database. -->

<?php
if (isset($_POST['submit'])) {
    
    $flag = true;
    require_once('database.php');
    $uname = $conn->real_escape_string($_POST['uname']);

    if($uname === '')
    {
        $flag = false;
    }
    if($flag === true) {
    $sql = "SELECT * FROM data_image WHERE practical_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    // $result = htmlspecialchars($conn->query($sql));
    $row = $result->fetch_assoc();
    if($row) {
    $image_path = $row['practical_imagepath'];
    } else {
        $msg = 'couldn\'t find user';
    }

    //Closing section
    $stmt->close();
    $conn->close();
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve images</title>
    <style>
        div.image {
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="form-content">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Name : </label>
            <input type="text" name="uname" id="username" placeholder="<?php echo 'Please fill out the name'; ?>">
            <input type="submit" name='submit' value="submit">
        </form>
    </div>
    <p><?php echo isset($_POST['submit']) ? $flag === false ? "Sorry, username can't be empty" : '' : ''; ?></p>
    <p><?php echo isset($_POST['submit']) ? isset($msg) ? $msg : '' : ''; ?></p>

    <div class="image">
        <img src="<?php
        if (isset($image_path) && isset($_POST['submit'])) {
            echo $image_path;
        }
        ?>" alt="">
    </div>
</body>

</html>






<!-- database.php file contents -->

<!-- 

    DON'T FORGET TO ENCLOSE THE DATABASE FILE IN PHP TAG.

    And change the login-credentials according to your need.

// $db_host = "localhost";
// $db_user = "root";
// $db_pass = "";
// $db_name = "practical";

// $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
//     if ($conn->connect_error) {
//         die("Unexpected Error occured". $conn->connect_error);
//     }
-->

<!-- Thank you 😊✌️ -->