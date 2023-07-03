<link rel="stylesheet" href="<?php echo e(asset('css/pages/network.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5"><i class="fa-solid fa-network-wired"></i> Network</h1>
        </div>
        <div class="container-fluid rapport_container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="badge-item">
                        <div class="row mt-2">
                            <div class="col-auto d-flex align-items-center">
                                <img src="<?php echo e(asset('storage/images/users/profile/' . Auth::user()->avatar )); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="badge-image">
                            </div>
                            <div class="col">
                                <div class="badge-details">
                                    <h3><?php echo e(Auth::user()->name); ?></h3>
                                    <span><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $__currentLoopData = $users->take(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->id !== Auth::user()->id): ?>
                            <div class="badge-item mt-3">
                                <div class="row mt-2">
                                    <div class="col-auto d-flex align-items-center">
                                        <img src="<?php echo e(asset('storage/images/users/profile/' . $user->avatar )); ?>" alt="<?php echo e($user->name); ?>" class="badge-image">
                                    </div>
                                    <div class="col">
                                        <div class="badge-details">
                                            <h3><?php echo e($user->name); ?></h3>
                                            <span><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?> </span>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center badge-actions">
                                        <?php
                                            $friendship = DB::table('friendships')
                                                ->where(function ($query) use ($user) {
                                                    $query->where('user_id', Auth::user()->id)
                                                        ->where('friend_id', $user->id);
                                                })
                                                ->orWhere(function ($query) use ($user) {
                                                    $query->where('user_id', $user->id)
                                                        ->where('friend_id', Auth::user()->id);
                                                })
                                                ->first();
                                        ?>
                                        <?php if($friendship && $friendship->confirm == 0): ?>
                                            <button class="btn mx-2 btn-circle btn-waiting" title="En attente" disabled>
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text"> En attente</span>
                                            </button>
                                        <?php elseif($friendship): ?>
                                            <button class="btn mx-2 btn-circle btn-primary" title="Ami ajouté" disabled>
                                                <i class="fa-solid fa-user-check"></i>
                                                <span class="btn-text"> Ami</span>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn mx-2 btn-circle btn-success add-friend-btn" data-id="<?php echo e($user->id); ?>" title="Ajouter en ami">
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text"> Ajouter</span>
                                            </button>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('user.show', ['user' => $user->id])); ?>" class="btn btn-warning btn-circle" title="Voir le profil">
                                            <i class="fa-solid fa-user"></i> Profil
                                        </a>
                                        <?php if($friendship): ?>
                                            <button class="btn mx-2 btn-circle btn-danger remove-friend-btn" data-id="<?php echo e($user->id); ?>" title="Supprimer l'ami">
                                                <span class="btn-text">
                                                    X
                                                </span>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-12 col-lg-6">
                    <!-- Afficher les autres utilisateurs -->
                    <?php $__currentLoopData = $users->skip(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->id !== Auth::user()->id): ?>
                            <div class="badge-item mt-3">
                                <div class="row mt-2">
                                    <div class="col-auto d-flex align-items-center">
                                        <img src="<?php echo e(asset('storage/images/users/profile/' . $user->avatar )); ?>" alt="<?php echo e($user->name); ?>" class="badge-image">
                                    </div>
                                    <div class="col">
                                        <div class="badge-details">
                                            <h3><?php echo e($user->name); ?></h3>
                                            <span><?php echo e($user->last_name); ?> <?php echo e($user->first_name); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center badge-actions">
                                        <?php
                                            $friendship = DB::table('friendships')
                                            ->where(function ($query) use ($user) {
                                                $query->where('user_id', Auth::user()->id)
                                                    ->where('friend_id', $user->id);
                                            })
                                            ->orWhere(function ($query) use ($user) {
                                                $query->where('user_id', $user->id)
                                                    ->where('friend_id', Auth::user()->id);
                                            })
                                            ->first();
                                        ?>
                                        <?php if($friendship && $friendship->confirm == 0): ?>
                                            <button class="btn mx-2 btn-circle btn-waiting" title="En attente" disabled>
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text"> En attente</span>
                                            </button>
                                        <?php elseif($friendship): ?>
                                            <button class="btn mx-2 btn-circle btn-primary" title="Ami ajouté" disabled>
                                                <i class="fa-solid fa-user-check"></i>
                                                <span class="btn-text"> Ami</span>
                                            </button>

                                        <?php else: ?>
                                            <button class="btn mx-2 btn-circle btn-success add-friend-btn" data-id="<?php echo e($user->id); ?>" title="Ajouter en ami">
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text"> Ajouter</span>
                                            </button>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('user.show', ['user' => $user->id])); ?>" class="btn btn-warning btn-circle" title="Voir le profil">
                                            <i class="fa-solid fa-user"></i> Profil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-waiting').addClass('btn-primary');

        $(document).on('click', '.add-friend-btn', function(e) {
            e.preventDefault();

            var button = $(this);
            var userId = button.data('id');

            if (button.find('.btn-text').text() === ' Ajouter') {
                $.ajax({
                    url: '/add-friend',
                    method: 'POST',
                    data: {
                        userId: userId,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        console.log(response);
                        button.find('.btn-text').text(' En attente');
                        button.addClass('btn-primary').removeClass('btn-success');
                        button.prop('disabled', true);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

        $(document).on('click', '.remove-friend-btn', function(e) {
            e.preventDefault();

            var button = $(this);
            var userId = button.data('id');

            if (button.text().trim() === 'X') {
                $.ajax({
                    url: '/delete-friend',
                    method: 'POST',
                    data: {
                        userId: userId,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    });

</script>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/social/network.blade.php ENDPATH**/ ?>