<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>authorization</title>
</head>

<body>
    <div style="width:50%; margin:50px auto; line-height:36px;zoom:7">
    <form class="form" action="" method="POST">
        <input type="email" name="email" placeholder="email">
        <input type="submit" name="submit" value="generate">

    </form>

    <?php

    include_once "../autoloader.php";

    if( $_SERVER['REQUEST_METHOD'] != 'POST')
        die();

    $email=$_POST['email'];
    $user=getUserByEmail($email);
    
    if(is_null($user))
       die("user not exist");

       $jwt = createApiToken($user);
       echo "jwt token for $user->name : <br><textarea style='width:100%'>$jwt</textarea>";   



    
    
    
    
    ?>







    </div>
    
</body>
</html>

