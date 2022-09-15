<?php
$title = "Create FAQ";
include_once "layouts/head.php";
include "layouts/alert.php";
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8">
            <div class="card my-5">
                <div class="card-header"><h2>Create Faq</h2></div>
                <div class="card-body row justify-content-center">
                    <form class="col-12 col-lg-10 col-md-10" method="POST" action="backend/submit_faq.php">

                        <div class="form-group">
                            <input type="text" name="header" maxlength="100" class="form-control" placeholder="Header of the content" required>
                        </div>

                        <div class="form-group">
                            <label class="label" for="message">Content</label>
                            <textarea name="message" required class="form-control" id="message" maxlength="500" cols="30"  rows="4" placeholder="Write FAQ answer here.."></textarea>
                        </div>


                        <div class="form-group ">
                            <input type="submit" value="Add to Faq" name="crate_fq" class="btn  btn-primary" >
                            <button type="button" class="btn btn-primary" onclick="window.location.href='edit_faq.php'">Show Faq</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Back to home</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
