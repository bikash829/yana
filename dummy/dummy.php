<!-- <div class="post__card">
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
            </div> -->


            `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`, `additional_info`.`education`, `additional_info`.`working_info`
            FROM `users`
            INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
            INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`


            // user id 
                $user_id = $data['id'];
                if ($data['role_id'] == 2 || $data['role_id'] == 3) {
                    $sql = "SELECT  `social_medium`.`id` AS `medium_id`, `social_medium`.`medium`,`social_user_link`.`link` AS `social_link` 
                            FROM `users`
                            INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
                            INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
                            WHERE `users`.`id` = $user_id;";

                    if ($social_info_set = db_connection()->query($sql)) {
                        $social_info = $social_info_set->fetch_all(MYSQLI_ASSOC);
                        $data['social_info'] = $social_info;
                    } else {
                        $validation  = "Technical error contact with developer";
                    }
                }


                // additional information 
                if(!($data['role_id'] == 1)){
                    $user_id = $data['id'];

                    $sql = "SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`, `additional_info`.`education`, `additional_info`.`working_info`
                            FROM `users`
                            INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
                            INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`
                            WHERE `users`.`id` = $user_id;
                            ";

                    if($user_info = db_connection()->query($sql)){
                        $data = $user_info->fetch_all(MYSQLI_ASSOC);
                    }

                    $sql = "SELECT  `social_medium`.`id` AS `medium_id`, `social_medium`.`medium`,`social_user_link`.`link` AS `social_link` 
                            FROM `users`
                            INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
                            INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
                            WHERE `users`.`id` = $user_id;";

                    if ($social_info_set = db_connection()->query($sql)) {
                        $social_info = $social_info_set->fetch_all(MYSQLI_ASSOC);
                        $data['social_info'] = $social_info;
                    } 
                }