<?php
 require_once ("include/initialize.php"); 


    //if user click verification code submit button
    if(isset($_POST['check'])){
        $con = mysqli_connect('localhost', 'root', '', 'db_ecommerce');
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $legit_code = "SELECT code FROM tblcustomer WHERE code = '$otp_code';";
        $code_res = mysqli_query($con, $legit_code);
                if(mysqli_num_rows($code_res) === 0){
                                                          echo "<script> alert('Incorrect Code');</script>";
                                                            echo "<script> window.location='index.php';</script>";


        }else{
                                $fetch_data = mysqli_fetch_assoc($code_res);
                    $fetch_code = $fetch_data['code'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE tblcustomer SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                        $emails = $_SESSION['emails'];
                        $_SESSION['info'] = "";
                        $subject = "Email Verification";
                        $message = "Your Email $emails is Successfuly Verified!";
                        $sender = "From: thentadashi@gmail.com";

                    if(mail($emails, $subject, $message, $sender))
                                      echo "<script> alert('Email Verification Successful!');</script>";
                                                            echo "<script> window.location='index.php?q=profile';</script>";

            }else{
                                      echo "<script> alert('Failed while updating code!');</script>";
                                                            echo "<script> window.location='index.php?q=profile';</script>";

            }

        }
    }


?>