<?

  $pagetitle="Franchise With Us";
  include('assets/include/header.php');

?>
<main class="main">

    <div class="container-fluid">
        <div class="container-box">
            <h1 class="light-title rotate-title mt-3">
                <strong class="word-rotater">FRANCHISING</strong>
            </h1>
            <div class="container">
                <form action="#">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <h3>Personal info</h3>

                            <div class="form-group required-field">
                                <label>Applicant Name </label>
                                <input type="text" class="form-control" required>
                            </div><!-- End .form-group -->
                            <div class="form-group required-field">
                                <label>Email </label>
                                <input type="email" class="form-control" required>
                            </div><!-- End .form-group -->
                            <div class="form-group required-field">
                                <label>Phone Number </label>
                                <div class="form-control-tooltip">
                                    <input type="tel" class="form-control" required>
                                    <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions."
                                        data-placement="right"><i class="icon-question-circle"></i></span>
                                </div><!-- End .form-control-tooltip -->
                            </div><!-- End .form-group -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group required-field">
                                        <label>Country </label>
                                        <input type="text" class="form-control" required>
                                    </div><!-- End .form-group -->
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group required-field">
                                        <label>City </label>
                                        <input type="text" class="form-control" required>
                                    </div><!-- End .form-group -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <h3>Bussiness Detail</h3>

                            <div class="form-group">
                                <label>Company </label>
                                <input type="text" class="form-control">
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Company Description</label>
                                <input type="text" class="form-control">
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Current Bussiness </label>
                                <input type="text" class="form-control">
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Previous Experience in Restaurant </label>
                                <select class="form-control">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>

                            </div>


                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="clearfix text-center">
                                <a href="#" class="btn btn-primary btn-lg">Submit</a>
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