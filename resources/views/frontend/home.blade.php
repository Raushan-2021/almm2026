@extends('frontend.includes.master')
@section('title')
Ministry of New And Renewable Energy | Home
@endsection()
@section('styles')
@endsection()
@section('content')

<section class="login_bg_image almm_home_section1">
<div class="container">
        <div class="row animatedParent">
            <div class="col-md-12 mt-5 mb-5 pt-5 pb-5 animated fadeInDownShort go">

                <h1 class="text_shadow"> ALMM</h1>
                <h2 class="text_shadow" style="font-size: 45px;">The Approved List of <br>Models  & Manufacturers     </h2>
                
                <h3 class="text_shadow" style="font-size: 35px;">Government of India</h3>
            </div>
        </div>
    </div>

</section>
<section class="almm_home_section2">
    <div class="container">
        <div class="row">
            <!-- <div class="col-xl-12 text-center"> <h2 class="register_steps">Don’t Know Where to Start ?</h2></div> -->
            <div class="col-md-4" style="padding: 10px 20px">
                <div class="row">
                    <div class="col-md-12 comn_blk animatedParent">
                        <div class="row animated fadeInLeftShort go">
                            <div class="col-xxl-4 img-fluid text-center"><img
                                    src="{{ URL::asset('frontend/images/Efficiency_Power.png') }}" width="80px">
                            </div>
                            <div class="col-xxl-8">
                                <h2>Register</h2>
                                <p style="margin-bottom: 0 !important;">Register yourself to fill the application regarding models and components.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4" style="padding: 10px 20px">
                <div class="row">
                    <div class="col-md-12 comn_blk animatedParent">
                        <div class="row animated fadeInDownShort go">
                            <div class="col-xxl-4 img-fluid text-center"><img
                                    src="{{ URL::asset('frontend/images/trust_waranty.png') }}" width="80px">
                            </div>
                            <div class="col-xxl-8">
                                <h2>Application</h2>
                                <p style="margin-bottom: 0 !important;">Fill the application with necessary and mandatory details.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4" style="padding: 10px 20px">
                <div class="row">
                    <div class="col-md-12 comn_blk animatedParent">
                        <div class="row animated fadeInRightShort go">
                            <div class="col-xxl-4 img-fluid text-center"><img
                                    src="{{ URL::asset('frontend/images/high_quality.png') }}" width="80px">
                            </div>
                            <div class="col-xxl-8">
                                <h2>Approval</h2>
                                <p style="margin-bottom: 0 !important;">After scrutiny of application get verified by the competent authority.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</section> 
