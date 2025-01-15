@extends('frontend.layout.web')

@section('meta')
    <title>វាយោថ្មី|ទំព័រដើម</title>
    <meta name="description" content="កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ">
    <meta property="og:title" content="{{ $meta->title ?? 'កូនខ្មែរកូដ' }}">
    <meta property="og:description" content="{{ $meta->description ?? 'កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ' }}">
    <meta property="og:image" content="{{ asset($meta->image ?? 'frontend/assets/img/default.jpg') }}">
@endsection

@section('content')
    @include('frontend.layout.slider')

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container">
  
          <div class="row">
  
            <div class="col-lg-8 entries">
              @foreach ($posts as $post)
                
              <article class="entry" data-aos="fade-up">
  
                <div class="entry-img">
                  <img src="{{ asset($post->image) }}" alt="" class="img-fluid">
                </div>
  
                <h2 class="entry-title">
                  <a class="kh-koulen" href="blog/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
  
                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">{{$post->user->name}}</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">{{$post->created_at->diffForHumans()}}</time></a></li>
                    <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Comments</a></li>
                  </ul>
                </div>
  
                <div class="entry-content">
                  <p>{{ $post->description }}</p>
                  <div class="read-more">
                    <a href="{{ route('home.blog.single', $post->id) }}">Read More</a>
                  </div>
                </div>
  
              </article><!-- End blog entry -->
              @endforeach
            </div><!-- End blog entries list -->
  
            @include('frontend.layout.rightsidebar')
  
          </div>
  
        </div>
      </section><!-- End Blog Section -->  

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">

            <div class="row content">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="kh-koulen">{{ $about->title }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="kh-koulen">{!! $about->short_description !!}</h3>
                        </div>
                    </div>
                    <div class="row" style="padding: 0 70px">
                        <img id="row-img" src="{{ asset($about->image) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                    <p class="kh-battambang justify">
                        {!! $about->long_description !!}
                    </p>
                    @foreach ($about->items as $item)
                        <ul style="margin-bottom: 0">
                            <li class="kh-battambang"><i class="ri-check-double-line"></i>{{ $item->about_item }}</li>
                        </ul>
                    @endforeach
                    <p class="font-italic">
                        {!! $about->more_description !!}
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</strong></h2>
                <p class="kh-battambang">សេវាកម្មដែលខាងកូនខ្មែរផ្តល់អោយមានដូចខាងក្រោម</p>
            </div>

            <div class="row">
                @foreach ($services as $service)
                    <a href="">
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box iconbox-blue">
                                <div class="icon">
                                    <img src="{{ asset($service->service_icon) }} " alt="" style="height: 100px">
                                </div>
                                <h4 class="kh-battambang"><a href="">{{ $service->service_name }}</a></h4>
                                <p class="kh-battambang">{{ $service->short_description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section><!-- End Services Section -->


    <!-- ======= Our Clients Section ======= -->
    {{-- <section id="clients" class="clients">
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
    </section> --}}<!-- End Our Clients Section -->
@endsection

@section('style')
    <style>
        #row-img {
            height: 100%;
            width: 100%;
        }

        .kh-koulen {
            text-align: center;
        }

        ol li {
            font-family: 'battambang';

        }
    </style>
@endsection
