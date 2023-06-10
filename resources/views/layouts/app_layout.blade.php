<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link
        rel="stylesheet"

        href="https://site-assets.fontawesome.com/releases/v6.3.0/css/all.css"
    >
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- JS de jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JS de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="{{ asset('intra.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app_layout.css') }}">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>INTRA</title>
</head>
<body>

<div id="app" style="width: 100%; position: fixed; top: 0; left: 0;" class="header finisher-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <div class="row">
                        <h1 class="text-center mt-5 sidebar-title">intra</h1>
                    </div>
                    <div class="row mt-5">
                        <div class="menu_section">
                            <p class="menu_title"><b>Menu</b></p>
                            <div class="menu_item col-10">
                                <i class="fa-solid fa-house"></i> <span>Accueil</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-bolt-lightning"></i> <span>Fonctionnement</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-newspaper"></i> <span>Actualités</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-user-group"></i> <span>Amis</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-network-wired"></i> <span>Network</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-messages"></i> <span>Messages</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-bell"></i> <span>Notifications</span>
                            </div>
                        </div>
                        <div class="menu_section mt-5">
                            <p class="menu_title"><b>Intra</b></p>
                            <div class="menu_item">
                                <i class="fa-regular fa-globe"></i> <span>Découvrir</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-brands fa-github"></i> <span>Contribuer</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-bug"></i> <span>Rapport / Bug</span>
                            </div>
                        </div>
                        <div class="menu_section mt-5">
                            <p class="menu_title"><b>Compte</b></p>
                            <div class="menu_item">
                                <i class="fa-solid fa-trophy-star"></i> <span>Succès</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-square-user"></i> <span>Profil</span>
                            </div>
                            <div class="menu_item">
                                <i class="fa-solid fa-gear"></i> <span>Paramètres</span>
                            </div>
                            <div class="disconnect_link">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-circle-xmark"></i> <span class="logout_span ">Déconnexion</span>
                                </a>
                            </div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="row mt-5 justify-content-center text-center">
                        <span class="version">Version 1.0.1</span>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class=" main_app">
                    <div class="content p-5">
                        <div class="container-fluid">
                            <div class="row home_top_row">
                                <div class="col-md-6 text-start top_row_left_item mt-3">
                        <span class="top_left_item new_post_link" v-on:click="newPost()">
                             <i class="fa-solid fa-square-pen" ></i>Nouvelle publication
                        </span>
                                    <span class="top_left_item">
                            <i class="fa-solid fa-square-phone"></i> Appeler
                        </span>
                                </div>
                                <div class="col-md-6 text-end top_row_right_item">
                                    <div class="row justify-content-end">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                                                <div class="ms-2">
                                                    <div class="profile_name">{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</div>
                                                    <div class="status">
                                                        <i class="fa-solid fa-circle"></i>
                                                        En ligne
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="scrollable-content p-2">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <p class="app_credits text-center">
                            © 2023 Intra. Tous droits réservés.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-overlay">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="text-right p-5 new_post_close" >
                    <i class="fa-solid fa-circle-xmark" v-on:click="closeNewPost()"></i>
                </div>
            </div>
            <div class="row">
                <div class="h1 text-center text-light">Publier un nouveau post</div>
                <form action="" method="POST">
                    @csrf
                    <div class="row justify-content-evenly">
                        <div class="col-10">
                           <div class="row justify-content-between">
                               <div class="col-5 form">
                                   <div class="row">
                                       <div class="form-group">
                                           <label for="title">Titre</label>
                                           <input type="text" name="title" id="title" class="form-control">
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="form-group">
                                           <label for="section">Section</label>
                                           <input type="text" name="section" id="section" class="form-control">
                                       </div>
                                   </div>
                                   <div class="row message_row">
                                       <div class="form-group">
                                           <label for="message">Message</label>
                                           <textarea name="message" id="message" class="form-control h-100"></textarea>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-5 form">
                                   <div class="row code_row">
                                       <div class="form-group">
                                           <label for="code">Code</label>
                                           <textarea name="code" id="code" class="form-control h-100"></textarea>
                                       </div>
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-3 text-center mt-5">
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const app = Vue.createApp({
        data() {
            return {

            };
        },
        methods: {
            newPost() {
                var modalOverlay = document.getElementById('modal-overlay');
                var computedStyle = window.getComputedStyle(modalOverlay);

                if (computedStyle.display === 'block') {
                    modalOverlay.style.display = 'none';
                } else if (computedStyle.display === 'none') {
                    modalOverlay.style.display = 'block';
                }
            },
            closeNewPost(){
                document.getElementById('modal-overlay').style.display = 'none';
            }
        }
    });
    app.mount("#app");
</script>

<script src="{{ asset('js/finisher-header.es5.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    new FinisherHeader({
        "count": 10,
        "size": {
            "min": 1300,
            "max": 1500,
            "pulse": 0
        },
        "speed": {
            "x": {
                "min": 0.1,
                "max": 0.4
            },
            "y": {
                "min": 0.1,
                "max": 0.4
            }
        },
        "colors": {
            "background": "#121d27",
            "particles": [
                "#121d27",
                "#194969",
                "#124265",
                "#121d27",
                "#0d3861"
            ]
        },
        "blending": "overlay",
        "opacity": {
            "center": 0.5,
            "edge": 0.05
        },
        "skew": 0,
        "shapes": [
            "c"
        ]
    });
</script>

</body>
</html>
