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
                <h2><strong>NEW FEED</strong></h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>blog</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

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
