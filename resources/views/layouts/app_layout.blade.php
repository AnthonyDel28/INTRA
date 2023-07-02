<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Code">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dank+Mono">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link
        rel="stylesheet"

        href="https://site-assets.fontawesome.com/releases/v6.3.0/css/all.css"
    >

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/night-owl.min.css">

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- JS de jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- JS de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/lottie.js') }}"></script>
    <link rel="icon" href="{{ asset('intra.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app_layout.css') }}">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>INTRA</title>
</head>
<body>

@auth
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
                                <div class="menu_item col-10" onclick="redirectToHome()">
                                    <i class="fa-solid fa-house"></i> <span>Accueil</span>
                                </div>
                                <script>
                                    function redirectToHome() {
                                        window.location.href = "/home";
                                    }
                                </script>

                                <div class="menu_item" onclick="redirectToAbout()">
                                    <i class="fa-solid fa-bolt-lightning"></i> <span>Fonctionnement</span>
                                    <script>
                                        function redirectToAbout() {
                                            window.location.href = "/about";
                                        }
                                    </script>
                                </div>
                                <div class="menu_item" onclick="redirectToNews()">
                                    <i class="fa-solid fa-newspaper"></i> <span>Actualités</span>
                                    <script>
                                        function redirectToNews() {
                                            window.location.href = "/news";
                                        }
                                    </script>
                                </div>
                                <div class="menu_item">
                                    <i class="fa-solid fa-user-group"></i> <span>Amis</span>
                                </div>
                                <div class="menu_item" onclick="redirectToNetwork()">
                                    <i class="fa-solid fa-network-wired"></i> <span>Network</span>
                                    <script>
                                        function redirectToNetwork() {
                                            window.location.href = "/network";
                                        }
                                    </script>
                                </div>
                                <div class="menu_item" onclick="redirectToMessages()">
                                    <i class="fa-solid fa-messages"></i> <span>Messages
                                 @if($messagesCount)
                                            <div class="messages-badge">{{ $messagesCount }}</div>
                                        @endif
                                </span>
                                    <script>
                                        function redirectToMessages() {
                                            window.location.href = "/messenger";
                                        }
                                    </script>

                                </div>
                                <div class="menu_item" onclick="redirectToNotifications()">
                                    <i class="fa-solid fa-bell"></i>
                                    <script>
                                        function redirectToNotifications() {
                                            window.location.href = "/notifications";
                                        }
                                    </script>
                                    <span>Notifications
                                    @if($notificationsCount)
                                            <div class="notification-badge">{{ $notificationsCount }}</div>
                                        @endif
                                </span>
                                </div>
                            </div>
                            <div class="menu_section mt-5">
                                <p class="menu_title"><b>Intra</b></p>
                                <div class="menu_item" onclick="redirectToGameHub()">
                                    <i class="fa-solid fa-gamepad-modern"></i> <span>GameHub</span>
                                    <script>
                                        function redirectToGameHub() {
                                            window.location.href = "/games";
                                        }
                                    </script>
                                </div>
                                <div class="menu_item" onclick="redirectToContribute()">
                                    <i class="fa-brands fa-github"></i> <span>Contribuer</span>
                                    <script>
                                        function redirectToContribute() {
                                            window.open("https://github.com/AnthonyDel28/INTRA", "_blank");
                                        }
                                    </script>
                                </div>
                                <div class="menu_item" onclick="redirectToRapport()">
                                    <i class="fa-solid fa-bug"></i> <span>Rapport / Bug</span>
                                    <script>
                                        function redirectToRapport() {
                                            window.location.href = "/rapport";
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="menu_section mt-5">
                                <p class="menu_title"><b>Compte</b></p>
                                <div class="menu_item" onclick="redirectToSuccess()">
                                    <i class="fa-solid fa-trophy-star"></i> <span>Succès</span>
                                    <script>
                                        function redirectToSuccess() {
                                            window.location.href = "/success";
                                        }
                                    </script>
                                </div>
                                <div class="menu_item" onclick="redirectToProfile()">
                                    <i class="fa-solid fa-square-user"></i> <span>Profil</span>
                                    <script>
                                        function redirectToProfile() {
                                            window.location.href = "/profile";
                                        }
                                    </script>
                                </div>
                                <div class="menu_item">
                                    <i class="fa-solid fa-gear"></i> <span>Paramètres</span>
                                </div>
                                @if(Auth::check() && Auth::user()->role_id == 1)
                                    <div class="menu_item" onclick="redirectToAdmin()" id="menu_item_admin">
                                        <i class="fa-solid fa-toolbox"></i> <span>Administration</span>
                                    </div>
                                    <script>
                                        function redirectToAdmin() {
                                            window.location.href = "/admin";
                                        }
                                    </script>
                                @endif
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
                        <div class="row justify-content-center text-center">
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
                                        <!--
                                        <span class="top_left_item">
                                <i class="fa-solid fa-square-phone"></i> Appeler
                            </span>
                            -->
                                    </div>
                                    <div class="col-md-6 text-end top_row_right_item">
                                        <div class="row justify-content-end">
                                            <div class="col-auto">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/images/users/profile/' . Auth::user()->avatar) }}" alt="" class="profile-picture" style="object-fit: cover;">
                                                    <div class="ms-2">
                                                        <div class="profile_name"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
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
                        <i id="closeButton" class="fa-solid fa-circle-xmark" v-on:click="closeNewPost()"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="h1 text-center text-light">Publier un nouveau post</div>
                    <form action="{{ route('publish') }}" method="POST">
                        @csrf
                        <div class="row justify-content-evenly">
                            <div class="col-10">
                                <div class="row justify-content-between">
                                    <div class="col-5 form">
                                        <div class="row">
                                            <div class="form-group new_post_form">
                                                <label for="title">Titre</label>
                                                <input type="text" name="title" id="title" class="form-control new_post_form">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group new_post_form">
                                                <label for="section_id">Section</label>
                                                <select name="section_id" id="section_id" class="form-control">
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row message_row">
                                            <div class="form-group new_post_form">
                                                <label for="message">Message</label>
                                                <textarea name="message" id="message" class="form-control h-100 new_post_message" onsubmit="formatTextareaValue('message')"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 form">
                                        <div class="row">
                                            <div class="form-group new_post_form">
                                                <label for="section_id">Langage de programmation</label>
                                                <select name="language" id="language" class="form-control">
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language }}" @if ($language === 'PHP') selected @endif>{{ $language }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row code_row">
                                            <div class="form-group new_post_form">
                                                <label for="code">Code</label>
                                                <textarea name="code" id="code" class="form-control h-100 new_post_code" onsubmit="formatTextareaValue('code')"></textarea>
                                            </div>
                                        </div>
                                        <script>
                                            function formatTextareaValue(textareaId) {
                                                var textarea = document.getElementById(textareaId);
                                                var textareaValue = textarea.value;


                                                textareaValue = textareaValue.replace(/\r\n|\r|\n/g, '&#13;&#10;'); // Retours à la ligne
                                                textareaValue = textareaValue.replace(/\t/g, '&#9;'); // Tabulations

                                                textarea.value = textareaValue;
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-3 text-center mt-5">
                                <button type="submit" class="new_post_btn">Confirmer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(session()->has('success_post'))
            <div class="success_div" id="success_div">
                <div class="success_message">
                    <div class="row justify-content-end">
                        <i class="fa-solid fa-circle-xmark text-right" v-on:click="closeSuccess()"></i>
                    </div>
                    <div class="row justify-content-center">
                        <img src="{{ asset('images/gifs/success.svg') }}" alt="" class="success_image">
                        <h4 class="success_title text-center mt-2">Contenu publié avec succès</h4>
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('success_delete'))
            <div class="success_div" id="success_div">
                <div class="success_message">
                    <div class="row justify-content-end">
                        <i class="fa-solid fa-circle-xmark text-right" v-on:click="closeSuccess()"></i>
                    </div>
                    <div class="row justify-content-center">
                        <img src="{{ asset('images/gifs/bin.svg') }}" alt="" class="success_image">
                        <h4 class="success_title text-center mt-2">Votre contenu a été supprimé</h4>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endauth

<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
<script>hljs.highlightAll();</script>
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
            },
            closeModal() {
                document.getElementById('modal-overlay').style.display = 'none';
            },
            closeSuccess(){
                document.getElementById('success_div').style.display = 'none';
            }
        }
    });
    app.mount("#app");
</script>

<script src="{{ asset('js/finisher-header.es5.min.js') }}" type="text/javascript"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('pre code').forEach((el) => {
            hljs.highlightElement(el);
        });
    });
    $('#closeButton').click(function() {
        $('#modal-overlay').hide();
    });
</script>
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