<section class="almm_home_section3 ">
    <div class="container pb-5">

        <div class="row">

            <div class="col-md-12 col-lg-6 order-md-2 order-lg-1 img-fluid left_blk animatedParent">
                <div class="animated fadeInDownShort go"><img class="full_width_img"
                        src="{{ URL::asset('frontend/images/web_img1.png') }}">
                    <img class="gray_bgimg " src="{{ URL::asset('frontend/images/gray_bgimg.png') }}">
                </div>

            </div>
            <div class="col-md-12 col-lg-6 order-md-1 order-lg-2 right_blk animatedParent">
                <div class="animated fadeInUpShort go">
                    <div class="comn_heading">
                        <i class="fa-solid fa-minus"></i> About ALMM
                    </div>

                    <h3 class="pt-3 pb-2" style="font-size:20px; line-height:1.3;">Approved Models and Manufacturers of Solar Photovoltaic Modules (Requirements for Compulsory Registration) Order, 2019</h3>
                    <p class="text-justify">Solar PV power installations are typically established for a period of 25 years, requiring modules and cells that can sustain long-term warranty commitments. To ensure reliability and authenticity, it is necessary to verify that production genuinely occurs in the units as claimed.
                    </p>
                    <p class="text-justify">To safeguard consumer interests and ensure national energy security, the <strong>Ministry of New and Renewable Energy (MNRE)</strong> issued the “Approved Models and Manufacturers of Solar Photovoltaic Modules (Requirement for Compulsory Registration) Order, 2019” on <strong>02 January 2019</strong>.
                    </p>
                    <h3 class="pt-3 pb-2" style="font-size:20px; line-height:1.3;">Approved List of Models and Manufacturers (Wind)</h3>

                    <p class="text-justify">The <strong>Revised List of Models and Manufacturers (RLMM)</strong> identify type- and quality-certified wind turbine models eligible for installation in India. The list assists <strong>State Nodal Agencies (SNAs), investors, lenders, and project developers</strong> in the selection of reliable and compliant wind turbine technologies.
                    </p>
                    <p class="text-justify">This list is based on the requirements of <strong>type testing, type certification, and quality assurance</strong>, in accordance with the Guidelines for Development of Onshore Wind Power Projects issued by MNRE (F. No. 66/183/2016-WE dated <strong>22 October 2016</strong>).</p>
                    <p class="text-justify">As per these guidelines, certification from an <strong>internationally accredited certification body</strong> is mandatory for manufacturers of wind turbines and components. Both certifications must include the <strong>Hub and Nacelle assembly/manufacturing facilities</strong> located in India.</p>
                    <p class="text-justify">Following MNRE’s Office Memorandum dated <strong>31 July 2025</strong>, the RLMM has been <strong>renamed as the Approved List of Models and Manufacturers (Wind) or ALMM (Wind)</strong>.</p>
                    <p class="text-justify">The amendment requires that:</p>
                    <ul id="almmList" class="mt-3" style="display:none;">
                        <li>The <strong>Type Certificate</strong> of a wind turbine model must mandatorily include vendors and sources for key components such as <strong>blade, tower, generator, gearbox, and special bearings</strong> (main, pitch, and yaw bearings).</li>
                        <li>A <strong>Data Control and Research Centre</strong> must be established within India to address cybersecurity concerns</li>
                        <li>A separate list, titled <strong>Approved List of Models and Manufacturers for Wind Turbine Components (ALMM-WTC)</strong>, will be released after comprehensive inspection of the manufacturing facilities of component suppliers, assessing their infrastructure, capacity, and quality assurance processes.</li>

                    </ul>
                    
                    <button type="button" class="btn btn-outline-success" onclick="toggleALMM()">Read More</button>
                </div>
            </div>

        </div>
    </div>

</section>
<!-- <img class="full_width_img" src="{{ URL::asset('frontend/images/solarpng.png') }}"> -->
<!-- <section class="almm_home_section4 pt-5">
    <div class="container pt-3 pb-5">
        <div class="row animatedParent">
            <div class="col-md-12 text-center animated bounceIn go">
                <div class="comn_heading ">
                    <i class="fa-solid fa-minus"></i> Making Tomorrow Different Today.

                </div>
                <h2 class="pt-3 pb-5">Energize Society With Sustainable And Reliable Energy Systems!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6  left_blk animatedParent">

                <div class="animated fadeInDownShort go">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra
                        maecenas accumsan lacus vel facilisis.

                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra
                        maecenas accumsan lacus vel facilisis.
                    </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra
                        maecenas accumsan lacus vel facilisis.

                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra
                        maecenas accumsan lacus vel facilisis.
                    </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra
                        maecenas accumsan lacus vel facilisis.

                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra
                        maecenas accumsan lacus vel facilisis.
                    </p>

                    <button type="button" class="btn btn-success mb-5">Explore All Features</button>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 img-fluid right_blk">
                <div class="row">
                    <div class="col-md-6 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInLeftShort go">
                            <img class="pb-4" src="{{ URL::asset('frontend/images/enrgy_svng.png') }}">
                            <h5>Save
                                Your Money</h5>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInRightShort go">
                            <img class="pb-4" src="{{ URL::asset('frontend/images/fivestar_rating.png') }}">
                            <h5>5 Stars
                                Customer Service</h5>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInLeftShort go">
                            <img class="pb-4" src="{{ URL::asset('frontend/images/home_energy.png') }}">
                            <h5>Your Home
                                Is Energy </h5>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInRightShort go">
                            <img class="pb-4" src="{{ URL::asset('frontend/images/certfied.png') }}">
                            <h5>Certified
                                Engineers</h5>
                        </div>
                    </div>


                </div>


            </div>


        </div>

    </div>
    
