<?php echo $__env->make('Chatify::layouts.headLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="messenger" style="z-index: 100000;">
        
        <div class="messenger-listView <?php echo e(!!$id ? 'conversation-active' : ''); ?>">
            <div class="messenger-logo">

                <?php if(Auth()->user()->dark_mode == 0): ?>
                    <img src="<?php echo e(asset('storage/images/intra_dark.png')); ?>" alt="" class="centered-image">
                <?php else: ?>
                    <img src="<?php echo e(asset('storage/images/intra.png')); ?>" alt="" class="centered-image">
                <?php endif; ?>
            </div>
            <style>
                .centered-image {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }
            </style>
            
            <div class="m-header">
                <nav>
                    <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Messagerie</span> </a>
                    
                    <nav class="m-header-right">
                        <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                    </nav>
                </nav>
                
                <input type="text" class="messenger-search" placeholder="Rechercher" />
                
                
            </div>
            
            <div class="m-body contacts-container">
                
                
                <div class="show messenger-tab users-tab app-scroll" data-view="users">
                    
                    <div class="favorites-section">
                        <p class="messenger-title"><span>Amis</span></p>
                        <div class="messenger-favorites"></div>
                    </div>
                    

                    
                    <p class="messenger-title"><span>Tous les messages</span></p>
                    <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
                </div>
                
                <div class="messenger-tab search-tab app-scroll" data-view="search">
                    
                    <p class="messenger-title"><span>Rechercher</span></p>
                    <div class="search-records">
                        <p class="message-hint center-el"><span>Ecrivez pour rechercher...</span></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="messenger-messagingView">
            
            <div class="m-header m-header-messaging">
                <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    
                    <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                           <?php if($user): ?>
                            <div class="avatar av-s header-avatar" style="background-image: url('<?php echo e(asset('storage/images/users/profile/' . $user->id . '.jpg')); ?>'); margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                            </div>
                           <?php endif; ?>
                        <a href="#" class="user-name"><?php echo e(config('chatify.name')); ?></a>
                    </div>
                    
                    <nav class="m-header-right">
                        <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                        <a href="/"><i class="fas fa-home"></i></a>
                        <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                    </nav>
                </nav>
                
                <div class="internet-connection">
                    <span class="ic-connected">Conneté</span>
                    <span class="ic-connecting">Connexion...</span>
                    <span class="ic-noInternet">Pas d'accès à internet</span>
                </div>
            </div>

            
            <div class="m-body messages-container app-scroll">
                <div class="messages">
                    <p class="message-hint center-el"><span>Sélectionnez un utilisateur pour commencer une conversation</span></p>
                </div>
                
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                        </div>
                    </div>
                </div>

            </div>
            
            <?php echo $__env->make('Chatify::layouts.sendForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        
        <div class="messenger-infoView app-scroll">
            
            <nav>
                <p>Détails </p>
                <a href="#"><i class="fas fa-times"></i></a>
            </nav>
            <?php echo view('Chatify::layouts.info')->with('user', $user)->render(); ?>

        </div>
    </div>

    <?php echo $__env->make('Chatify::layouts.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Chatify::layouts.footerLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/vendor/Chatify/pages/app.blade.php ENDPATH**/ ?>