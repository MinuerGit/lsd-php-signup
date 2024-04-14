<?php

$result = true;
$name = "";
$email = "";
$password = "";
$msgtype = "";
$msg = "";
$image = "https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-512.png";
$target_dir = 'uploads/';

// read values to fill input values (signup moment)
if (isset($_POST['signup'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // read user image profile
    if (isset($_FILES['image']) && $_FILES["image"]["tmp_name"] !== "") {

        // exemplo de target_file '/uploads/3.jpg'
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $uploadOK = true;

        // Check if user is realy uploading an image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $result = false;
            $msg = "Imagem de perfil inválida";
            $msgtype = "danger";
        } else {
            // move uploaded file from server tmp space to our project directory
            $result = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            if ($result) {
                // correu bem
                $image = $target_file;
            } else {
                // houve erros
                $result = false;
                $msg = "Erro no upload da imagem de perfil";
                $msgtype = "danger";
            }
        }
    }
    // Backend code to write users on a file
    // Now we are going to write signup user to 'user' table
    require('config.php');

    // check if email is already registered
    $selectEmail = "select * from user where email = '$email'";
    $emailResult = mysqli_query($connection, $selectEmail);
    //print_r( $emailResult) ;

    if (isset($emailResult)) {

        if (mysqli_num_rows($emailResult) == 0) {
            // email is not registered

            // encrypt password
            $encryptedPassword = md5($password);

            $insert = "insert into user (name, email, password, profile) values ('$name', '$email', '$encryptedPassword', '$image')";
            //print_r( $connection );
            //echo $insert;
            mysqli_query($connection, $insert);
        } else {
            $result = false;
            $msg = "Email already registered";
            $msgtype = "danger";
        }
    }



    // fwrite returns false if some error exists
    if ($result) {
        //ok
        $msg = "User criado com sucesso";
        $msgtype = "success";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Sign up here ...</h1>

        <div class="alert alert-<?php echo $msgtype; ?>" role="alert">
            <?php echo $msg; ?>
        </div>
        <form method="post" enctype="multipart/form-data">

            <img src="<?php echo $image; ?>" class="img-thumbnail w-25" alt="...">
            <div class="mb-3">
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input class="form-control" type="file" name="image" id="image">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $email; ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" value="<?php echo $password; ?>">
            </div>

            <button type="submit" name="signup" class="btn btn-primary">Signup</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>