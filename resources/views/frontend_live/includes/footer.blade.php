<section class="footer_section">
    <div class="container">
        <div class="row pt-5 pb-1">
            <div class="col-md-12 col-lg-4 img-fluid tab_scrn animatedParent">
                <div class="animated fadeInDownShort go">
                    <img src="{{ URL::asset('frontend/images/mnre_logo.png') }}"
                        style="height: 50px; margin-bottom: 15px;">
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
                                <li><a href="">Services</a></li>
                                <li><a href="">Reserch & Development</a></li>
                                <li><a href="">Contact Us</a></li>
                                <li><a href="">Policy & Guidelines</a></li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <ul>
                                <li><a href="">Schemes</a></li>
                                <li><a href="">Manufacturing</a></li>
                                <li><a href="">Website Policy & Help</a></li>
                                <li><a href="">SiteMap </a></li>
                                <li><a href="">Feedback </a></li>
                                <li><a href="">FAQ</a></li>
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
                            <p><i class="fa-solid fa-location-dot"></i> Block 14, Ministry of New and <br>
                                Renewable Energy,CGO Complex,<br>
                                Lodhi Road, New Delhi 3.</p>
                            <p><i class="fa-solid fa-phone"></i> Missed call at: 9966054447</p>
                            <p><i class="fa-solid fa-envelope"></i> rts-mnre@gov.in </p>
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
                <small>Copyright @2022</small>
                <p>Website Content Managed by Ministry of New and Renewable Energy <br>Designed, Developed and Hosted by
                    <span>National Informatics Centre (NIC)</span>
                </p>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/css3-animate-it/1.0.3/js/css3-animate-it.min.js"
    integrity="sha512-X04knNLL77jarDJ7uTIUXMBvZwMCWn2lmV9qPrfq7UrPPd3GP5a4IVbZBkRNI/vumMMMqOZqnNLq8Eb/Y6TU7A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('scripts')
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
</body>

</html>