</section> -->
<section class="almm_home_section5  pb-5">
    <div class="container pt-3 pb-5 pt-5">

        <div class="row">
            <div class="col-md-12 col-lg-6  left_blk animatedParent">
                <div class="animated fadeInDownShort go pt-4">
                    <div class="comn_heading ">
                        <i class="fa-solid fa-minus"></i> For any scheme related issues contact

                    </div>
                    <h1 class="pt-3">Ministry of New <br> and Renewable Energy</h1>
                   
                    <p>Atal Akshay Urja Bhawan, CGO Complex,Lodhi Road, New Delhi-110 003, India.</p>
                </div>

            </div>
            <div class="col-md-2"></div>
            <div class="col-md-12 col-lg-4 img-fluid right_blk ">
                <div class="row">
                    <div class="col-md-12 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInUpShort go">
                            <h5>Sanjay karndhar </br>Scientist "E"</h5>
                            <h6>Email :  karndhar[dot]sg[at]nic[dot]in</h6>
                            <hr>
                             <h5>P.K. Dash </br>Scientist "E"</h5>
                            <h6>Email :  Prabir[dot]dash[at]nic[dot]in</h6>
                        </div>
                    </div>

                </div>


            </div>


        </div>

    </div>

</section>
<section class="almm_home_section6 pt-5">
    <div class="container pt-3 ">
        <div class="row animatedParent">
            <div class="col-md-12 text-center animated bounceIn go">
                <div class="comn_heading ">
                    <i class="fa-solid fa-minus"></i> Today There Are Multiple Ways to Go Solar

                </div>
                <h2 class="pt-3 pb-5">Don’t Know Where to Start?</h2>
            </div>
        </div>
        <div class="row pt-3">

            <div class="col-md-12 img-fluid right_blk">
                <div class="row">
                    <div class="col-md-4 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInLeftShort go">
                            <img class="pb-4" src="{{ URL::asset('frontend/images/lease.png') }}">
                            <h3>Solar Photovoltaic <br> Modules  </h3>
                            <p>(Requirement for <br> Compulsory  Registration)</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInUpShort go">
                            <img class="pb-4" src="{{ URL::asset('frontend/images/loans.png') }}">
                            <h3>Development of Onshore <br>Wind Power Projects </h3>
                            <p>Mandating registration and approval to ensure <br>authenticity of manufacturing facilities</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 animatedParent">
                        <div class="col-md-12 comn_blk pt-5 pb-5 animated fadeInRightShort go">
                            <img class="pb-4" src="{{ URL::asset('frontend/images/purchase.png') }}">
                            <h3>Standards, Reliability<br> and Compliance </h3>
                            <p>Upholding certified production and quality <br> assurance in renewable energy components.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- <div class="col-md-12 text-center pt-5 pb-5"> <a href="" class="btn btn-secondary btn-lg"> Get More Info</a></div> -->
             <!-- <img class="full_width_img" src="{{ URL::asset('frontend/images/solarpng.png') }}"> -->
        </div>

    </div>
<img class="full_width_img" src="{{ URL::asset('frontend/images/solarpng.png') }}">

<!-- <div
      class="modal fade"
      id="myModal"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            style="
              position: absolute;
              right: 0px;
              top: 0px;
              border-radius: 0;
              font-weight: 600;
            "
          >
            X
          </button>
          <img src="{{ URL::asset('frontend/images/solarpngai.jpg') }}" class="img-fluid" style="width: 100%" />
        </div>
      </div>
    </div> -->
</section>
<!-- <section class="almm_home_section7">

    <marquee>This is basic example of marquee</marquee>

</section> -->
<script>
function toggleALMM() {
    const list = document.getElementById("almmList");
    const btn = event.target;

    if (list.style.display === "none") {
        list.style.display = "block";
        btn.textContent = "Read Less";
    } else {
        list.style.display = "none";
        btn.textContent = "Read More";
    }
}
</script>
<!-- <script>
      window.addEventListener("load", () => {
        const myModal = new bootstrap.Modal(document.getElementById("myModal"));
        myModal.show();
      });
    </script> -->
@endsection()