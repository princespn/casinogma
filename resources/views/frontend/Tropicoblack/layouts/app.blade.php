<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>@yield('page-title') - {{ settings('app_name') }}</title>

    <meta name="viewport" content="width=device-width">

    <link rel="icon" href="/frontend/Tropicoblack/img/favicon.png">

    <link rel="stylesheet" href="/frontend/Tropicoblack/css/slick.css">
    <link rel="stylesheet" href="/frontend/Tropicoblack/css/styles.min.css">

    <script src="/frontend/Tropicoblack/js/jquery-3.4.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/google/css/roboto.css" />
    <link rel="stylesheet" type="text/css"
        href="/frontend/Tropicoblack/assets/vendors/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/frontend/Tropicoblack/assets/vendors/swiper/4.5.0/css/swiper.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/frontend/Tropicoblack/assets/vendors/odometer/0.4.6/css/odometer-theme-default.css" />
    <link rel="stylesheet" type="text/css"
        href="/frontend/Tropicoblack/assets/vendors/bootstrap-select/1.13.9/css/bootstrap-select.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/frontend/Tropicoblack/assets/vendors/flag-icon-css/3.3.0/css/flag-icon.min.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/vendors/flaticon/flaticon.css" />
    <link rel="stylesheet" type="text/css"
        href="/frontend/Tropicoblack/assets/vendors/fontawesome/5.10.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/css/alertify.min.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/css/pisoglentis.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/assets/css/main-black.css" />
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" /> --}}
    <link rel="stylesheet"
        href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css">

    {{-- My Style --}}
    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/css/main.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/css/dashboard.css" />
    <link rel="stylesheet" type="text/css" href="/frontend/Tropicoblack/css/auth.css" />

</head>

