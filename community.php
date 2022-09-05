<?php
$title = "Community Forum";
$state = "community";
$banner_title = "write your won post here";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
?>
<main class="main">
    <section class="segment-margin community">
        <!-- post sectoin  -->
        <div class="community__post post">
            <div class="post__card">
                <div class="post__title">
                    <h3 class="post__author">Name Of author</h3>
                    <h4 class="post__upload-info">date of the post</h4>
                </div>
                <div class="p-des">
                    <p class="p-des__article">
                        &Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis alias magnam quas accusantium nulla assumenda doloribus dolore inventore aliquid ad.
                    </p>
                    <div class="p-des__react-info" id="blah">
                        <div class="p-des__comment btn-comment"><span id="commnetsCount" class="comment-count"></span><span> comments</span><i class="picon-size fa-solid fa-comments"></i></div>
                        <div class="p-des__react"> <span id="reactCount">5 </span><i class="picon-size fa-solid fa-face-grin-hearts"></i></div>
                    </div>
                    <div class="p-des__comments comment-reply" id="commentsReply">
                        <hr>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="post__card">
                <div class="post__title">
                    <h3 class="post__author">Name Of author</h3>
                    <h4 class="post__upload-info">date of the post</h4>
                </div>
                <div class="p-des">
                    <p class="p-des__article">
                        &Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis alias magnam quas accusantium nulla assumenda doloribus dolore inventore aliquid ad.
                    </p>
                    <div class="p-des__react-info">
                        <div class="p-des__comment btn-comment"><span id="commnetsCount" class="comment-count"></span><span> comments</span><i class="picon-size fa-solid fa-comments"></i></div>
                        <div class="p-des__react"> <span id="reactCount">5 </span><i class="picon-size fa-solid fa-face-grin-hearts"></i></div>
                    </div>
                    <div class="p-des__comments comment-reply" id="commentsReply">
                        <hr>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post__card">
                <div class="post__title">
                    <h3 class="post__author">Name Of author</h3>
                    <h4 class="post__upload-info">date of the post</h4>
                </div>
                <div class="p-des">
                    <p class="p-des__article">
                        &Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis alias magnam quas accusantium nulla assumenda doloribus dolore inventore aliquid ad.
                    </p>
                    <div class="p-des__react-info">
                        <div class="p-des__comment btn-comment"><span id="commnetsCount" class="comment-count"></span><span> comments</span><i class="picon-size fa-solid fa-comments"></i></div>
                        <div class="p-des__react"> <span id="reactCount">5 </span><i class="picon-size fa-solid fa-face-grin-hearts"></i></div>
                    </div>
                    <div class="p-des__comments comment-reply" id="commentsReply">
                        <hr>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                        <div class="p-des__reply">
                            <h6 class="p-des__reply-author"> <a href="#">Mayesha</a> </h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate, ipsam.</p>
                            <div class="p-des__reply-info">
                                <p class="p-des__reply-time">4 hour ago</p>
                                <span class="p-des__reply-icon"><i class="picon-size fa-solid fa-face-grin-hearts"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
        btnComment[i].firstElementChild.textContent = btnComment[i].parentNode.nextElementSibling.children.length - 1;
        btnComment[i].addEventListener('click', () => {
            btnComment[i].parentNode.nextElementSibling.classList.toggle('comments-visible');
        })
    }

</script>

<?php
include_once "./layout/footer.php"

?>