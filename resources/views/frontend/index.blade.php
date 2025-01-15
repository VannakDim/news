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
