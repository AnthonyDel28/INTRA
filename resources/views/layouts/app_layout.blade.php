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
    <title>INTRA</title>
</head>
<body>

<div id="app" style="width: 100%; height: 100%; position: fixed; top: 0; left: 0;" class="header finisher-header">
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
                            <h1 style="color: white;">
                                @if(Auth::check())
                                    Bienvenue {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}
                                @endif

                            </h1>
                </div>
            </div>
        </div>
    </div>
</div>


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
