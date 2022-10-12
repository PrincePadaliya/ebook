<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
    <?php include 'links.php'?>
</head>
<body>

    <?php
    
    include 'dbcon.php';

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email_search = " select * from registration where email='$email' ";
        $query = mysqli_query($con,$email_search);

        $email_count = mysqli_num_rows($query);

        if($email_count){
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['password'];

            $_SESSION['username'] = $email_pass['username'];

            $pass_decode = password_verify($password, $db_pass);

            if($pass_decode){
                echo "login successful";
                ?>
                <script>
                    location.replace("index2.php");
                </script>
                <?php
            }else{
                echo "password Incorrect";
            }

        }else{
            echo "Invalid Email";
        }
    }
 
    ?>




    <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Login Account</h4>
            <p class="text-center">Get started with your free account</p>
            <p>
                <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
                <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
            </p>
            <p class="divider-text">
                <span class="bg-light">OR</span>
            </p>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                 </div>
                <input name="email" class="form-control" placeholder="Email ID" type="email">
            </div> <!-- form-group// -->
            
            
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input class="form-control" placeholder="password" type="password" name="password" value="">
            </div> <!-- form-group// -->
                                                 
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block"> Login Now </button>
            </div> <!-- form-group// -->      
            <p class="text-center"> don't Have an account? <a href="regis.php"> Sign Up Here</a> </p>                                                                 
        </form>
        </article>
        </div>
</body>
</html>