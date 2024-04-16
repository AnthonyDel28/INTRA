<link rel="stylesheet" href="<?php echo e(asset('css/pages/home.css')); ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->check()): ?>
        <div class="row">
            <div class="col-12 col-lg-9 home_left_div p-4">
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
                        <div class="col-lg-5 col-10 home_post m-2">
                            <div class="row m-4">
                                <div class="col-2">
                                    <img src="<?php echo e(asset('storage/images/users/profile/' . $post->author_image)); ?>" alt="" class="post_img" style="object-fit: cover;">
                                </div>
                                <div class="col-lg-2 col-8">
                                <span class="post_infos_name"><?php echo e($post->first_name); ?>

                                    <br>
                                    <?php echo e($post->last_name); ?>

                                    <br>
                                  <span class="post_infos_date">
                                       <?php echo e(\Carbon\Carbon::parse($post->post_created_at)->format('d/m/Y H:i')); ?>

                                  </span>
                                </span>
                                </div>
                                <div class="col-10 col-lg-8 justify-content-center">
                                <span class="text-center post_infos_title">
                                   <?php echo nl2br(htmlspecialchars(substr($post->title, 0, 70) . (strlen($post->title) > 70 ? '...' : ''))); ?>

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
                                       <?php echo nl2br(htmlspecialchars(substr($post->message, 0, 100) . (strlen($post->message) > 100 ? '...' : ''))); ?>

                                    </span>
                                    </div>
                                <?php else: ?>
                                    <div class="col-10 post_message_area" style="height: 180px; overflow: hidden;">
                                    <span class="text-center">
                                      <?php echo nl2br(htmlspecialchars(substr($post->message, 0, 400) . (strlen($post->message) > 100 ? '...' : ''))); ?>


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
                                          <?php echo htmlspecialchars(nl2br(substr($post->code, 0, 150))); ?><?php echo e(strlen($post->code) > 150 ? '...' : ''); ?>

                                        </code>
                                    </pre>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row justify-content-center mt-4">
                                <div class="col-12 post_actions">
                                    <div class="row mb-5">
                                        <div class="col-10 col-md-6 col-xl-6 text-center mt-3">
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
                                        <div class="col-10 col-md-6 col-xl-6 text-center mt-3">
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
            <div class="col-10 col-lg-3 p-5">
                <div class="row mt-5">
                    <h4 class="home_title">Recherche rapide</h4>
                    <form action="<?php echo e(route('search')); ?>" method="GET" class="mt-3">
                        <input type="text" name="query" placeholder="Rechercher..." class="search_bar" minlength="3" required>
                        <button type="submit" class="search_bar_button">Rechercher</button>
                    </form>
                </div>
                <div class="row mt-5">
                    <div class="col-10 mb-3">
                        <h4 class="home_title">Amis</h4>
                        <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mt-3">
                                <img src="<?php echo e(asset('storage/images/users/profile/' . $friend->avatar)); ?>" alt="" class="profile-picture" style="object-fit: cover;">
                                <div class="ms-2 friends_name"><?php echo e($friend->first_name); ?>  <?php echo e($friend->last_name); ?> <i class="fa-solid fa-circle"></i></div>
                                <div class="ms-auto friends_icons">
                                    <a href="<?php echo e(route('user.show', ['user' => $friend->id])); ?>">
                                        <i class="fa-solid fa-user"></i>
                                    </a>
                                    <i class="fa-solid fa-message" onclick="messengerFriend(<?php echo e($friend->id); ?>)"></i>
                                    <script>
                                        function messengerFriend(friendId) {
                                            window.location.href = '/messenger/' + friendId;
                                        }
                                    </script>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-10">
                        <h4 class="home_title">Actualités</h4>
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="news_item bg-dark p-3 mt-3" onclick="redirectToNews()">
                                <h5 class="text-light"><?php echo e($new->title); ?></h5>
                                <p class="news_date text-primary"><?php echo e($new->created_at); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <script>
                            function redirectToNews(){
                                window.location.href = '/news/';
                            }
                        </script>
                    </div>

                </div>
            </div>

        </div>
        <div class="cookie-popup active">
            <div class="cookie-popup_container">
                <div class="cookie-popup_container_text">
                    Este website utiliza cookies de forma que possa ter a melhor experiência de navegação possível. Utiliza também cookies de identificação e de profiling para personalizar e facilitar a navegação de acordo com as suas preferências, nomeadamente evitando a necessidade de introduzir repetidamente as mesmas informações. Ao continuar a navegar ou ao clicar na opção "ACEITAR AS COOKIES", consente a sua utilização.
                </div>
                <button class="cookie-popup_container_btn accept-cookies"> Aceitar as Cookies </button>
                <button class="cookie-popup_container_btn check-options"> Opções de Cookies </button>
                <a href="#0" class="cookie-popup_container_link">Fechar</a>
            </div>
        </div>

        <div class="cookie-configurador">
            <div class="cookie-configurador_container">
                <div class="ccc ccc_maintitle">
                    Cookies nas plataformas digitais da "empresa" e seus links acessórios.
                </div>
                <div class="ccc ccc_text">
                    Cookies nas plataformas digitais da "empresa".
                    Decida, já, se pretende prosseguir de imediato para os conteúdos "empresa", aceitando os cookies utilizados nas nossas plataformas digitais. Clique no botão seguinte "ACEITAR AS COOKIES".
                </div>
                <button class="cookie-popup_container_btn ccc ccc_btn accept-cookies"> Aceitar as Cookies </button>
                <div class="ccc ccc_text">
                    Ou, em alternativa, se pretender dedicar mais tempo a esta operação, escolha as suas preferências! Tem todo o tempo do mundo.
                </div>
                <div class="ccc ccc_line"></div>
                <div class="ccc ccc_title">Funcionalidades Básicas</div>
                <div class="ccc ccc_option">
                    <div class="ccc ccc_option_input">
                        <input type="checkbox" id="consent_1" name="consent_1" value="1" disabled="disabled" checked="checked">
                        Cookies Básicos e Imprescindíveis
                    </div>
                    <div class="ccc ccc_option_text">
                        São imprescindíveis para navegar nas plataformas digitais RTP e para garantir que usufrui de uma oferta de serviço público de excelência. Servem para medição de audiências e de nível de serviço e possibilitam, a divulgação de publicidade sem personalização.
                    </div>
                </div>

                <div class="ccc ccc_option">
                    <div class="ccc ccc_option_input">
                        <input type="checkbox" id="consent_2" name="consent_2" value="0">
                        Cookies de Consumo
                    </div>
                    <div class="ccc ccc_option_text">
                        Permitem personalizar as ofertas comerciais que lhe são apresentadas, direcionando-as para os seus interesses. Podem ser cookies próprios ou de terceiros. Alertamos que, mesmo não aceitando estes cookies, irá receber ofertas comerciais, mas sem corresponderem às suas preferências.
                    </div>
                </div>

                <div class="ccc ccc_option">
                    <div class="ccc ccc_option_input">
                        <input type="checkbox" id="consent_3" name="consent_3" value="0">
                        Cookies de Performance
                    </div>
                    <div class="ccc ccc_option_text">
                        Permitem personalizar as ofertas comerciais que lhe são apresentadas, direcionando-as para os seus interesses. Podem ser cookies próprios ou de terceiros. Alertamos que, mesmo não aceitando estes cookies, irá receber ofertas comerciais, mas sem corresponderem às suas preferências.
                    </div>
                </div>

                <div class="ccc ccc_option">
                    <div class="ccc ccc_option_input">
                        <input type="checkbox" id="consent_4" name="consent_4" value="0">
                        Cookies Sociais
                    </div>
                    <div class="ccc ccc_option_text">
                        Permitem personalizar as ofertas comerciais que lhe são apresentadas, direcionando-as para os seus interesses. Podem ser cookies próprios ou de terceiros. Alertamos que, mesmo não aceitando estes cookies, irá receber ofertas comerciais, mas sem corresponderem às suas preferências.
                    </div>
                </div>

                <div class="ccc ccc_newfuncs">
                    Faça as suas escolhas dos vários tipos de cookies e clique em
                    <button class="ccc ccc_minimalbtn">SUBMETER PREFERÊNCIAS</button>.
                </div>

                <button class="ccc ccc_btn-back gobacknow">Voltar</button>

                <div class="ccc ccc_line"></div>

                <div class="ccc ccc_policies">
                    <a href="#0" class="ccc_policy">Polica de Privacidade</a>
                    <div class="ccc_breaker"></div>
                    <a href="#0" class="ccc_policy">Politica de Cookies</a>
                </div>

            </div>
        </div>
    <?php endif; ?>
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

