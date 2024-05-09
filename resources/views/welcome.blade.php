<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.9.13, a.mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/photo-1568792923760-d70635a89fdc.jpeg" type="image/x-icon">
    <meta name="description" content="La plateforme de notation des universités du Togo fournit des classements transparents et pertinents sur les établissements d’enseignement supérieur du pays.">
    <title>{{ $title ?? 'Togo University Rankings' }}</title>
    <link rel="stylesheet" href="https://r.mobirisesite.com/407274/assets/web/assets/mobirise-icons2/mobirise2.css?rnd=1714045324452">
    <link rel="stylesheet" href="https://r.mobirisesite.com/407274/assets/bootstrap/css/bootstrap.min.css?rnd=1714045324458">
    <link rel="stylesheet" href="https://r.mobirisesite.com/407274/assets/bootstrap/css/bootstrap-grid.min.css?rnd=1714045324458">
    <link rel="stylesheet" href="https://r.mobirisesite.com/407274/assets/bootstrap/css/bootstrap-reboot.min.css?rnd=1714045324458">
    <link rel="stylesheet" href="https://r.mobirisesite.com/407274/assets/dropdown/css/style.css?rnd=1714045324458">
    <link rel="stylesheet" href="https://r.mobirisesite.com/407274/assets/theme/css/style.css?rnd=1714045324458">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Brygada+1918:wght@400;700&display=swap&display=swap"></noscript>
    <link rel="stylesheet" href="https://r.mobirisesite.com/407274/assets/css/mbr-additional.css?rnd=1714045324458" type="text/css">
