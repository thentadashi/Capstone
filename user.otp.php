<?php require_once ("include/initialize.php");





 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-md-5 form">
                <form action="verification.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                            <input type="email" class="form-control" value="<?php echo $_SESSION['emails'];?>">
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success m5" type="submit" name="check" value="Submit">
                                                <a href="logout.php" class="btn btn-lite"  name="check">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>