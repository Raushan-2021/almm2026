@inject('general', 'App\Http\Controllers\HomeController')
<?php $general->site_visit_counter(); 
?>
<section class="footer_section">
    <div class="container-fluid">
        <div class="row pt-5 pb-1">
            <div class="col-md-12 col-lg-4 img-fluid tab_scrn animatedParent">
                <div class="animated fadeInDownShort go">
                    <img src="{{ URL::asset('frontend/images/footer-logo-1.png') }}"
                        style="height: 80px; margin-bottom: 15px;" alt="mnre logo">
                    <div>The website belongs to Ministry of New and Renewable Energy (MNRE), Government of India.
                        Content displayed are for reference purpose only. All efforts have been made to make the
                        information as accurate as possible. MNRE will not responsible for any loss or harm, direct or
                        consequential or any violation of law as that may be caused by inaccuracy in the information
                        available on this website. Any discrepancy found may be brought to the notice of Ministry.
                    </div>

                </div>
            </div>

            <div class="col-md-8 col-lg-5 useful_links animatedParent">
                <div class="animated fadeInUpShort go">
                    <div class="row">
                        <div class="col-md-12 pb-5 text-white">USEFUL LINKS</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <ul>
                                <li><a href="">Home</a></li>
                                <!-- <li><a href="">About Us</a></li> -->
                                <li><a href="https://mnre.gov.in/en/approved-list-of-models-and-manufacturers-almm/" target="_blank" rel="noopener noreferrer">ALMM Solar Scheme</a></li>
                                <li><a href="https://mnre.gov.in/en/wind-manufacturing/" target="_blank" rel="noopener noreferrer">ALMM Wind Scheme</a></li>
                                <!-- <li><a href="">Website Policy & Help</a></li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#policyHelpModal">
                                        Website Policy & Help
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="col-md-6">
                            <ul>
                                <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                                <li><a href="{{url('/feedback')}}">Feedback </a></li>
                                <li><a href=""> FAQ </a></li>
                                <!-- <li><a href="">Schemes</a></li> -->
                                <!-- <li><a href="">Manufacturing</a></li> -->
                                <!-- <li><a href="">Website Policy & Help</a></li> -->
                                <!-- <li><a href="">SiteMap </a></li> -->
                                <!-- <li><a href="{{url('/feedback')}}">Feedback </a></li> -->
                                <!-- <li><a href=""> FAQ </a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 animatedParent">
                <div class="animated fadeInDownShort go">
                    <div class="row">
                        <div class="col-md-12 pb-5 text-white">
                            CONNECT WITH US
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa-solid fa-location-dot"></i> Ministry of New and Renewable Energy<br>
                                Atal Akshaya Urja Bhawan,CGO Complex,<br>
                                Lodhi Road, New Delhi-110003, India</p>
                                <p> <a href="https://mnre.gov.in/" target="_blank" referrerpolicy="no-referrer" >www.mnre.gov.in</a></p>
                            <!-- <p><i class="fa-solid fa-phone"></i> Missed call at: 9966054447</p>
                            <p><i class="fa-solid fa-envelope"></i> rts[dash]mnre[at]gov.in </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bottom_footer">
    <div class="container">
        <div class="row pt-3 ">
            <div class="col-md-12">
                <small>Copyright @ <?php echo date('Y'); ?></small>
                <p>Website Content Managed by Ministry of New and Renewable Energy <br>Designed, Developed and Hosted by
                    <span>National Informatics Centre (NIC)</span><br>
                    <small>Last Updated: January 04, 2024</small> <br>
                    <small>Total Hits : <span class="text-warning text-bold" id="totalHits">6179</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total
                        Visitors: <span class="text-warning text-bold" id="uniqueHits">5985</span></small>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- <script src="{{ URL::asset('frontend/js/css3-animate-it.min.js')}}"
    integrity="sha512-X04knNLL77jarDJ7uTIUXMBvZwMCWn2lmV9qPrfq7UrPPd3GP5a4IVbZBkRNI/vumMMMqOZqnNLq8Eb/Y6TU7A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- Modal -->


@yield('scripts')
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="modal fade" id="policyHelpModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Website Policy & Help</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center py-4">
        <p class="fs-5">
          For any portal related issues
        </p>
        <p class="fs-4 fw-bold text-primary">
           pmu-nic-mnre[at]supportgov[dot]in
        </p>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">
          Close
        </button>
      </div>

    </div>
  </div>
</div>

<script>
window.onscroll = function() {
    myFunction()
};

var navbar = document.getElementById("stick_nav");
var sticky = navbar.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "getCounters",
            type: 'get',
            dataType: 'json',
            success: function(result) {
                // console.log(result.hits.totalHits);
                $('#uniqueHits').html(result.hits.uniqueHits);
                $('#totalHits').html(result.hits.totalHits);
            },
            error: function(xhr, status, error) {

            }
        });
    });
    </script>
</body>

</html>