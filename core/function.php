<?php

//common start
function check()
{
    if (con()) {
        echo "success";
    }
}

function textFilter($str)
{
    $text = trim($str);
    $text = htmlentities($text);
    $text = stripslashes($text);
    return $text;
}

function old($inputName)
{
    if (isset($_POST[$inputName])) {
        return $_POST[$inputName];
    } else {
        return "";
    }
}

function link_To($location)
{
    echo "<script>location.href='$location'</script>";
}

//common end

//error start

function set_Error($inputName, $message)
{

    $_SESSION['error'][$inputName] = $message;

}

function clean_error()
{
    $_SESSION['error'] = [];
}

function getError($inputName)
{
    if (isset($_SESSION['error'][$inputName])) {
        return $_SESSION['error'][$inputName];
    } else {
        return "";
    }
}

//error end

//friend start

function friends()
{

    $sql = "SELECT * FROM friends";
    $query = mysqli_query(con(), $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($rows, $row);
    }

    return $rows;
}

//friend end

//auth start

function add()
{

    $error_status = 0;
    $name = "";
    $email = "";
    $phone = "";
    $profile = "";
    //Name---------------------------------------------------->//
    if (empty($_POST['name'])) {
        set_Error('name', "Name Required.");
        $error_status = 1;
    } else if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $_POST['name'])) {

        set_Error("name", "Name must be letters,number and white space.");
        $error_status = 1;

    } else {
        $name = textFilter($_POST['name']);
    }

    //Email---------------------------------------------------->//
    if (empty($_POST['email'])) {
        set_Error('email', "Email Required.");
        $error_status = 1;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        set_Error("email", "Invalid Email.");
        $error_status = 1;

    } else {
        $email = textFilter($_POST['email']);
    }

    //Phone---------------------------------------------------->//
    if (empty($_POST['phone'])) {

        set_Error("phone", "Phone Number Required.");
        $error_status = 1;

    } else if (!preg_match("/^[0-9-' ]*$/", $_POST['phone'])) {

        set_Error("phone", "Invalid phone number");
        $error_status = 1;

    } else {
        $phone = textFilter($_POST['phone']);
    }

    //Profile---------------------------------------------------->//

    $support_file_type = ["image/png", "image/jpeg"];

    if ($_FILES['profile']['name']) {

        if (in_array($_FILES['profile']['type'], $support_file_type)) {

            $profile = $_FILES['profile']['name'];

        } else {
            set_Error("profile", "Invalid image type");
            $error_status = 1;
        }

    } else {
        set_Error("profile", "Profile Photo Required.");
        $error_status = 1;
    }


    if ($error_status == 0) {
        uploadImg();

        $query = "insert into friends(name,email,phone,photo) values('$name','$email','$phone','$profile')";
        mysqli_query(con(), $query);
        link_To("index.php");
    }

}

function uploadImg()
{
    $name = $_FILES['profile']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["profile"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {

        // Insert record
        $query = "insert into images(name) values('" . $name . "')";
        mysqli_query(con(), $query);

        // Upload file
        move_uploaded_file($_FILES['profile']['tmp_name'], $target_dir . $name);

    }
}

function getUploadedImage($id)
{
    $sql = "select * from images where id=$id";
    $result = mysqli_query(con(), $sql);
    $row = mysqli_fetch_assoc($result);

    return $row['name'];
}

//auth end


?>