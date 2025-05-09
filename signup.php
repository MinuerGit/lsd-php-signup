<?php

$message = "";
$msgType = "success";

if (isset($_POST["signup"])){
print_r($_POST);

require('config.php');

$name = $_POST ["name"];
$email = $_POST ["email"];
$pwd = $_POST ["password"];

$query = "select iduser from user where email = '$email'";
$emailResult = mysqli_query($connection, $query);



if (mysqli_num_rows($emailResult) == 0) {
    $message = "User registado";

    $query = "insert into user (name, email, password) values ('$name', '$email', '$pwd')";

    mysqli_query($connection,$query);

    echo $query;
} else {
    $message = "Email já se encontra registado";
    $msgType = "danger";
};

// avatar 

if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] !== "") {
    $targetFile = "./images/".uniqid().basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
};




};



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
       
    <?php if ($message !== "") { ?>
        <div class="alert alert-<?php echo $msgType;?>" role="alert">
        <?php echo $message; ?>
    </div>
     <?php }?>
    


        <h1>Sign up here ...</h1>


        <form method="post" enctype="multipart/form-data">

            <img src="https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-512.png" class="img-thumbnail w-25" alt="...">
            <div class="mb-3">
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input class="form-control" type="file" name="image" id="image">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
            </div>

            <button type="submit" name="signup" class="btn btn-primary">Signup</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>