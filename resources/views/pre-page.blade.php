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


                    <!-- LOGIN FORM -->
                    <div class="col-10 col-md-6 login_form" id="login_form" :style="{ display: showLoginForm ? 'block' : 'none' }">
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
                                    @if($errors->has('failed'))
                                        <p class="text-danger text-center">{{ $errors->first('failed') }}</p>
                                    @endif
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-8 mt-2">
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
                                            <button type="submit" class="signup_btn mt-3" v-on:click="fswitch()">
                                                {{ __('Créer un compte') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- SIGNUP FORM -->
                    <div class="col-10 col-md-6 signup_form" id="signup_form"> <!-- :style="{ display: showSignup ? 'block' : 'none' }" -->
                        <div class="col-8 col-md-8 login_right_area">
                            <div class="container-fluid">
                                <div class="row text-left mt-4">
                                    <i class="fa-solid fa-circle-xmark close_signup" v-on:click="closesignup()"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <h2 class="text-center login_title">Créer un compte</h2>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-8 mt-5">
                                        <form method="POST" action="{{ route('signup') }}" class="mt-4">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="first_name">Prénom</label>
                                                    <input id="first_name" type="text" class="login_field @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                                                    @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="last_name">Nom</label>
                                                    <input id="last_name" type="text" class="login_field @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                                                    @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="email">Adresse e-mail</label>
                                                    <input id="email" type="email" class="login_field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="password">Mot de passe</label>
                                                    <input id="password" type="password" class="login_field @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="password-confirm">Confirmer le mot de passe</label>
                                                    <input id="password-confirm" type="password" class="login_field" name="password_confirmation" required autocomplete="new-password">
                                                </div>

                                                <div class="form-group ">
                                                    <button type="submit" class="login_btn">S'inscrire</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-8 text-center login_form_bottom">
                                        <span>Vous avez déjà un compte?</span>
                                        <div class="form-group text-center">
                                            <button type="submit" class="signup_btn mt-3" v-on:click="fswitch()">
                                                {{ __('Se connecter') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-md-4 login_left_area text-center">
                            <img src="{{ asset('images/pre-page/developer2.svg') }}" alt="" class="developer_img">
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
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <div class="square how_it_works">
                                        <div class="text-right m-3">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                        <div class="text-left m-4">
                                            How it <br>works
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex justify-content-center align-items-center h-100" v-on:click="showsignup()">
                                    <div class="square create_an_account">
                                        <div class="text-right m-3">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                        <div class="text-left m-4">
                                            Create an <br>account
                                        </div>
                                    </div>
                                </div>
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
                showLoginForm: {{ $errors->has('failed') ? 'true' : 'false' }},
                status: ""
            };
        },
        methods: {
            showlogin() {
                if(document.getElementById('signup_form').style.display === 'block'){
                    document.getElementById('signup_form').style.display = 'none';
                }
                const loginForm = document.getElementById('login_form');
                const computedDisplay = window.getComputedStyle(loginForm).display;
                if (computedDisplay === 'none') {
                    loginForm.style.display = 'block';
                } else {
                    loginForm.style.display = 'none';
                }
                this.status = 'open';
                if(loginForm.style.display == 'block'){
                    this.status = 'close';
                    document.getElementById('error').style.display = 'none';
                }

            },
            closelogin(){
                document.getElementById('login_form').style.display = 'none';
                this.status = 'close';
                document.getElementById('error').style.display = 'none';
            },
            showsignup(){

                if(document.getElementById('login_form').style.display === 'block'){
                    document.getElementById('login_form').style.display = 'none';
                }
              const signupForm = document.getElementById('signup_form');
              const computedDisplay = window.getComputedStyle(signupForm).display;
              if(computedDisplay === 'none'){
                  signupForm.style.display = 'block';
              } else {
                  signupForm.style.display = 'none';
              }
            },
            closesignup(){
                document.getElementById('signup_form').style.display = 'none';
            },
            fswitch(){
                if(document.getElementById('signup_form').style.display === 'block'){
                    document.getElementById('signup_form').style.display = 'none';
                    document.getElementById('login_form').style.display = 'block';
                } else if (document.getElementById('login_form').style.display === 'block'){
                    document.getElementById('login_form').style.display = 'none';
                    document.getElementById('signup_form').style.display = 'block';
                }
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

