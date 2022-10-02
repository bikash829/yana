<?php
$title = "Community Forum";
$state = "community";
$banner_title = "write your won post here";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";


// db connection 

include "./config/db_connection.php";

$sql = "SELECT `forum`.*, `users`.`f_name`, `users`.`l_name` FROM `forum` 
        INNER JOIN `users` 
        ON `forum`.`user_id` = `users`.`id`;";

if($forum_set = db_connection()->query($sql)){
    $all_forum = $forum_set->fetch_all(MYSQLI_ASSOC);
    
}else{
    $error = "Technical error please contact with developer";
}


function comments(){

    $sql = "SELECT `comments`.*, `users`.`f_name`, `users`.`l_name` FROM `comments` 
        INNER JOIN `users` 
        ON `comments`.`user_id` = `users`.`id`;";

    if($comment_set = db_connection()->query($sql)){
        $comments = $comment_set->fetch_all(MYSQLI_ASSOC);
        return $comments;
    }else{
         return "Technical error please contact with developer";
    }
}

?>
<main class="main">
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
                

                            <input type="hidden" name="user_id" value="<?=$_SESSION['user']['id']?>">
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

            <?php 
            foreach($all_forum AS $row){
                ?>

            <div class="post__card">
                <div class="post__title">
                    <h3 class="post__author"><?=$row['f_name'].' '. $row['l_name']?></h3>
                    <h4 class="post__upload-info"><?=$row['post_date']?></h4>
                </div>
                <div class="p-des">
                    <h5><?=$row['post_title']?></h5>
                    <p class="p-des__article">
                        <?=$row['post_description']?>
                    </p>
                    <div class="p-des__react-info" id="blah">
                        <div class="p-des__comment btn-comment"><span id="commnetsCount" class="comment-count"></span><span> comments</span><i class="picon-size fa-solid fa-comments"></i></div>
                        <div class="p-des__react"> <span id="reactCount">5 </span><a href="#" class="text-secondary"><i class="picon-size fa-solid fa-face-grin-hearts"></i></a></div>
                    </div>


                    <div class="p-des__comments comment-reply" id="commentsReply">
                        <hr>
                            <!-- comments form  -->
                            <form action="./backend/create_post.php" method="POST" class="mb-2">

                            
                                <h6 class="p-des__reply-author py-2"> <a href="#" class="text-secondary"><?=$_SESSION['user']['f_name']?></a> </h6>
                                <input type="hidden" name="user_id" value="<?=$_SESSION['user']['id']?>">
                                <input type="hidden" name="post_id" value="<?=$row['id']?>">
                                <div class="">
                                    <textarea name="comment" required rows="2" class="form-control " placeholder="Leave a Comment"></textarea>
                                </div>
                                <div class="text-end"><input class="btn btn-sm btn-secondary mt-1" type="submit" value="reply" name="btn-comment"></div>

                            </form>
                        
                        <!-- show comments  -->
                        <?php
                         foreach(comments() AS $comment){
                            if($comment['forum_id'] == $row['id']) {
                        ?>
                            <div class="p-des__reply">
                                <h6 class="p-des__reply-author"> <a href="#"  class="text-secondary"><?=$comment['f_name'] .' '.$comment['l_name'] ?></a> </h6>
                                <p><?=$comment['comment']?></p>
                                <div class="p-des__reply-info">
                                    <p class="p-des__reply-time"><?=$comment['comment_date']?></p>
                                    <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                                </div>
                            </div>
                        <?php  } } ?>
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

<?php
include_once "./layout/footer.php"

?>