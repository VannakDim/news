@extends('frontend.layout.web')

@section('meta')
    <title>{{ $meta->title ?? 'KON KHMER CODE' }}</title>
    <meta name="description" content="{{ $meta->description ?? 'កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ' }}">
    <meta property="og:title" content="{{ $meta->title ?? 'កូនខ្មែរកូដ' }}">
    <meta property="og:description" content="{{ $meta->description ?? 'កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ' }}">
    <meta property="og:image" content="{{ asset($meta->image ?? 'frontend/assets/img/default.jpg') }}">
@endsection

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><strong>ABOUT</strong></h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>About</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">

            <div class="row content">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="kh-koulen text-center">{{ $about->title }}</h2>
                        </div>
                    </div>
                    <div class="row" style="padding: 0 75px">
                        <img id="row-img" src="{{ asset($about->image) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="kh-koulen">{!! $about->short_description !!}</h3>
                            <p class="kh-battambang justify">
                                {!! $about->long_description !!}
                            </p>

                            <ul>
                                @foreach ($about->items as $item)
                                    <li class="kh-battambang">
                                        <i class="ri-check-double-line"></i>{!! $item->about_item !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="row content">
                <div class="col-lg-12">
                    <p class="kh-battambang">
                        {!! html_entity_decode($about->more_description) !!}
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Our <strong>Team</strong></h2>
                <p>ខាងក្រោមនេះជាក្រុមការងារយើងខ្ញុំដែលមានបទពិសោធន៍ជាច្រើនឆ្នាំ និងឯកទេសក្នុងការងារនេះ ហើយរង់ចាំផ្តល់ជូនលោកអ្នកនូវសេវាកម្មយ៉ាងល្អឥតខ្ចោះ តាមគ្រប់តម្រូវការងារអាជីវកម្មរបស់លោកអ្នក</p>
            </div>

            <div class="row team-row">
                @foreach ($teams as $team)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up">
                            <div class="member-img">
                                <img src="{{ asset($team->image) }}" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="icofont-twitter"></i></a>
                                    <a href=""><i class="icofont-facebook"></i></a>
                                    <a href=""><i class="icofont-instagram"></i></a>
                                    <a href=""><i class="icofont-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $team->name }}</h4>
                                <span>{{ $team->position }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Our Skills Section ======= -->
    <section id="skills" class="skills">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Our <strong>Skills</strong></h2>
                <p>ខាងក្រោមនេះជាបច្ចេកវិទ្យាដែលយើងខ្ញុំប្រើប្រាស់ក្នុងការផលិតគេហទំព័រជូនលោកអ្នក</p>
            </div>

            <div class="row skills-content">

                <div class="col-lg-6" data-aos="fade-up">

                    <div class="progress">
                        <span class="skill">HTML <i class="val">100%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">CSS <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">JavaScript <i class="val">75%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                    <div class="progress">
                        <span class="skill">PHP/Laravel <i class="val">80%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">CMS <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">React <i class="val">55%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section><!-- End Our Skills Section -->

    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Clients</h2>
            </div>

            <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-1.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-2.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-3.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-4.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-5.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-6.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-7.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset('frontend/assets/img/clients/client-8.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Our Clients Section -->
@endsection

@section('style')
    <style>
        .image-container {
            padding: 0 20px;
        }

        #row-img {
            display: flex;
            align-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        ol li{
            font-family: 'battambang';
        }
    </style>
@endsection
