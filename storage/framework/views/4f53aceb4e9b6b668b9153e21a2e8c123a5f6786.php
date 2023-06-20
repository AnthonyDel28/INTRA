<link rel="stylesheet" href="<?php echo e(asset('css/pages/home.css')); ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-9 home_left_div p-4">
            <div class="row">
                <h2 class="home_title">
                    Bienvenue <b> <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></b> ! <i class="fa-thin fa-robot"></i>
                </h2>
            </div>
            <div class="row">
                <div class="col-7 home_main_picture p-0 m-3">
                    <img src="<?php echo e(asset('images/assets/intraheader.png')); ?>" alt="">
                </div>
            </div>
            <div class="row mt-5">
                <h3 class="home_title">Dernières publications</h3>
            </div>
            <div class="row">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-5 home_post m-2">
                        <div class="row m-4">
                            <div class="col-2">
                                <img src="<?php echo e(asset('storage/images/users/profile/' . $post->author_image)); ?>" alt="" class="post_img" style="object-fit: cover;">
                            </div>
                            <div class="col-2">
                                <span class="post_infos_name"><?php echo e($post->first_name); ?>

                                    <br>
                                    <?php echo e($post->last_name); ?>

                                    <br>
                                  <span class="post_infos_date">
                                       <?php echo e(\Carbon\Carbon::parse($post->post_created_at)->format('d/m/Y H:i')); ?>

                                  </span>
                                </span>
                            </div>
                            <div class="col-8 justify-content-center">
                                <span class="text-center post_infos_title">
                                    <?php echo Str::limit(htmlspecialchars(nl2br($post->title)), $limit = 70, $end = '...'); ?>

                                </span>
                            </div>
                        </div>
                        <div class="row like_row justify-content-end" style="justify-content: flex-end;">
                            <div class="col-4 text-center">
                                <span class="like_text">
                                    <span id="likeCount_<?php echo e($post->post_id); ?>" class="like_value like_count"><?php echo e($post->likes); ?></span>
                                    j'aime
                                </span>
                            </div>
                        </div>
                        <div class="row mt-2 justify-content-center">
                            <?php if($post->code): ?>
                                <div class="col-10 post_message_area" style="height: 80px; overflow: hidden;">
                                    <span class="text-center">
                                        <?php echo nl2br(e(Str::limit($post->message, $limit = 100, $end = '...'))); ?>

                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="col-10 post_message_area" style="height: 180px; overflow: hidden;">
                                    <span class="text-center">
                                        <?php echo nl2br(e(Str::limit($post->message, $limit = 400, $end = '...'))); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', (event) => {
                                document.querySelectorAll('pre code').forEach((el) => {
                                    hljs.highlightElement(el);
                                });
                            });
                        </script>
                        <?php if($post->code): ?>
                            <div class="row mt-2 justify-content-center">
                                <div class="col-10 post_message_area">
                                    <pre>
                                        <code class="language-<?php echo e($post->language); ?>" id="code_insert">
                                            <?php echo Str::limit(htmlspecialchars(nl2br($post->code)), $limit = 150, $end = '...'); ?>

                                        </code>
                                    </pre>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row justify-content-center mt-4">
                            <div class="col-10 post_actions">
                                <div class="row mb-5">
                                    <div class="col-6 text-center">
                                         <span class="like_button" id="likeButton_<?php echo e($post->post_id); ?>" data-postid="<?php echo e($post->post_id); ?>">
                                                <?php if($post->isLiked): ?>
                                                 <i class="fa-solid fa-thumbs-down"></i>
                                                 <span class="like_text">Je n'aime plus</span>
                                             <?php else: ?>
                                                 <i class="fa-solid fa-thumbs-up"></i>
                                                 <span class="like_text">J'aime</span>
                                             <?php endif; ?>
                                        </span>
                                    </div>
                                    <div class="col-6 text-center">
                                        <span class="action_post" onclick="showPostDetails(<?php echo e($post->post_id); ?>)">
                                            <i class="fa-brands fa-readme"></i> Lire le post
                                        </span>
                                        <script>
                                            function showPostDetails(postId) {
                                                window.location.href = '/posts/' + postId;
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="col-3">
            <div class="row mt-5">
                <h4 class="home_title">Recherche rapide</h4>
                <form action="" method="GET" class="mt-3">
                    <input type="text" name="query" placeholder="Rechercher..." class="search_bar">
                    <button type="submit" class="search_bar_button">Rechercher</button>
                </form>
            </div>
            <div class="row mt-5">
                <div class="col-10 mb-3">
                    <h4 class="home_title">Amis</h4>
                    <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center mt-3">
                            <img src="<?php echo e(asset('storage/images/users/profile/' . $friend->avatar)); ?>" alt="" class="profile-picture" style="object-fit: cover;">
                            <div class="ms-2 friends_name"><?php echo e($friend->last_name); ?> <?php echo e($friend->first_name); ?> <i class="fa-solid fa-circle"></i></div>
                            <div class="ms-auto friends_icons">
                                <a href="<?php echo e(route('user.show', ['user' => $friend->id])); ?>">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <i class="fa-solid fa-phone-alt"></i>
                                <i class="fa-solid fa-message"></i>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-10">
                    <h4 class="home_title">Calendrier</h4>
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.like_button').each(function() {
            var likeButton = $(this);
            var postId = likeButton.data('postid');
            var likeCountElement = $('#likeCount_' + postId);
            var likeTextElement = likeButton.find('.like_text');

            likeButton.click(function() {
                $.ajax({
                    url: '<?php echo e(url("/posts/like")); ?>',
                    method: 'POST',
                    data: {
                        postId: postId,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            var likeCount = parseInt(likeCountElement.text());
                            var likeText = likeTextElement.text();

                            if (likeText === 'Je n\'aime plus') {
                                likeCount--;
                                likeTextElement.text('J\'aime');
                                likeButton.find('i').removeClass('fa-thumbs-down').addClass('fa-thumbs-up');
                            } else {
                                likeCount++;
                                likeTextElement.text('Je n\'aime plus');
                                likeButton.find('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-down');
                            }
                            likeCountElement.text(likeCount);
                        }
                    }
                });
            });
        });
    });

</script>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/home.blade.php ENDPATH**/ ?>