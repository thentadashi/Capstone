 <!-- sign up modal -->
 <div class="modal fade" id="smyModal" tabindex="-1">
 
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
     
      <div class="modal-body">
         
              <!-- Nav tabs -->

              <ul class="nav nav-pills">
                  <li class="active"><a class="btn btn-default check_out" href="#home" data-toggle="tab">Login</a>
                  </li>
                  <li><a class="btn btn-default check_out" href="#profile" data-toggle="tab">Sign Up</a>
                  </li>
                  
              </ul>

              <!-- Tab panes  login panel-->
              <div class="tab-content">
                  <div class="tab-pane fade in active" id="home">
                      <!-- <h4>Login Tab</h4>  -->
                       <div class="panel panel-pup">
                        <div class="panel-heading">
                            Login Details
                        </div>
                        <div class="panel-body">

                           <form class="form-horizontal span6" name=""  action="login.php" method="POST">
                              <input class="proid" type="hidden" name="proid" id="proid" value="">
                                <div class="form-group">
                                  <div class="col-md-10">
                                    <label class="col-md-4 control-label" for=
                                    "U_USERNAME">Username:</label>
                                    
                                    <div class="col-md-8">
                                       <input   id="U_USERNAME" name="U_USERNAME" placeholder="Username" type="text" class="form-control input-sm" > 
                             
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-md-10">
                                    <label class="col-md-4 control-label" for=
                                    "U_PASS">Password:</label>
                                    
                                    <div class="col-md-8">
                                     <input name="U_PASS" id="U_PASS" placeholder="Password" type="password" class="form-control input-sm">
                            
                                    </div>
                                  </div>
                                </div>

                                  <div class="form-group">
                                  <div class="col-md-10">
                                    <label class="col-md-4 control-label" for=
                                    "FIRSTNAME"> </label>
                                    
                                    <div class="col-md-8">
                                    <button type="submit" id="modalLogin" name="modalLogin" class="btn btn-pup"><span class="glyphicon glyphicon-log-in "></span>   Login</button> 
                                     <button class="btn btn-default" data-dismiss="modal" type="button">Close</button> 
                                     <div  style="margin-top: 10px;" class="g-recaptcha"  data-sitekey="6LcpK0seAAAAAM9IMegi_-i2Sn-J2nEuC3NSe6pJ"></div>
                                     <a href="index.php?q=recoverpassword" style="margin-top: 20px;">Forgot Password</a>
                                    </div>
                                  </div>
                                </div>


 
                            </form>

                                                                                                          
                       </div>
                        <div class="panel-footer">
                        <a href="<?php echo web_root?>"><img src="images/home/itmanlg.png" alt="" /></a>
                        </div>
                    </div> 
                  </div>
                  <!-- end login panel -->

                  <!-- sign in panel -->
                  <div class="tab-pane fade" id="profile">
                      <!-- <h4>Customer Details</h4>  --> 

                           <form  class="form-horizontal span6" action="customer/controller.php?action=add" onsubmit="return personalInfo();" name="personal" method="POST" enctype="multipart/form-data">
                                <div class="panel panel-pup">
                                    <div class="panel-heading">
                                       Customer Details (Pangasinan Area Only)                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                                    </div>
                                     <div class="panel-body">
                                      <input class="proid" type="hidden" name="proid" id="proid" value="">
                                      <div class="form-group">
                                        <div class="col-md-12">
                                          <!-- <input  id="CUSTOMERID" name="CUSTOMERID"  type="HIDDEN" value="<?php echo $res->AUTO; ?>">  -->
                                          <div class="col-md-6">
                                             <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder=
                                                "First Name" type="text" value="">
                                          </div>

                                          <div class="col-md-6" style="padding-left: 5px">
                                             <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder=
                                                "Last Name" type="text" value="">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                            <div class="col-md-12">

                                              <div class="col-md-3">
                                                 <input class="form-control input-sm" id="CUSHOMENUM" name="CUSHOMENUM" placeholder=
                                                    "House#" type="text" value="">
                                              </div>

                                              <div class="col-md-4" style="padding-left: 1px;">
                                                 <input class="form-control input-sm" id="STREETADD" name="STREETADD" placeholder=
                                                    "Street" type="text" value="">
                                              </div>

                                              <div class="col-md-5" style="padding-left: 1px;">
                                                 <input class="form-control input-sm" id="BRGYADD" name="BRGYADD" placeholder=
                                                    "Barangay" type="text" value="">
                                              </div>
                                            </div>
                                      </div>
                                      <div class="form-group">
                                            <div class="col-md-12">                                      
                                              <div class="col-md-7">
                                                            <select name="CITYADD" class="form-control input-sm">
                                                              <option value="">Municipal</option>
                                                                  <?php 
                                                                    $query = "SELECT * FROM `tblsetting` ";
                                                                    $mydb->setQuery($query);
                                                                    $cur = $mydb->loadResultList();

                                                                  foreach ($cur as $result) { 
                                                                    echo'<option value="'.$result->PLACE.'">'.$result->PLACE.'</option>';
                                                                  } 
                                                                  ?>
                                                            </select>  
                                              </div>
                                              <div class="col-md-5"style="padding-left: 1px;">
                                                 <input class="form-control input-sm" id="ZIPCODE" name="ZIPCODE" placeholder=
                                                    "Zip code" type="text" value="">
                                              </div>
                                            </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-12">

                                          <div class="col-md-12">
                                             <input class="form-control input-sm" id="EMAILADD" name="EMAILADD" placeholder=
                                                "Email" type="Email" value="">
                                          </div>
                                        </div>
                                      </div> 
    
                                       <div class="form-group">
                                        <div class="col-md-12">
                                          <div class="col-md-6">
                                             <input class="form-control input-sm" id="CUSUNAME" name="CUSUNAME" placeholder=
                                                "Username" type="text" value="">
                                          </div>
                                          <div class="col-md-6">
                                             <input class="form-control input-sm" id="CUSPASS" name="CUSPASS" placeholder=
                                                "Password" type="password" value=""><span></span>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="col-md-12">

                                          <div class="col-md-12">
                                          <p style="color:red;">Note</p>
                                            <p style="color:red;">Password must be atleast 8 to 15 characters. Only letter, numeric digits, underscore and first character must be a letter.</p>
                                         </div> 
                                        </div>
                                      </div> 
 
                                      <div class="form-group">
                                        <div class="col-md-12">

                                          <div class="col-md-12">
                                             <input class="form-control input-sm" id="PHONE" name="PHONE" placeholder=
                                                "Mobile Number" type="text" value="">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="col-md-12">
                                                  <label class="col-md-2 control-label" for=
                                                  "Birthday" style="margin-right: 15px;">BirthDate: </label>
                                                            <select name="month" class="form-control input-sm col-md-5" style="width: 120px; margin-left: 12px">
                                                            <option value="0" >Month</option>
                                                            <?php
                                                              for( $m = 1; $m <= 12; $m++ ) {
                                                                $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
                                                                $month =  date("F", mktime(0, 0, 0, $m, 1));
                                                                ?>
                                                                  <option value="<?php echo $num; ?>"><?php echo $month; ?></option>
                                                                <?php
                                                              }
                                                            ?>
                                                            </select>
                                                            <select name="day" class="form-control input-sm col-md-5" style="width: 80px;">
                                                            <option value="0">Day</option>
                                                            <?php
                                                              for( $a = 1; $a <= 31; $a++ ) {
                                                                ?>
                                                                  <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                                                <?php
                                                              }
                                                            ?>
                                                            </select>
                                                            <select name="year" class="form-control input-sm col-md-5" style="width: 100px;">
                                                            <option value="0">Year</option>
                                                            <?php
                                                              for( $y = 1950; $y <= 2021;  $y++) {
                                                                ?>
                                                                  <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                                <?php
                                                              }
                                                            ?>
                                                            </select>

                                                            </select>
                                                         
                                        </div>
                                      </div>

                                       <div class="form-group">
                                        <div class="col-md-12">
                                          <label class="col-md-1 control-label" for=
                                          "GENDER">Gender:</label>

                                          <div class="col-md-6" style="margin-top: 5px;margin-left: 55px;">
                                            <input  id="GENDER" name="GENDER" placeholder=
                                                "Gender" type="radio" checked="true" value="Male"><b> Male </b>
                                                <input   id="GENDER" name="GENDER" placeholder=
                                                "Gender" type="radio" value="Female"> <b> Female </b>
                                          </div>
                                        </div>
                                      </div>
                                                                                <hr style="color:#111;">
                                       <div class="form-group">
                                        <div class="col-md-10">
                                           <label class="col-md-1" for="image"></label>
                                          <div class="col-md-12" style="margin-left: 0px">
                                        <p>  <input type="checkbox" id="conditionterms" name="conditionterms" value="checkbox" style="cursor: pointer;" />
                                           <small>I Agree with the <a class="toggle-modal"  style="cursor: pointer;"onclick=" OpenPopupCenter('terms.php','Terms And Codition','600','600')"  ><b>TERMS AND CONDITION</b></a> of itman urdaneta city.</small>
                              <div  style="margin-left: 0px;" class="g-recaptcha"  data-sitekey="6LcpK0seAAAAAM9IMegi_-i2Sn-J2nEuC3NSe6pJ"></div>
                                           
                                          </div>
                                        </div>
                                      </div> 

                                      <div class="form-group">
                                        <div class="col-md-10">
                                           <label class="col-md-4" for=
                                          "image"></label>
                                          <div class="col-md-8">
                                            <input type="submit"  name="submit"  value="Sign Up"  class="submit btn btn-pup"  />
                                             <button class="btn btn-default" data-dismiss="modal" type=
                                                "button">Close</button> 
                                          </div>
                                        </div>
                                      </div> 



                                        

                                     </div>
                                    <div class="panel-footer">
                                     <a href="<?php echo web_root?>"><img src="images/home/itmanlg.png" alt="" /></a>
                                    </div> 
                            </div> 
                            <!-- end panel sign up -->
                        </form>  
                   </div> 
              </div>
         
              
          </div> <!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div>
  </div>
<!-- end sign up modal -->





<script language="javascript" type="text/javascript">
        function OpenPopupCenter(pageURL, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        } 
    </script>
