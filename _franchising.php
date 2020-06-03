<?

  $pagetitle="Franchise With Us";
  include('assets/include/header.php');





  if(isset($_POST["submit"])){

  
$from = $_POST['contact-email'];

        $email=$_POST['contact-email'];
        // Sanitize E-mail Address
        $email =filter_var($email, FILTER_SANITIZE_EMAIL);
        // Validate E-mail Address
        $email= filter_var($email, FILTER_VALIDATE_EMAIL);

        $headers .= "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

        $headers = 'From:'. $from . "\r\n";

        $headers .= 'Cc: zohaib@cybeinc.com' . "\r\n";

        $message = ' 
                <html> 
                <head> 
                    <title>Franchising Request</title> 
                </head> 
                <body> 
                    
                     <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;">
                        <tr> 
                            <th>Name:</th><td>'.$_POST['applicant-name'].'  </td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Email:</th><td>'.$_POST['contact-email'].' </td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Phone:</th><td>'.$_POST['phone'].' </td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Country:</th><td> '.$_POST['country'].'  </td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>City:</th><td>'.$_POST['city'].' </td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Company:</th><td>'.$_POST['company'].' </td> 
                        </tr>
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Description:</th><td>'.$_POST['company-description'].' </td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Current Bussiness:</th><td>'.$_POST['current-bussiness'].' </td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>City:</th><td>'.$_POST['city'].' </td> 
                        </tr>  
                        
                    </table> 
                </body> 
                </html>'; 
                
        mail("jawad@cybeinc.com", "-- FRANCHISING REQUEST --", $message, $headers);

        echo "Your mail has been sent successfuly ! Thank you for your feedback";




            }

?>


  <main class="main">
            
            <div class="container-fluid">
                <div class="container-box">
                    <h1 class="light-title rotate-title mt-3">
                        <strong class="word-rotater">FRANCHISING</strong>
                    </h1>
                <div class="container">
                     <form action="_franchising.php" method="POST" >
                    <div class="row">
                         
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                 <h3>Personal info</h3>
                                    
                                        <div class="form-group required-field">
                                            <label>Applicant Name </label>
                                            <input name="applicant-name" type="text" class="form-control" required>
                       
                                        </div><!-- End .form-group -->
                                         <div class="form-group required-field">
                                            <label>Email </label>
                                            <input name="contact-email" type="email" class="form-control" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group required-field">
                                            <label>Phone Number </label>
                                            <div class="form-control-tooltip">
                                                <input name="phone" type="tel" class="form-control" required>
                                                <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                                            </div><!-- End .form-control-tooltip -->
                                        </div><!-- End .form-group -->
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                           <div class="form-group required-field">
                                            <label>Country  </label>
                                            <input name="country" type="text" class="form-control" required>
                                        </div><!-- End .form-group -->
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group required-field">
                                            <label>City  </label>
                                            <input name="city" type="text" class="form-control" required>
                                        </div><!-- End .form-group -->
                                        </div>
                                        </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               <h3>Bussiness Detail</h3>
                                    
                                         <div class="form-group">
                                            <label>Company </label>
                                            <input name="company" type="text" class="form-control">
                                        </div><!-- End .form-group -->

                                       <div class="form-group">
                                            <label>Company Description</label>
                                            <input name="company-description" type="text" class="form-control">
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label>Current Bussiness </label>
                                            <input name="current-bussiness" type="text" class="form-control">
                                        </div><!-- End .form-group --> 

                                         <div class="form-group">
                                            <label>Previous Experience in Restaurant </label>
                                            <select name="previous-experience" class="form-control"> 
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select> 

                                </div>
    

                        </div> 
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="clearfix text-center">
                                     <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div><!-- End .clearfix -->
                         </div>  

                    </div>  
                    </form>  
                </div>    

                

                    <hr>

                   

                  
                </div><!-- End .container-box -->
            </div><!-- End .container -->
        </main><!-- End .main -->
<?php include('assets/include/footer.php')?>

<!-- $message = "<html>
        <body>
       
         <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;">
         <tr style="background: #eee;"><td><strong>Name:</strong> </td><td> . strip_tags($_POST['applicant-name']) . </td></tr>;
         <tr><td><strong>Email:</strong> </td><td> . strip_tags($_POST['contact-email']) . </td></tr>;
         <tr><td><strong>Phone Number:</strong> </td><td> . strip_tags($_POST['phone']) . </td></tr>;
         <tr><td><strong>Country :</strong> </td><td> . strip_tags($_POST['country']) . </td></tr>;
         <tr><td><strong>City :</strong> </td><td> . strip_tags($_POST['city']) . </td></tr>;
         <tr><td><strong>Company :</strong> </td><td> . strip_tags($_POST['company']) . </td></tr>;
         <tr><td><strong>Company Description :</strong> </td><td> . strip_tags($_POST['company-description']) . </td></tr>;
         <tr><td><strong>Current Bussiness :</strong> </td><td> . strip_tags($_POST['current-bussiness']) . </td></tr>;
         <tr><td><strong>Previous Experience in Restaurant :</strong> </td><td> . strip_tags($_POST['previous-experience']) . </td></tr>;
        
         </table>;
         </body></html>"; -->