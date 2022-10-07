<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

?>

<div id="layoutSidenav">
    <!-- aside  -->

    <?php
    if (isset($_SESSION['admin'])) {
        include_once "./admin-layouts/aside.php";
    } elseif (isset($_SESSION['doctor']) || isset($_SESSION['councilor'])) {
        include_once "./admin-layouts/experts_aside.php";
    }

    ?>
    <div id="layoutSidenav_content">
        <section class="segment-margin community">
            <!-- post sectoin  -->
            <div class="community__post post">
                <!-- creating new post section  -->

                <div class="post__card">
                    <div class="post__title">
                        <h3 class="post__author">Create a new post</h3>
                        <!-- <h4 class="post__upload-info">date of the post</h4> -->
                    </div>
                    <div class="p-des">
                        <div class="p-des__article">
                            <form action="./backend/create_post.php" method="POST">


                                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                                <div class="form-group py-2">

                                    <input type="text" name="post_title" required class="form-control" placeholder="Post Title" maxlength="256">
                                </div>

                                <div class="form-group py-2">

                                    <textarea name="post_details" required class="form-control" rows="3" placeholder="Write Your Post Here"></textarea>
                                </div>

                                <div class="form-group py-2">
                                    <div class="col text-center"><input type="submit" value="Post Now" name="post_article" class="btn btn-primary"></div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <!-- end creating new post  -->
            </div>
        </section>





        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>