 <?

    $pagetitle="Contact Us";
    include('assets/include/header.php');

if(isset($_POST['submit'])) {

        $email=$_POST['email'];
       
         // Sanitize E-mail Address
        $email =filter_var($email, FILTER_SANITIZE_EMAIL);
        // Validate E-mail Address
        $email= filter_var($email, FILTER_VALIDATE_EMAIL);

        $name = $_POST['name'];

        $phone = $_POST['phone'];

        $text = $_POST['message'];

        $headers = 'From:'. $email . "rn";

        // $headers .= 'Cc: jawad@cybeinc.com' . "\r\n";

        $headers    .= "MIME-Version: 1.0\r\n";
        
        // $headers    .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers = "Content-Type: text/html; charset=UTF-8";

        $message   =    "<html><head></head>
                    <body>
                        <table cellspacing='0' style='width: 100%;background:#F3F3F3;'>
                                
                                <tr>
                                    <th style='width: 25%;padding: 5px;'>Name </th>
                                    <td style='width: 75%;padding: 5px;'>$name</td>
                                </tr>
                                
                                <tr>
                                    <th style='width: 25%;padding: 5px;'>Email </th>
                                    <td style='width: 75%;padding: 5px;'>$email</td>
                                </tr>

                                <tr>
                                    <th style='width: 25%;padding: 5px;'>Phone No.</th>
                                    <td style='width: 75%;padding: 5px;'>$phone</td>
                                </tr>

                                <tr>
                                    <th style='width: 25%;padding: 5px;'>Message :</th>
                                    <td style='width: 75%;padding: 5px;'>$text</td>
                                </tr>

                                
                                </table>
                                </body>
                                </html>";

                                $to = "'hamzayousuf121@gmail.com' , 'ali@cybeinc.com'";
                
      $mail = mail('ali@cybeinc.com', "-- Contact Us Email --", $message, $headers);
}
 ?>
 
<main class="main">
           

            <div class="container">
                <div id="map">
                	<iframe
 				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d924244.0619641689!2d66.59499551729773!3d25.192146526892635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e06651d4bbf%3A0x9cf92f44555a0c23!2sKarachi%2C%20Karachi%20City%2C%20Sindh!5e0!3m2!1sen!2s!4v1591014299863!5m2!1sen!2s"
 				width="100%" height="470" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
                <!-- End #map -->
                
                <div class="container-box">
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <h2 class="light-title">Write <strong>Us</strong></h2>

                            <form action="contactus.php" method="POST" id="contactus">
                                <div class="form-group required-field">
                                    <label for="contact-name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div><!-- End .form-group -->

                                <div class="form-group required-field">
                                    <label for="contact-email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="contact-phone">Phone Number</label>
                                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="phone" name="phone">
                                </div><!-- End .form-group -->

                                <div class="form-group required-field">
                                    <label for="contact-message">What’s on your mind?</label>
                                    <textarea cols="30" rows="1" id="message" class="form-control" name="message" required></textarea>
                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div><!-- End .form-footer -->
                            </form>
                        </div><!-- End .col-md-8 -->

                        <div class="col-md-4">
                            <h2 class="light-title">Contact <strong>Details</strong></h2>

                            <div class="contact-info">
                                <div>
                                    <i class="icon-mobile"></i>
                                    <p><a href="tel:03008256980">0300 8273030</a></p>
                                </div>
                                <div>
                                    <i class="icon-mail-alt"></i>
                                    <p><a href="mailto:#">delivery@afghantandoor.pk</a></p>
                                </div>
                                <div>
                                	 <i class="icon-direction"></i>
                                    <p>Karachi, Pakistan</p>
                                </div>	
                                
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-md-4 -->
                    </div><!-- End .row -->
                </div><!-- End .container-box -->
            </div><!-- End .container -->

        </main><!-- End .main -->
<?php include('assets/include/footer.php')?>


<script type="text/javascript">

    function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       </script>