@extends('frontend.layout.web')

@section('meta')
    <title>{{ $meta->title ?? 'KON KHMER CODE' }}</title>
    <meta name="description"
        content="{{ $meta->description ?? 'កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ' }}">
    <meta property="og:title" content="{{ $meta->title ?? 'កូនខ្មែរកូដ' }}">
    <meta property="og:description"
        content="{{ $meta->description ?? 'កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ' }}">
    <meta property="og:image" content="{{ asset($meta->image ?? 'frontend/assets/img/default.jpg') }}">
@endsection

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><b>Search</b></h2>
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
                    <h1>Search Results for "{{ $query }}"</h1>
                    @if ($results['posts']->isNotEmpty())
                    <hr>
                        <h2>Posts</h2>
                        @foreach ($results['posts'] as $post)
                            <div class="card mb-3" style="padding: 20px;">
                                <h3>{{ $post->title }}</h3>
                                <p>{!! Str::limit($post->content, 100) !!}</p>
                                <a class="btn btn-primary" href="{{ route('home.blog.single', $post->id) }}">Read More</a>
                            </div>
                        @endforeach
                    @endif
                    @if ($results['tags']->isNotEmpty())
                    <hr>
                        <h2>Tags</h2>
                        @foreach ($results['tags'] as $tag)
                            <div class="btn btn-primary">{{ $tag->name }}</div>
                        @endforeach
                    @endif

                    {{-- @if ($results['comments']->isNotEmpty())
                        <h2>Comments</h2>
                        @foreach ($results['comments'] as $comment)
                            <div>{{ $comment->content }}</div>
                        @endforeach
                    @endif --}}
                </div>

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

        ol li {
            font-family: 'battambang';
        }
    </style>
@endsection