</head>
<body>
    <section data-bs-version="5.1" class="menu menu2 cid-uaXiScYebR" once="menu" id="menu-5-uaXiScYebR">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="#">
                            <img src="{{ asset('assets/images/photo-1568792923760-d70635a89fdc.jpeg') }}" alt="Mobirise Website Builder" style="height: 4.3rem;">
                        </a>
                    </span>
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4" href="{{ route('welcome') }}"><strong class="text-danger">U</strong>niscor</a></span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="{{ route('universities.list') }}" aria-expanded="false">Universities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="{{ route('universities.rankings') }}" aria-expanded="false">Rankings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-black display-4" href="{{ route('welcome') }}">About</a>
                        </li>
                    </ul>
                    <div class="navbar-buttons mbr-section-btn">
                        @if (Auth::check())
                            @if (Auth::user()->image != '')
                            <a href="{{ route('auth.profileView') }}">
                                <img src="{{ asset('storage/uploads/profile/thumb/'.Auth::user()->image) }}" class="img-fluid rounded-circle" alt="avatar" style="width: 40px; height: 40px;">
                            </a>
                            @else
                            <a href="{{ route('auth.profileView') }}">
                                <img src="{{ asset('images/artist.png') }}" alt="Avatar" class="rounded-circle img-fluid" style="width: 40px; height: 40px;">
                            </a>
                            @endif
                        @else
                        <a class="btn btn-primary display-4" href="{{ route('auth.loginForm') }}">Log In</a>
                        <a class="btn btn-danger display-4" href="{{ route('auth.registerForm') }}">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <section data-bs-version="5.1" class="header18 cid-uaXiScZyoE mbr-fullscreen" data-bg-video="https://www.youtube.com/embed/f-MJh3ykLWY?autoplay=1&amp;loop=1&amp;playlist=f-MJh3ykLWY&amp;t=20&amp;mute=1&amp;playsinline=1&amp;controls=0&amp;showinfo=0&amp;autohide=1&amp;allowfullscreen=true&amp;mode=transparent" id="hero-15-uaXiScZyoE">
        <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="content-wrap col-12 col-md-12">
                    <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-4 display-1">
                        <strong>Uniscor</strong>
                    </h1>
                    <p class="mbr-fonts-style mbr-text mbr-white mb-4 display-7">Discover the best universities in Togo and their rankings according to unique criteria.</p>
                    <div class="mbr-section-btn">
                        <a class="btn btn-white-outline display-7" href="{{ route('universities.list') }}">Discover</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="header09 startm5 cid-uaXiSd1WP9" id="call-to-action-2-uaXiSd1WP9">
        <div class="container-fluid">
            <div class="row">
                <div class="content-wrap col-12 col-md-6">
                    <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-4 display-2">
                        <strong>Ready to Discover the Best Universities?</strong>
                    </h1>
                    <p class="mbr-fonts-style mbr-text mbr-white mb-4 display-7">Explore the rankings and choose the university that suits you best.</p>
                    <div class="mbr-section-btn">
                        <a class="btn btn-primary display-7" href="{{ route('universities.rankings') }}">To start</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="article2 cid-uaXiSd0vRt" id="about-me-2-uaXiSd0vRt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-6 image-wrapper">
                    <img class="w-100" src="{{ asset('assets/images/photo-1519452575417-564c1401ecc0.jpeg') }}" alt="Mobirise Website Builder">
                </div>
                <div class="col-12 col-md-12 col-lg">
                    <div class="text-wrapper align-left">
                        <h1 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                            <strong>About Us</strong>
                        </h1>
                        <p class="mbr-text align-left mbr-fonts-style mb-3 display-7">Welcome to <strong class="text-danger">U</strong>niscor, the revolutionary university rating platform in Togo!</p>

                        <p class="mbr-text align-left mbr-fonts-style mb-3 display-7">We are here to provide you with transparent and relevant information about higher education institutions in the country.</p>

                        <p class="mbr-text align-left mbr-fonts-style mb-3 display-7">Explore rankings based on the quality of teaching, infrastructure, research, professional integration, and much more.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-bs-version="5.1" class="features023 cid-uaXiSd2DsP" id="metrics-1-uaXiSd2DsP">
        <div class="container">
            <div class="row content-row justify-content-center">
                <div class="item features-without-image col-12 col-md-6 col-lg-4 item-mb">
                    <div class="item-wrapper">
                        <div class="title mb-2 mb-md-3">
                            <span class="num mbr-fonts-style display-1">
                                <strong>1</strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Exceptional Quality</strong>
                        </h4>
                    </div>
                </div>
                <div class="item features-without-image col-12 col-md-6 col-lg-4 item-mb">
                    <div class="item-wrapper">
                        <div class="title mb-2 mb-md-3">
                            <span class="num mbr-fonts-style display-1">
                                <strong>2</strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Modern Infrastructure</strong>
                        </h4>
                    </div>
                </div>
                <div class="item features-without-image col-12 col-md-6 col-lg-4 item-mb">
                    <div class="item-wrapper">
                        <div class="title mb-2 mb-md-3">
                            <span class="num mbr-fonts-style display-1">
                                <strong>3</strong></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style display-5">
                            <strong>Innovative Research</strong>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="article05 cid-uaXiSd3cL5" id="generic-text-5-uaXiSd3cL5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12">
                    <div class="card-wrapper">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-5 image-wrapper">
                                <img class="w-100" src="{{ asset('assets/images/photo-1561089489-f13d5e730d72.jpeg') }}" alt="Mobirise Website Builder">
                            </div>
                            <div class="col-12 col-lg col-md-12">
                                <div class="text-wrapper align-left">
                                    <h1 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                                        <strong>University Rating Platform</strong>
                                    </h1>
                                    <p class="mbr-text mbr-fonts-style mb-3 display-7">Immerse yourself in the fascinating world of higher education in Togo through our university rating platform. Discover the most prestigious and innovative establishments in the country.</p>
                                    <p class="mbr-text mbr-fonts-style mb-3 display-7">Consult the rankings based on various criteria such as the quality of teaching, modern infrastructure, cutting-edge research and professional integration.</p>
                                    <p class="mbr-text mbr-fonts-style display-7">Our goal is to provide Internet users with transparent and relevant information to help them choose the best university for their academic and professional career.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="footer4 cid-uaXiSd3qf8" once="footers" id="footer-4-uaXiSd3qf8">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">© 2024 Universities Togo. All rights reserved.</p>
                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/ytplayer/index.js') }}"></script>
    <script src="{{ asset('assets/dropdown/js/navbar-dropdown.js') }}"></script>
    <script src="{{ asset('assets/vimeoplayer/player.js') }}"></script>
    <script src="{{ asset('assets/theme/js/script.js') }}"></script>
</body>
</html>
