@extends('layouts.pre-layout')
<link rel="icon" href="{{ asset('intra.ico') }}">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

        <div id="app" class="header finisher-header" style="width: 100%; height: 100%; position: fixed; top: 0; left: 0;">
            <div class="container-fluid">
                <div class="row pre_page_first_row m-5">
                    <div class="col-6 text-start">
                        <span class="intra_logo">intra</span>
                    </div>
                    <div class="col-6 text-end mt-4">
                        <span class="pre_page_login" v-on:click="showlogin">
                            <i class="fa-solid fa-circle"></i>
                            login
                        </span>
                    </div>
                </div>

                <div class="row pre_page_main_row justify-content-center align-items-center">
                    <div class="col-6 text-center centered-div">
                        <span class="pre_page_title">intra</span>
                        <span></span>
                    </div>
                    <div class="col-10 col-md-6 login_form" id="login_form" :style="{ display: showError ? 'block' : 'none' }">
                        <div class="col-4 col-md-4 login_left_area text-center">
                            <img src="{{ asset('images/pre-page/developer.svg') }}" alt="" class="developer_img">
                        </div>
                        <div class="col-8 col-md-8 login_right_area">
                            <div class="container-fluid">
                                <div class="row text-right mt-4">
                                    <i class="fa-solid fa-circle-xmark close_login" v-on:click="closelogin()"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <h2 class="text-center login_title">Log in to your account</h2>
                                </div>
                                @if(session('error'))
                                    <div class="row justify-content-center text-center" id="error">
                                        <div class="login_alert text-center">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            {{ session('error') }}
                                        </div>
                                    </div>
                                @endif

                                <div class="row justify-content-center">
                                    <div class="col-8 mt-5">
                                        <form method="POST" action="{{ route('login') }}" class="mt-4">
                                            @csrf

                                            <div class="form-group">
                                                <label for="email">{{ __('Adresse e-mail') }}</label>
                                                <br>
                                                <input id="email" type="email" class="login_field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password">{{ __('Mot de passe') }}</label>
                                                <input id="password" type="password" class="login_field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Rester connecté') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" class="login_btn">
                                                    {{ __('Se connecter') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-8 text-center login_form_bottom">
                                        <h3>Pas encore inscrit?</h3>
                                        <span>Commencez l'expérience intra dès maintenant</span>
                                        <div class="form-group text-center">
                                            <button type="submit" class="signup_btn mt-3">
                                                {{ __('Créer un compte') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row pre_page_bottom justify-content-center mt-auto">
                    <div class="col-3 text-right">
                        <p class="pre_page_text mt-3">
                            Intra est un intranet spécialement conçu pour les étudiants développeurs. Il offre une plateforme interactive qui facilite la communication, l'échange d'informations et les discussions au sein de la communauté étudiante. Avec Intra, les étudiants peuvent se connecter, partager des connaissances, collaborer sur des projets et s'entraider mutuellement.
                        </p>
                    </div>
                    <div class="col-1 text-center">
                        <div class="vertical-bar"></div>
                    </div>
                    <div class="col-3 text-left">
                        <div class="row">
                            <div class="col-3">
                                <a href="" class="d-flex justify-content-center align-items-center h-100">
                                    <div class="square">
                                        <div class="text-right m-3">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                        <div class="text-left m-4">
                                            How it <br>works
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="" class="d-flex justify-content-center align-items-center h-100">
                                    <div class="square">
                                        <div class="text-right m-3">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                        <div class="text-left m-4">
                                            Create an <br>account
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script>

    const app = Vue.createApp({
        data() {
            return {
                showError: {{ session('error') ? 'true' : 'false' }},
                status: "",
            };
        },
        methods: {
            showlogin() {
                const loginForm = document.getElementById('login_form');
                const computedDisplay = window.getComputedStyle(loginForm).display;
                if (computedDisplay === 'none') {
                    loginForm.style.display = 'block';
                } else {
                    loginForm.style.display = 'none';
                }
                this.status = 'open';
            },
            closelogin(){
                document.getElementById('login_form').style.display = 'none';
                this.status = 'close';
                document.getElementById('error').style.display = 'none';
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
