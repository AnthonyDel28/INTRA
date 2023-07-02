<link rel="stylesheet" href="<?php echo e(asset('css/pages/game.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5 text-light"><i class="fa-solid fa-gamepad-modern"></i> GameHub</h1>
        </div>
        <div class="row">
            <div class="col-2 align-items-center">
                <a href="/snake" id="game_link">
                    <img src="<?php echo e(asset('images/assets/games/snake.jpg')); ?>" alt="" class="game_img">
                </a>
                <button class="btn btn-primary mt-4 align-self-start" onclick="redirectToSnakeScores()">Voir les résultats</button>
                <script>
                    function redirectToSnakeScores() {
                        window.location.href = '/snakeScores/';
                    }
                </script>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    document.getElementById('game_link').addEventListener('click', function(event) {
        event.preventDefault();
        event.target.classList.add('darken');
        setTimeout(function() {
            window.location.href = event.target.href;
        }, 500);
    });
</script>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/games/games.blade.php ENDPATH**/ ?>