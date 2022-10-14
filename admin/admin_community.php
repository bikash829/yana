<?php
$community = true;
include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";


?>
<div id="layoutSidenav">
    <!-- aside  -->

    <?php
    if (isset($_SESSION['admin'])) {

        include_once "./admin-layouts/aside.php";
    } elseif (isset($_SESSION['doctor']) || isset($_SESSION['councilor'])) {
        $dashboard = "./experts_dashboard.php";
        include_once "./admin-layouts/experts_aside.php";
    }

    ?>
    <div id="layoutSidenav_content">
        <!-- content ------------------------- -->
        <?php
        // db connection

        include "../config/db_connection.php";

        $sql = "SELECT `forum`.*, `users`.`f_name`,`user_role`.`role`, `users`.`l_name` FROM `forum`
        INNER JOIN `users` ON `forum`.`user_id` = `users`.`id`
        INNER JOIN `user_role` ON `users`.`role_id` = `user_role`.`id` ORDER BY id DESC;";

        if ($forum_set = db_connection()->query($sql)) {
            $all_forum = $forum_set->fetch_all(MYSQLI_ASSOC);
        } else {
            $error = "Technical error please contact with developer";
        }


        function comments()
        {

            $sql = "SELECT `comments`.*, `users`.`f_name`,`user_role`.`role`, `users`.`l_name` FROM `comments`
                    INNER JOIN `users` ON `comments`.`user_id` = `users`.`id`
                    INNER JOIN `user_role` ON `users`.`role_id` = `user_role`.`id`
                    ORDER BY id DESC;";


            if ($comment_set = db_connection()->query($sql)) {
                $comments = $comment_set->fetch_all(MYSQLI_ASSOC);
                return $comments;
            } else {
                return "Technical error please contact with developer";
            }
        }

        ?>
        <main class="main">
            <section class="m-3 community">
                <!-- post sectoin  -->
                <div class="community__post post">
                    <?php
                    foreach ($all_forum as $row) {
                    ?>

                        <div class="post__card">
                            <div class="post__title">
                                <h2 class="post__author"><?= $row['f_name'] . ' ' . $row['l_name'] ?></h2>
                                <h4 class="post__upload-info text-secondary"><?= ucwords($row['role']) . ' | ' . $row['post_date']  ?> </h4>
                                <!-- <h5 class="post__upload-info"><?= $row['post_date'] ?> </h5> -->
                            </div>
                            <div class="p-des">
                                <h5><?= $row['post_title'] ?></h5>
                                <p class="p-des__article">
                                    <?= $row['post_description'] ?>
                                </p>
                                <div class="p-des__react-info" id="blah">

                                    <div class="p-des__comment btn-comment"><span id="commnetsCount" class="comment-count"></span><span> comments</span><i class="picon-size fa-solid fa-comments"></i></div>
                                    <div class="p-des__react"> <span id="reactCount">5 </span><a href="#" class="text-secondary"><i class="picon-size fa-solid fa-face-grin-hearts"></i></a></div>
                                </div>


                                <div class="p-des__comments comment-reply" id="commentsReply">
                                    <hr>
                                    <!-- comments form  -->
                                    <form action="../backend/create_post.php" method="POST" class="mb-2">


                                        <h6 class="p-des__reply-author py-2"> <a href="#" class="text-secondary"><?= $_SESSION[$user_role]['f_name'] ?></a> </h6>
                                        <input type="hidden" name="user_id" value="<?= $_SESSION[$user_role]['id'] ?>">
                                        <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                        <div class="">
                                            <textarea name="comment" required rows="2" class="form-control " placeholder="Leave a Comment"></textarea>
                                        </div>
                                        <div class="text-end"><input class="btn btn-sm btn-secondary mt-1" type="submit" value="comment" name="btn-comment"></div>

                                    </form>

                                    <!-- show comments  -->
                                    <?php
                                    foreach (comments() as $comment) {
                                        if ($comment['forum_id'] == $row['id']) {
                                    ?>
                                            <div class="p-des__reply">
                                                <h5 class="p-des__reply-author"> <a href="#" class="text-secondary"><?= $comment['f_name'] . ' ' . $comment['l_name'] ?></a> </h5>
                                                <h6 class="p-des__reply-author fw-lighter replied_by"> <a href="#"><?= ucwords($comment['role']) ?></a> | <span><?= $comment['comment_date'] ?></span> </h6>
                                                <p><?= $comment['comment'] ?></p>
                                                <div class="p-des__reply-info">
                                                    <p class="p-des__reply-time"><?= $comment['comment_date'] ?></p>
                                                    <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                                                </div>
                                            </div>
                                    <?php  }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- page number  -->
                    <div aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- aside bar  -->
                <div class="community__aside com-aside">
                    <h3 class="com-aside__title">Popular Posts</h3>
                    <div class="com-aside__update aside-update">
                        <h4class="aside-update__header">&Lorem ipsum dolor, sit amet consectetur adipisicing elit.</h4class=>
                            <p class="aside-update__author">Post by Mayesha</p>
                    </div>
                </div>

            </section>
        </main>

        <script>
            let btnComment;

            btnComment = document.querySelectorAll('.btn-comment');

            for (let i = 0; i < btnComment.length; i++) {
                btnComment[i].firstElementChild.textContent = btnComment[i].parentNode.nextElementSibling.children.length - 2;
                btnComment[i].addEventListener('click', () => {
                    btnComment[i].parentNode.nextElementSibling.classList.toggle('comments-visible');
                })
            }
        </script>



        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>



<!-- popup alert  -->
<?php
include "../functionalities/alert.php";
// alert defined on footer before 

if (isset($_SESSION['comment_alert'])) {
    $alert_status = alert($_SESSION['comment_alert']);
    var_dump($alert_status);
    unset($_SESSION['comment_alert']);
} else {
    $alert_status = false;
}
?>

<script type="text/javascript">
    // validation message 
    alertStatus = <?= json_encode($alert_status ?? null) ?>;
    if (alertStatus) {
        Swal.fire({
            position: 'top-end',
            icon: alertStatus.status,
            title: alertStatus.message,
            showConfirmButton: false,
            timer: 2500
        })
    }
</script>