<style>

    .cookie-popup {
        transition:0.3s;
        z-index:-999;
        pointer-events:none;
        opacity:0;
        position:fixed;
        bottom:0;
        width:100vw;
        left:0;
        height:auto;
        display:flex;
        align-items:center;
        justify-content:flex-start;
    &.active {
         z-index:80000;
         pointer-events:auto;
         opacity:1;
     }
    &_container {
         max-width:1250px;
         margin:auto;
         padding:25px;
         background:#333;
         box-shadow: 1px 1px 18px rgba(0,0,0,.19);
    &_text{
         color:#fff;
         margin-bottom:22px;
         font-weight:400;
         font-size:14px;
         line-height:20px;
     }
    &_btn{
         align-items:center;
         justify-content:center;
         width:180px;
         height:45px;
         border-radius:2px;
         font-weight:700;
         font-size:12px;
         line-height:22px;
         text-transform:uppercase;
         cursor:pointer;
         display:inline-flex;
         letter-spacing:0.4px;
    &:nth-child(2){
         background:#32CD32;
         color:#fff;
         border:1px solid #32CD32;
     }
    &:nth-child(3){
         background:#828282;
         color:#333;
         border:1px solid #828282;
     }
    }
    &_link {
         color:#fff;
         text-decoration:none;
         float:right;
         height:45px;
         display:flex;
         align-items:center;
         margin-right:15px;
         text-transform:uppercase;
     }
    }
    }

    @media(min-width:120px) and (max-width:600px){
        .cookie-popup_container_btn,
        .cookie-popup_container_link {
            float:left;
            margin-bottom:12px;
            margin-right:12px;
        }
    }

    .cookie-configurador {
        transition:0.3s;
        opacity:0;
        pointer-events:none;
        z-index:-1000;
        max-width:600px;
        position:absolute;
        top:10vh;
        left:0;
        right:0;
        margin:auto;
        background:#fff;
        box-shadow:1px 2px 12px rgba(0,0,0,.18);
        max-height:auto;
        overflow-y:auto;
    &.active{
         opacity:1;
         pointer-events:auto;
         z-index:1000;
     }
    &_container{
         width:100%;
         padding:25px;
    .ccc{
        margin-bottom:22px;
    &_maintitle {
         font-size:15px;
         font-weight:700;
         color:#32CD32;
         text-transform:uppercase;
     }
    &_text{
         font-size:14px;
    &:nth-child(3){
         font-size:13px;
     }
    }
    &_line {
         width:100%;
         height:1px;
         background:#e9e9e9;
     }
    &_title{
         font-size:20px;
         margin-bottom:18x;
     }
    &_option {
    &_input{
         font-size:16px;
         color:#32CD32;
         margin-bottom:8px;
    input{
        vertical-align:text-top;
    }
    }
    &_text {
         font-size:14px;
     }
    }
    &_btn {
         background:#32CD32;
         border:1px solid #32CD32;
         color:#fff;
     }
    &_newfuncs {
         font-size:14px;
         margin-top:30px;
         color:#666;
     }
    &_minimalbtn {
         border:none;
         background:transparent;
         font-size:14px;
         padding:0;
         color:#0074FF;
         text-decoration:underline;
         cursor:pointer;
         margin-bottom:0;
     }
    &_breaker {
         display:inline-block;
         height:4px;
         width:4px;
         background:#0074FF;
         margin:0 12px;
         vertical-align:middle;
         border-radius:50%;
     }
    &_policies {
         margin-bottom:0;
     }
    a {
        color:#0074FF;
        text-decoration:none;
    }
    &_btn-back {
         background:#828282;
         border:1px solid #828282;
         color:#fff;
         width:auto;
         padding:0 35px;
         height:45px;
         font-size:14px;
         text-transform:uppercase;
         border-radius:2px;
         margin:8px 0 28px 0;
         cursor:pointer;
     }
    }
    }
    }
</style>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/home.blade.php ENDPATH**/ ?>