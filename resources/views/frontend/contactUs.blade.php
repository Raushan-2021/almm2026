@extends('frontend.includes.master')
@section('title')
Ministry of New And Renewable Energy | Home
@endsection()
@section('styles')
@endsection()
@section('content')
<style>
    .contactus_page .left_contact {
        background: url(../public/frontend/images/contact-us-page.png) no-repeat;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        position: relative;
        border-radius: 15px;
    }
    .contactus_page .right_content {
        padding: 0px 25px;
        background-color: #ffffff;
        border-radius: 15px;
    }
    .contact_bg_image{background-size:cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; 
  background-color: #ccc;
  position: relative;}

</style>
<section class="signup_sectn almm_home_section11 contactus_page">
    <div class="container">
        <div class="row animatedParent">
            <div class="col-md-12 animated fadeInDownShort go">

            <div class="container-fluid px-5">
        <div class="row pt-5 mt-5 pb-5 mb-5">
            <!-- <div class="col-xxl-2"></div> -->
            <div class="col-xxl-12 ">
                <div class="row pt-5 px-5">
                    <div class="col-xxl-12">
                        <p class="section-tittle" style="font-size:25px !important; text-align:center; color:#ffffff; font-weight: 700;">
                            Contact Us</p>
                    </div>
                    <!-- <div class="col-lg-5 left_contact" style="margin-right: 35px;margin-left: 80px;">
                    </div> -->
                    <div class="col-lg-12 right_content">
                        <div class="office-pera">
                            <div class="section-tittle ">

                                <div class="row text-center contact_bg">
                                    <div class=" col-md-12 pt-4">
                                        <h4>Ministry of New and Renewable Energy</h4>

                                        <p class="pt-3 pb-3" style="font-size: 17px; line-height: 30px;">Atal Akshay
                                            Urja Bhawan, CGO Complex, <br>

                                            Lodhi Road, New Delhi-110 003, India.</p>
                                        <h5>SANJAY KARNDHAR </h5>
                                        <h5>SCIENTIST "E"</h5>
                                        <p>Email : <i class="fa-solid fa-envelope"></i> karndhar[dot]sg[at]nic[dot]in
                                        </p><hr>
                                        <h5>P.K. Dash </h5>
                                        <h5>SCIENTIST "E"</h5>
                                        <p>Email : <i class="fa-solid fa-envelope"></i> Prabir[dot]dash[at]nic[dot]in
                                        </p>

                                        
                                    </div>

                                    <div class=" col-md-12  pt-4" style="padding-left: 0; padding-right:0;">


                                        <!-- <div class="online_application">
                                            <p>Email : <i class="fa-solid fa-envelope"></i>
                                                pmu-nic-mnre[at]supportgov[dot]in</p>
                                            Online Application Related problems , difficulties suggestions etc.
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

</section>


@endsection()