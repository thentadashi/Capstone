<?php
require_once ("../include/initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	


	case 'delete' :
	doDelete();
	break;

 

	case 'processorder' :
	processorder();
	break;

	case 'addwish' :
	addwishlist();
	break;

	case 'wishlist' :
	processwishlist();
	break;

	case 'photos' :
	doupdateimage();
	break;

	case 'changepassword' :
	doChangePassword();
	break;


	}




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
   
function doInsert(){
	global $mydb;
	if(isset($_POST['submit'],$_POST['g-recaptcha-response'])){

		$captchaSiteKey = '6LcpK0seAAAAAM9IMegi_-i2Sn-J2nEuC3NSe6pJ';
		$captchaSecretKey = '6LcpK0seAAAAAEUgyRPN8j-T2gD774qLRN4G1nzv';

		$createGoogleUrl = 'https://www.google.com/recaptcha/api/siteverify?secret='.$captchaSecretKey.'&response='.$_POST['g-recaptcha-response'];
		$verifyRecaptcha = curlRequest($createGoogleUrl);
        $decodeGoogleResponse = json_decode($verifyRecaptcha,true);
 
        if($decodeGoogleResponse['success'] == 1){
		          $email = trim($_POST['EMAILADD']);
		          		$customer = New Customer(); 
				    	$code = rand(999999, 111111);
						$customer->FNAME 			= $_POST['FNAME'];
						$customer->LNAME 			= $_POST['LNAME']; 	
					    //$customer->MNAME 			= $_POST['MNAME'];	
						$customer->CUSHOMENUM 		= $_POST['CUSHOMENUM'];
						$customer->STREETADD		= $_POST['STREETADD'];
						$customer->BRGYADD 			= $_POST['BRGYADD'] ;
						$customer->CITYADD  		= $_POST['CITYADD'];
					///	$customer->PROVINCE 		= $_POST['PROVINCE'];
						//$customer->COUNTRY 		    = $_POST['COUNTRY'];
						$customer->GENDER 			= $_POST['GENDER'];
					 	$customer->PHONE 			= $_POST['PHONE'];
					 	$customer->ZIPCODE 			= $_POST['ZIPCODE']; 	 
					    $customer->EMAILADD 		= $_POST['EMAILADD']; 	
						$customer->CUSUNAME			= $_POST['CUSUNAME'];
						$customer->DBIRTH           = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
						$customer->CUSPASS			= sha1($_POST['CUSPASS']);	
						$customer->DATEJOIN 		= date('Y-m-d h-i-s');
						$customer->code             = $code;
						$customer->status           = $status = 'NotVerified';
						$customer->CUSPHOTO			= $CUSPHOTO = 'customer_image/avatar.png';
						$customer->TERMS 			= 1;

					$con = mysqli_connect('localhost', 'root', '', 'db_ecommerce');
					$email_check = "SELECT * FROM tblcustomer WHERE EMAILADD = '$email'";
				    $res = mysqli_query($con, $email_check);
				    $fetch = mysqli_fetch_assoc($res);
                    $status = $fetch['EMAILADD'];
            if($status ===  $customer->EMAILADD ){
                      echo "<script> alert('Email Already Existed');</script>";
                      redirect(web_root."index.php");
		}else{

						//Customer Register
						$customer->create();
						$email = trim($_POST['EMAILADD']);
						$h_upass = sha1(trim($_POST['CUSPASS']));




						            $subject = "Email Verification Code";
						            $message = "[IT MAN]
						            						Thank you for Registering, ".$customer->CUSUNAME."
																		Your Account:
																		Email: ".$email."
																		Your verification code is $customer->code";
						            $sender = "From: thentadashi@gmail.com";

						        if(mail($email, $subject, $message, $sender)){

							                $info = "We've sent a verification code to your email - $email";
							                $emails = "$email";
							                $_SESSION['info'] = $info;
							                $_SESSION['emails'] = $emails;



						//it creates a new objects of member
					    $user = new Customer();
					    //make use of the static function, and we passed to parameters
					    $res = $user->cusAuthentication($email, $h_upass); 


					 
			 if(!isset($_POST['proid']) || (isset($_POST['proid']) && empty($_POST['proid']))){
			  			echo "<script> alert('You are now successfully registered. It will redirect to your order details.'); </script>";
						redirect(web_root."index.php?q=orderdetails");
			 }else{
			 	$proid = $_GET['proid'];
			 	$id = mysqli_insert_id(); 
			 	$query ="INSERT INTO `tblwishlist` (`PROID`, `CUSID`, `WISHDATE`, `WISHSTATS`)  VALUES ('{$proid}','{$id}','".DATE('Y-m-d')."',0)";
			 	$mydb->setQuery($query);
			 	$mydb->executeQuery();
			 	 echo "<script> alert('You are now successfully registered. It will redirect to your profile.'); </script>";
						redirect(web_root."index.php?q=profile");
			 }
			}else{
             echo "<script> alert('Failed while sending code!'); </script>";
						redirect(web_root."index.php");
            }
		 
		

		  }
			 }else{
                      echo "<script> alert('Error! validating Recaptcha');</script>";
                      						redirect(web_root."index.php");
			 }
			
			}
	  
	}
 



	function doEdit(){
		if(isset($_POST['save'])){


			
			$customer = New Customer();
			// $customer->CUSTOMERID 		= $_POST['CUSTOMERID'];
			$customer->FNAME 			= $_POST['FNAME'];
			$customer->LNAME 			= $_POST['LNAME'];
			// $customer->MNAME 			= $_POST['MNAME'];
			$customer->CUSHOMENUM 		= $_POST['CUSHOMENUM'];
			$customer->STREETADD		= $_POST['STREETADD'];
			$customer->BRGYADD 			= $_POST['BRGYADD'] ;			
			$customer->CITYADD  		= $_POST['CITYADD'];
			$customer->PROVINCE 		= $_POST['PROVINCE'];
			$customer->COUNTRY 			= $_POST['COUNTRY'];
			$customer->GENDER 			= $_POST['GENDER'];
		 	$customer->PHONE 			= $_POST['PHONE'];
			$customer->ZIPCODE 			= $_POST['ZIPCODE']; 
			$customer->CUSUNAME			= $_POST['CUSUNAME'];
			$customer->CUSPASS			= sha1($_POST['CUSPASS']);	
			$customer->update($_SESSION['CUSID']);


			message("Accounts has been updated!", "success");
			redirect(web_root.'index.php?q=profile');
		}
	}




	function doDelete(){

		if(isset($_SESSION['U_ROLE'])=='Customer'){

			if (isset($_POST['selector'])==''){
			message("Select the records first before you delete!","error");
			redirect(web_root.'index.php?page=9');
			}else{
		
			$id = $_POST['selector'];
			$key = count($id);

			for($i=0;$i<$key;$i++){ 

			$order = New Order();
			$order->delete($id[$i]);
 
			message("Order has been Deleted!","info");
			redirect(web_root."index.php?q='product'"); 


		} 


		}
	}else{

		if (isset($_POST['selector'])==''){
			message("Select the records first before you delete!","error");
			redirect('index.php');
			}else{

			$id = $_POST['selector'];
			$key = count($id);

			for($i=0;$i<$key;$i++){ 

			$customer = New Customer();
			$customer->delete($id[$i]);

			$user = New User();
			$user->delete($id[$i]);

			message("Customer has been Deleted!","info");
			redirect('index.php');

			}
		}

	}
		
	}

	 
		function processorder(){

		 
 
		//	$_SESSION['ORDEREDNUM'] = $_POST['ORDEREDNUM'];
			 
			
		 	// $autonumber = New Autonumber();
 			// $res = $autonumber->set_autonumber('ordernumber');


			$count_cart = count($_SESSION['gcCart']);
             for ($i=0; $i < $count_cart  ; $i++) { 
 
			$order = New Order();
			$order->PROID		    = $_SESSION['gcCart'][$i]['productid']; 
			$order->ORDEREDQTY		= $_SESSION['gcCart'][$i]['qty'];
			$order->ORDEREDPRICE	= $_SESSION['gcCart'][$i]['price'];   
			$order->ORDEREDNUM		= $_POST['ORDEREDNUM']; 
	     	$order->create(); 
 
		  	$product = New Product();			 
			$product->qtydeduct($_SESSION['gcCart'][$i]['productid'],$_SESSION['gcCart'][$i]['qty']); 


			$summary = New Summary();
			$summary->ORDEREDDATE 	= date("Y-m-d h:i:s");
			$summary->CUSTOMERID		= $_SESSION['CUSID'];
			$summary->ORDEREDNUM  	= $_POST['ORDEREDNUM'];  
			$summary->DELFEE  		= $_POST['PLACE']; 
			$summary->PAYMENTMETHOD	= $_POST['paymethod'];
			$summary->PAYMENT 		= $_POST['alltot'];
			$summary->ORDEREDSTATS 	= 'Pending';
			$summary->CLAIMEDDATE		= $_POST['CLAIMEDDATE'];
			$summary->ORDEREDREMARKS 	= 'Your order is on process.';
			$summary->HVIEW 			= 0	;
			$summary->create();
		  }

     


		$autonumber = New Autonumber();
		$autonumber->auto_update('ordernumber');

 
		unset($_SESSION['gcCart']);  
		unset($_SESSION['orderdetails']); 

			 	 echo "<script> alert('Order Created successfully!.'); </script>";
						redirect(web_root."index.php?q=profile");

		}
			 


	function processwishlist(){
		global $mydb;
		if(isset($_GET['wishid'])){

		  $query ="UPDATE `tblwishlist` SET `WISHSTATS`=1  WHERE `WISHLISTID`=" .$_GET['wishid'];
	      $mydb->setQuery($query);
	      $res = $mydb->executeQuery();
		 if (isset($res)){
						 	 echo "<script> alert('Product has been removed in your wishlist!.'); </script>";
						redirect(web_root."index.php?q=profile");
		 }

		

		}
		

		}
			 

	function addwishlist(){
		global $mydb;

		$proid = $_GET['proid'];
		$id =$_SESSION['CUSID'];

		$query="SELECT * FROM `tblwishlist` WHERE  CUSID=".$id." AND `PROID` =" .$proid ;
		$mydb->setQuery($query);
		$res = $mydb->executeQuery();
		$maxrow = $mydb->num_rows($res);

		if($maxrow>0){
				message("Product is already added to your wishlist", "error"); 		 
				redirect(web_root."index.php?q=profile"); 
		}else{
				$query ="INSERT INTO `tblwishlist` (`PROID`, `CUSID`, `WISHDATE`, `WISHSTATS`)  VALUES ('{$proid}','{$id}','".DATE('Y-m-d')."',0)";
				$mydb->setQuery($query);
				$mydb->executeQuery();
			 
	 	message("Product has been added to your wishlist", "success"); 		 
			redirect(web_root."index.php?q=profile"); 
		}
			 
			 
	 

		}
		function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="customer_image/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect(web_root. "index.php?q=profile");
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message(web_root. "Uploaded file is not an image!", "error");
				redirect(web_root. "index.php?q=profile");
			}else{
					//uploading the file
					move_uploaded_file($temp,"customer_image/" . $myfile);
		 	
					 
						$customer = New Customer(); 
						$customer->CUSPHOTO 		= $location; 
						$customer->update($_SESSION['CUSID']); 

						redirect(web_root. "index.php?q=profile");
						 
							
					}
			}
			 
		}


		function doChangePassword(){
			if (isset($_POST['save'])) {
				# code...
				$customer = New Customer(); 
				$customer->CUSPASS			= sha1($_POST['CUSPASS']);	
				$customer->update($_SESSION['CUSID']);


			message("Password has been updated!", "success");
			redirect(web_root.'index.php?q=profile');
			}
		}
 
 
?>