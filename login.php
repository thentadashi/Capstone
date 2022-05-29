 <?php
 require_once ("include/initialize.php"); 
 if (@$_GET['page'] <= 2 or @$_GET['page'] > 5) {
  # code...
    // unset($_SESSION['PRODUCTID']);
    // // unset($_SESSION['QTY']);
    // // unset($_SESSION['TOTAL']);
} 


 
if(isset($_POST['sidebarLogin'])){
  $email = trim($_POST['U_USERNAME']);
  $upass  = trim($_POST['U_PASS']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect(web_root."index.php");
         
    } else {   
        $cus = new Customer();
        $cusres = $cus::cusAuthentication($email,$h_upass);

        if ($cusres==true){


           redirect(web_root."index.php");
        }else{
             message("Invalid Username and Password! Please contact administrator", "error");
             redirect(web_root."index.php");
        }
 
 }

}

$captchaSiteKey = '6LcpK0seAAAAAM9IMegi_-i2Sn-J2nEuC3NSe6pJ';
$captchaSecretKey = '6LcpK0seAAAAAEUgyRPN8j-T2gD774qLRN4G1nzv';

function curlRequest($url)
{
    $ch = curl_init();
    $getUrl = $url;
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $getUrl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 80);
    
    $response = curl_exec($ch);
    return $response;
    
    curl_close($ch);
    
}





 if(isset($_POST['modalLogin'],$_POST['g-recaptcha-response']))
{

        $createGoogleUrl = 'https://www.google.com/recaptcha/api/siteverify?secret='.$captchaSecretKey.'&response='.$_POST['g-recaptcha-response'];
        $verifyRecaptcha = curlRequest($createGoogleUrl);
        $decodeGoogleResponse = json_decode($verifyRecaptcha,true);
 
        if($decodeGoogleResponse['success'] == 1)
        {
          $email = trim($_POST['U_USERNAME']);
          $upass  = trim($_POST['U_PASS']);
          $h_upass = sha1($upass);  

            if ($email == '' OR $upass == '') 
                { 
                  echo "<script> alert('Please Type Email and Password');</script>";
                  echo "<script> window.location='index.php?page6';</script>";

                }else{

                            $cus = new Customer();
                            $cusres = $cus::cusAuthentication($email,$h_upass);

                            if ($cusres==true){

                        $conn = mysqli_connect('localhost', 'root', '', 'db_ecommerce');
                        $email = mysqli_real_escape_string($conn, $_POST['U_USERNAME']);
                        $check_email = "SELECT * FROM tblcustomer WHERE EMAILADD = '$email'";
                        $res = mysqli_query($conn, $check_email);
                        $fetch = mysqli_fetch_assoc($res);
                        $status = $fetch['status'];
                        if($status == 'verified'){






                               if($_POST['proid']==''){
                                redirect(web_root."index.php");
                               }else{
                                  $proid = $_POST['proid'];
                                  $id = mysql_insert_id(); 
                                  $query ="INSERT INTO `tblwishlist` (`PROID`, `CUSID`, `WISHDATE`, `WISHSTATS`)  VALUES ('". $proid."','".$_SESSION['CUSID']."','".DATE('Y-m-d')."',0)";
                                  mysql_query($query) or die(mysql_error());
                                  redirect(web_root."index.php?q=profile");
                                 }
                                                        }else{

                                $info = "It's look like you haven't still verify your email - $email";
                                $_SESSION['info'] = $info;
                                  echo "<script> alert('You need to Verify your Email');</script>";
                                  redirect(web_root."index.php?q=verify");

                        }

                             
                            }else{

                                echo "<script> alert('Incorrect Email or Password!');</script>";
                                  echo "<script> window.location='index.php';</script>";
                                 }
 
                }
        }

        else{
                      echo "<script> alert('Error! validating Recaptcha');</script>";
                      echo "<script> window.location='index.php?page6';</script>";
                         
            }
 }




    