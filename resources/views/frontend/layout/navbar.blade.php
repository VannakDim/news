<!-- ======= Header ======= -->
@php
    $contact = DB::table('contacts')->find(1);
@endphp

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto kh-koulen"><a href="/"><span>កូនខ្មែរ</span>តិចណូ</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">

            <ul>

                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                <li class="{{ request()->is('blog*') ? 'active' : '' }}"><a href="{{ route('home.blog') }}">Blog</a>
                </li>

                <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ route('home.about') }}">About</a>
                    
                </li>

                <li class="{{ request()->is('contact') ? 'active' : '' }}">
                    <a href="{{ route('home.contact') }}">Contact</a>
                </li>
                @if ($contact->facebook)
                    <li><a href="{{ $contact->facebook }}" target="_blank" rel="noopener noreferrer" class="facebook"><i class="fa-brands fa-facebook social-link"></i></a></li>    
                @endif
                @if ($contact->instagram)
                    <li><a href="{{ $contact->instagram }}" target="_blank" rel="noopener noreferrer" class="instagram"><i class="fa-brands fa-square-instagram social-link"></i></a></li>
                @endif
                @if ($contact->telegram)
                    <li><a href="{{ $contact->telegram }}" target="_blank" rel="noopener noreferrer" class="telegram"><i class="fa-brands fa-telegram social-link"></i></a></li>    
                @endif
                



            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->
