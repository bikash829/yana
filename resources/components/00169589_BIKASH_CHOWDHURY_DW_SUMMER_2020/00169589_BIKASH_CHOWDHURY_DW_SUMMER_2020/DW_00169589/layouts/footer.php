
<footer class="footer ">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                <div class="row justify-content-center">

                </div>
            </div>

            <div class="col-md-4 col-lg-4">
                <div class="footer-heading pl-1" style="position: absolute; bottom: 20px;"><h3 class="text-white">Social Links</h3></div>
                <div>
                    <div class="social-menu">
                        <ul>
                            <li><a href="https://www.facebook.com/AirPollutionWeMustStop/"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://twitter.com/GuapoAir"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/explore/tags/airpollution/"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://www.youtube.com/watch?v=Tds3k97aAzo"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/total-air-pollution-control"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6 col-lg-8">
            </div>
            <div class="col-md-6 col-lg-4 text-md-right">
                <p>&copy Copyright By Bikash  Chowdhury</p>
            </div>
        </div>
    </div>
</footer>

<?php
unset($_GET['login_success']);
?>

<!--js for sign up -->


<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>
<!--bootstrap js-->
<!--<script src="vendor/bootstrap/js/bootstrap.min.js"></script>-->
<script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>



<!--custom js-->
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $('.toast').toast('show');-->
<!--    });-->
<!--    var element = document.getElementById('country_select');-->
<!---->
<!--    element.addEventListener('mousedown', function () {-->
<!--        this.size=5;-->
<!--    });-->
<!--    element.addEventListener('change', function () {-->
<!--        this.blur();-->
<!--    });-->
<!--    element.addEventListener('blur', function () {-->
<!--        this.size=0;-->
<!--    });-->
<!---->
<!--    //code for login success alert-->

<!---->
<!--</script>-->

<script>
    //success alert auto close
    $("#error").fadeTo(5000, 800).fadeOut(800, function(){
        $("#success").alert('close');
    });
    // code for tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>

</body>
</html>