<body data-type="public" style="overflow:hidden">
    @yield('content')
    <!-- <div class="fullpage" style="height: 100220vh; background-color: black; position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    z-index: 2222;
    overflow:hidden;"></div> -->
    <!-- public, private -->

    <!-- CONTENT -->
    <div id="content" class="" style="display:none">
        <!-- MAIN MENU -->
        <div class="sticky-top main-bg">
            <div id="main-menu">
                <div class="main-menu-left"></div>
                <div class="main-menu-logo"></div>
                <div class="main-menu-right"></div>
                <div class="main-menu-exit"></div>
                <div class="main-menu-sound"></div>
                <div class="main-menu-jackpot-grand center">
                    <div class="main-menu-grand">
                        <span class="jackpot-text-grand">GRAND</span>
                    </div>
                    <span style="width:30%"></span>
                    <span class="jackpot-text-value">556195.18</span>
                </div>
                <div class="main-menu-jackpot-major center">
                    <div class="main-menu-major">
                        <span class="jackpot-text-major">MAJOR</span>
                    </div>
                    <span style="width:30%"></span>
                    <span class="jackpot-text-value">333962.18</span>
                </div>
                <div class="main-menu-jackpot-minor center">
                    <div class="main-menu-minor">
                        <span class="jackpot-text-minor">MINOR</span>
                    </div>
                    <span style="width:30%"></span>
                    <span class="jackpot-text-value">345084.18</span>
                </div>
                <div class="main-menu-jackpot-mini center">
                    <div class="main-menu-mini">
                        <span class="jackpot-text-mini">MINI</span>
                    </div>
                    <span style="width:30%"></span>
                    <span class="jackpot-text-value">445048.18</span>
                </div>
            </div>

            <div class="main-container">
                <ul style="display:none">
                    <li class="nav-item" data-category="all">
                        <a class="nav-link text-center" href="javascript: void(0);">
                            All
                        </a>
                    </li>
                    <li class="nav-item" data-category="slot">
                        <a class="nav-link text-center" href="javascript: void(0);">
                            Slot
                        </a>
                    </li>
                    <li class="nav-item" data-category="hot">
                        <a class="nav-link text-center" href="javascript: void(0);">
                            Hot
                        </a>
                    </li>
                    <li class="nav-item" data-category="new">
                        <a class="nav-link text-center" href="javascript: void(0);">
                            New
                        </a>
                    </li>
                </ul>
                <div id="mainContent" class="owl-carousel owl-theme"></div>
            </div>

            {{-- Footer Menu --}}
            <div class="footer-menu">
                <div class="footer-menu-user">
                    <div class="username">{{ Auth::user()->username }}</div>
                    <div class="balance">
                        {{ Auth::user()->balance }}
                    </div>
                </div>
                <div class="footer-menu-game-kind">
                    <img class="all_btn" src="/frontend/Tropicoblack/img/dashboard/kind/g1btn1.png" />
                    <img class="fish_btn" src="/frontend/Tropicoblack/img/dashboard/kind/g2btn1.png" />
                    <img class="slot_btn" src="/frontend/Tropicoblack/img/dashboard/kind/g3btn1.png" />
                    <img class="fire_btn" src="/frontend/Tropicoblack/img/dashboard/kind/g4btn1.png" />
                    <img class="left_arrow" src="/frontend/Tropicoblack/img/dashboard/kind/arrow.png" />
                    @for ($i = 0; $i <= 9; $i++)
                        @if ($i == 0)
                            <img class="dot" src="/frontend/Tropicoblack/img/dashboard/kind/dot1.png"
                                style="transform:translate({{ 1720 + $i * 100 }}%,330%)" />
                        @else
                            <img class="dot" src="/frontend/Tropicoblack/img/dashboard/kind/dot2.png"
                                style="transform:translate({{ 1720 + $i * 100 }}%,330%)" />
                        @endif
                    @endfor
                    {{-- <img class="dot" src="/frontend/Tropicoblack/img/dashboard/kind/dot1.png" /> --}}
                    {{-- <img class="dot" src="/frontend/Tropicoblack/img/dashboard/kind/dot2.png" /> --}}
                    <img class="right_arrow" src="/frontend/Tropicoblack/img/dashboard/kind/arrow.png" />
                </div>
                <div class="footer-menu-blank"></div>
            </div>
        </div>

        {{-- User Information --}}
        <script>
            var GLOBAL_GAMES_LIST = [
                @foreach ($games as $key => $game)
                    {
                        "game_id": {{ $game->id }},
                        "launchUrl": "/game/{{ $game['name'] }}?api_exit=/",
                        "providerId": "bomba",
                        "categoryName": "{{ \VanguardLTE\GameCategory::where('game_id', $game->original_id)->first()->category_id }}",
                        "gameName": "{{ $game['title'] }}",
                        "imageUrl": "{{ $game->name ? '/frontend/Tropicoblack/ico/' . $game->name . '.jpg' : '' }}",
                        "data-src": "{{ $game->name ? '/frontend/Tropicoblack/ico/' . $game->name . '.jpg' : '' }}",
                        "mobileGame": false
                    },
                @endforeach

            ];

            var GLOBAL_BANNERS_LIST = {
                slide1: "/frontend/Tropicoblack/assets/images/slides/1.jpg",
                slide2: "/frontend/Tropicoblack/assets/images/slides/2.jpg",
                slide3: "/frontend/Tropicoblack/assets/images/slides/3b.jpg",
                slide4: "/frontend/Tropicoblack/assets/images/slides/4.jpg",
                slide5: "/frontend/Tropicoblack/assets/images/slides/5.jpg",
                slide6: "/frontend/Tropicoblack/assets/images/slides/6.jpg",
                slide7: "/frontend/Tropicoblack/assets/images/slides/7.jpg",
                slide8: "/frontend/Tropicoblack/assets/images/slides/8.jpg",
                slide9: "/frontend/Tropicoblack/assets/images/slides/9.jpg",
                slide10: "/frontend/Tropicoblack/assets/images/slides/10.jpg",
                slide11: "/frontend/Tropicoblack/assets/images/slides/11.jpg"
            };
        </script>
        <!-- END MAIN MENU -->
    </div>

    {{-- Video Loading --}}
    <video autoplay loop muted class="dashboard-bgvideo bgvideo" id="bgvideo">
        <source src="/frontend/Tropicoblack/img/auth/back.mp4" type="video/mp4">
    </video>
    <div class="preloader-game">
        <img class="preloader-game-logo" src="/frontend/Tropicoblack/img/auth/logo.png" />
        <div class="preloader-game-bar-cont">
            <img class="preloader-game-bar" src="/frontend/Tropicoblack/img/preloader/ic_dragon.png" />
            <img class="preloader-game-bar-back" src="/frontend/Tropicoblack/img/preloader/bg.png" />
        </div>
        <span class="preloader-game-text">
            LOADING...
        </span>
    </div>

    {{-- Till Here --}}
    <div id="modal-content" style="display:none;">
        <div class="userinfo_modal" style="display:none">
            <img class="userinfo_modal_close" src="/frontend/Tropicoblack/img/dashboard/user/close.png" />
            <img class="userinfo_modal_done" src="/frontend/Tropicoblack/img/dashboard/user/bdone.png" />
            <img class="userinfo_modal_change_password" src="/frontend/Tropicoblack/img/dashboard/user/bchange.png" />
            <span class="userinfo_modal_username">{{ Auth::user()->username }}</span>
            <span class="userinfo_modal_password">**********</span>
        </div>
        <div class="change_password_modal" style="display:none">
            <img class="change_password_modal_close" src="/frontend/Tropicoblack/img/dashboard/user/close.png" />
            <input class="change_password_modal_password" type="password" placeholder="Enter new password" />
            <input class="change_password_modal_password_confirm" type="password"
                placeholder="Retype new password" />
            <img class="change_password_modal_change_btn"
                src="/frontend/Tropicoblack/img/dashboard/user/changepass.png" />
            <div class="change_password_modal_password_error">
                <span class="change_password_modal_password_error_text">Input password must be 5-10 chars</span>
                <img class="change_password_modal_password_error_img" src="" />
            </div>
        </div>
    </div>

    <!-- END CONTENT -->

    <!-- HELPERS -->
    <!-- BACK TO TOP -->
    <a id="back-to-top" href="javascript: void(0);" class="btn primary-btn btn-lg back-to-top" role="button"
        title="Back to Top" data-toggle="tooltip" data-placement="left">
        <span class="fas fa-angle-up"></span>
    </a>
    <!-- END BACK TO TOP -->
    <!-- OVERLAY -->
    <div class="overlay"></div>
    <!-- END OVERLAY -->
    <!-- GAME WINDOW MODAL -->
    <div class="modal fade" id="game-window-modal" tabindex="-1" role="dialog"
        aria-labelledby="game-window-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" id="game-window-modal-dialog">
            <div class="modal-content" id="game-modal-content">
                <div class="modal-header">
                    <a style="z-index: 20;" href="javascript: void(0);" id="game-window-modal-fullscreen"
                        class="modal-button" aria-label="Open in Fullscreen" rel="fullscreen">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <h5 class="modal-title" id="game-window-modal-title"></h5>

                    <!-- JACKPOT -->
                    <div class="row w-100" id="jackpots2">
                        <div class="col-lg-3 pb-1 my-auto">
                        </div>
                        <div class="col-4 col-lg-2 pb-1 my-auto">
                            <div class="jackpot-container align-middle w-100 m-auto text-right">
                                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-1.png"
                                    alt="jackpot-icon" class="jackpot-icon float-left" />
                                <div class="odometer pisoglentis jackpot-elem1"></div>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 pb-1 my-auto">
                            <div class="jackpot-container align-middle w-100 m-auto text-right">
                                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-2.png"
                                    alt="jackpot-icon" class="jackpot-icon float-left" />
                                <div class="odometer pisoglentis jackpot-elem2"></div>
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 pb-1 my-auto">
                            <div class="jackpot-container align-middle w-100 m-auto text-right">
                                <img src="/frontend/Tropicoblack/assets/images/ui/jackpot-icon-3.png"
                                    alt="jackpot-icon" class="jackpot-icon float-left" />
                                <div class="odometer pisoglentis jackpot-elem3"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 pb-1 my-auto">
                        </div>
                    </div>
                    <!-- JACKPOT -->
                    <button style="z-index: 20;" type="button" class="close modal-button" data-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>

                </div>

                <!-- BONUS MODAL -->
                <div id="bonusdiv" style="display: none;">
                    <div id="bonusinner" style="">
                        <div id="bonusamount"></div>
                    </div>
                </div>
                <!-- END BONUS MODAL -->

                <!-- JACKPOT MODAL -->
                <div id="jpdiv" style="display:none;">
                    <div id="jpinner">
                        <div id="jpwin" class="center2">

                        </div>
                    </div>
                </div>
                <!-- /JACKPOT MODAL -->

                <div class="modal-body">
                    <div style="height: 65vh;" id="game-window-modal-frame">
                        <iframe class="modal-iframe" id="game-window-modal-iframe" src=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END GAME WINDOW MODAL -->
    <!-- REGISTER MODAL -->
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog"
        aria-labelledby="register-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" id="register-modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register-modal-title">
                        Register
                    </h5>
                    <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form id="register-form" action="#" method="post">
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-address-card"></i></span>
                            <input id="register-form-first-name" type="text" name="register-form-first-name"
                                placeholder="First Name" />
                        </div>
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-address-card"></i></span>
                            <input id="register-form-last-name" type="text" name="register-form-last-name"
                                placeholder="Last Name" />
                        </div>
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-at"></i></span>
                            <input id="register-form-email" type="text" name="register-form-email"
                                placeholder="Email" />
                        </div>
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-user"></i></span>
                            <input id="register-form-username" type="text" name="register-form-username"
                                placeholder="Username" />
                        </div>
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-key"></i></span>
                            <input id="register-form-password1" type="password" name="register-form-password1"
                                placeholder="Password" />
                        </div>
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-key"></i></span>
                            <input id="register-form-password2" type="password" name="register-form-password2"
                                placeholder="Retype Password" />
                        </div>
                        <button type="submit" form="register-form" value="Submit"
                            class="btn primary-btn w-100 mt-4">
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END REGISTER MODAL -->
    <!-- LOGIN MODAL -->
    </div>
    <!-- END LOGIN MODAL -->

    <!-- TICKET MODAL -->
    <div class="modal fade" id="ticket-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" id="ticket-modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login-modal-title">
                        Ticket
                    </h5>
                    <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="w-100 text-center mb-4">
                        <img src="/frontend/Tropicoblack/img/ticket_logo.png" alt="logo" />
                    </div>
                    <form id="ticket-form" action="#" method="post">
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-user"></i></span>
                            <input id="ticket-form-username" type="text" value="1234" disabled
                                name="ticket-form-username" placeholder="Username" />
                        </div>
                        <div class="custom-input-group mb-2">
                            <span class="custom-input-group-icon"><i class="fas fa-money-bill-alt"></i></span>
                            <input id="ticket-form-balance" disabled value="" type="text"
                                name="ticket-form-balance" placeholder="Balance" />
                        </div>
                        <button type="button" form="ticket-form" id="ticket-print-button" value="Submit"
                            class="btn primary-btn w-100 mt-4">
                            Print
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END TICKET MODAL -->


    <!-- HELP MODAL -->
    <style>
        .modal-fullscreen .modal-dialog {
            max-width: 100%;
            height: 100vh;
        }

        .modal-full .modal-content {
            width: 100vw;
            height: 100%;
        }
    </style>
    <div class="modal fade modal-fullscreen " id="help-modal" tabindex="-1" role="dialog"
        aria-labelledby="ticket-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-full" role="document" id="ticket-modal-dialog">
            <div class="modal-content modal-content-full">
                <div class="modal-header">
                    <h5 class="modal-title" id="login-modal-title">
                        Help
                    </h5>
                    <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <h4></h4>
                    Online casino is one of the most reliable and proven online casinos. You can enjoy a number of
                    popular games in known from land-based casinos all over the world. Players can choose between
                    classic fruit slot games, theme slots, Roulette, Black Jack, Keno and other games including
                    exclusive brand new games.

                    <div class="d-none pt-3" id="bonus1">
                        <h4> Cash back bonus</h4>

                        <span id="perBonus" class="text-danger font-weight-bold"></span>
                        Whenever you deposit an amount, you will get
                        <span id="perBonus2" class="text-danger font-weight-bold"></span>
                        amount added to your bonus box. These credits are added automatically to your balance when your
                        balance drops below 1.00 If you cash out before cash back bonus is activated, the bonus is lost.
                        You can cash out or top up at any time.


                        <span id="bonus2" class="d-none pt-3">
                            <h4 class="pt-3"> Happy hour bonus</h4>
                            Deposit From<br>
                            <span id="dates" class="font-weight-bold text-danger">

                            </span>
                            and get
                            <span id="hp_bonus" class="font-weight-bold text-danger">

                            </span>
                            bonus.Happy hour bonus is an increased cash back bonus at specific time of the day so on
                            every deposit you get

                            <span id="hp_bonus2" class="font-weight-bold text-danger">

                            </span>
                            added to your bonus box.

                            <hr>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END HELP MODAL -->

    <!-- BONUS  MODAL -->

    <div class="modal fade " id="bonus-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document" id="ticket-modal-dialog">
            <div class="modal-content modal-content-full">
                <div class="modal-header bbbonus1">
                    <h5 class="modal-title text-center" id="login-modal-title">
                        Lvl
                    </h5>
                    <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-3 bbbonus1">
                    <h1 class="text-center text-warning text-capitalize font-weight-bold"> Your level is
                        <spam class="lvlspam"></spam>
                    </h1>

                    <div class="text-center">

                        Levels unlock bonus features!
                        <br>
                        Progress is updated every few minutes
                        <br>
                        <div class="pt-5">
                            <h3>* Current level features *</h3>
                        </div>

                        <div class="pt-5 msgbonus">

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END BONUS MODAL -->


    <!-- END BONUS2 MODAL -->

    <!-- BONUS2 THANK YOU  MODAL -->

    <div class="modal fade " id="bonus3-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document" id="ticket-modal-dialog">
            <div class="modal-content modal-content-full">
                <div class="modal-header bbbonus1">
                    <h5 class="modal-title text-center" id="login-modal-title">
                        Congratulations!
                    </h5>
                    <button type="button" class="close modal-button" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="text-center">
                        <h1 class="modal-title text-center text-warning" id="login-modal-title">
                            Bonus collect!
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BONUS2 THANK YOU  MODAL -->

    <!-- END HELPERS -->

    <script>
        var BIGGER_WIN = "Bigger Win"
        var NUMBER_OF_WINS = "Number Of Wins"
        var LAST_WINNER = "Last Winner"
        var HELP_17 = "Bonus collected!"
        var SUCCESS = "Success!";

        var jackpotSettings = {
            "jackpot-elem1": {
                currentValue: {{ $jpgs[0]->balance }},
                isRed: false,
                details: {
                    bigger_win: {
                        amount: 100,
                        date: "11-11-2019"
                    },
                    number_of_wins: 1,
                    last_winner: {
                        amount: 100,
                        date: "11-11-2019",
                        username: "test"
                    }
                }
            },
            "jackpot-elem2": {
                currentValue: {{ $jpgs[1]->balance }},
                isRed: true,
                details: {
                    bigger_win: {
                        amount: 100,
                        date: "11-11-2019"
                    },
                    number_of_wins: 1,
                    last_winner: {
                        amount: 100,
                        date: "11-11-2019",
                        username: "test"
                    }
                }
            },
            @php

            @endphp "jackpot-elem3": {
                currentValue: {{ $jpgs[2]->balance }},
                isRed: false,
                details: {
                    bigger_win: {
                        amount: 100,
                        date: "11-11-2019"
                    },
                    number_of_wins: 1,
                    last_winner: {
                        amount: 100,
                        date: "11-11-2019",
                        username: "test"
                    }
                }
            }
        };
    </script>
    <script src="/frontend/Tropicoblack/assets/vendors/jquery/3.4.1/jquery-3.4.1.min.js"></script>
    <script src="/frontend/Tropicoblack/js/jquery-ui.js"></script>
    <script src="/frontend/Tropicoblack/assets/vendors/popper/1.14.7/popper.min.js"></script>
    <script src="/frontend/Tropicoblack/assets/vendors/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="/frontend/Tropicoblack/assets/vendors/swiper/4.5.0/js/swiper.min.js"></script>
    <script src="/frontend/Tropicoblack/assets/vendors/odometer/0.4.6/js/odometer.min.js"></script>
    <script src="/frontend/Tropicoblack/assets/vendors/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>
    <script src="/frontend/Tropicoblack/js/alertify.min.js?v=8324"></script>
    <script src="/frontend/Tropicoblack/js/bonus.min.js?v=8324"></script>
    <script src="/frontend/Tropicoblack/assets/js/games.js"></script>
    <script src="/frontend/Tropicoblack/assets/js/tools.js"></script>
    <script src="/frontend/Tropicoblack/assets/js/main.js"></script>
    <script src="/frontend/Tropicoblack/assets/js/ui.js"></script>
    /*
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>*/
    <script src="/frontend/Tropicoblack/js/owl.carousel.min.js"></script>

    // ** My Own JS
    <script src="/frontend/Tropicoblack/js/dashboard.js"></script>

    // ** My Own JS End
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-category="all"]').click();
        });
    </script>

</body>

</html>
