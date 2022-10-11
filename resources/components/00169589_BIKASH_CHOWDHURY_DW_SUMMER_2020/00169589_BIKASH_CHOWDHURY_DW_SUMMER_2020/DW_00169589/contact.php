<?php
session_start();
$title = "Air Pollution";
$hover_nav = "contact";

$banner_location = 'images/banner/banner_8.jpg';
$banner_heading = "Contact Us";

include_once "layouts/head.php";
include_once "layouts/nav.php";
include_once "layouts/banner.php";

include "config/db_connection.php";
$con = connection();
$sql = "SELECT * FROM user_faq";
$faq_set = $con->query($sql)
?>





<section class="ftco-section pt-0 bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper">
							<div class="row no-gutters">
								<div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Get in touch</h3>
										<div id="form-message-warning" class="mb-4"></div>
                                <?php if (isset($_GET['success'])){ ?>
					      		<div id="form-message-success" class="mb-4">
					            Your message was sent, thank you!
					      		</div>
                                <?php }?>
										<form method="POST" id="contactForm" name="contactForm" action="backend/users_ques_store.php" class="contactForm">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="label" for="name">Full Name</label>
														<input type="text" class="form-control" required name="name" id="name" placeholder="Name">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label class="label" for="email">Email Address</label>
														<input type="email" class="form-control" required name="email" id="email" placeholder="Email">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="subject">Subject</label>
														<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="label" for="#">Message</label>
														<textarea name="message" required class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="button" data-toggle="modal" data-target="#faq_popup" value="Send Message" class="btn btn-primary">
														<div class="submitting"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>




                                <!---------------------------Contact details ------>
								<div class="col-lg-4 col-md-5 d-flex align-items-stretch">
									<div class="info-wrap bg-primary w-100 p-md-5 p-4">
										<h3>Let's get in touch</h3>
										<p class="mb-4">We're open for any suggestion or just to have asking</p>
					        	<div class="dbox w-100 d-flex align-items-start">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-map-marker"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Address:</span> Concord Tower, Panthapath, Dhaka, Bangladesh</p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-phone"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Phone:</span> <a href="tel://+880 1777099158">+880 1777099158</a></p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-paper-plane"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Email:</span> <a href="mailto:1000829@daffodil.ac">1000829@daffodil.ac</a></p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-globe"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Website</span> <a href="#">daffodil.ac</a></p>
						          </div>
					          </div>
				          </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
    				<div id="map" class="map"></div>
    			</div>
				</div>
    	</div>
    </section>



<!--------------------Faq modal----------------------->
<div class="modal fade" id="faq_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Common questions answer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php foreach ($faq_set AS $data){ ?>
                <div class="content">
                    <h3><?=$data['header']?></h3>
                    <p><?=$data['subject']?></p>
                    <hr>
                </div>
                <?php }?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                <button type="submit" name="contact_us" form="contactForm" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>

<?php
include_once "layouts/footer.php";
?>
