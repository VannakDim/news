@php
    $categories = App\Models\Category::all();
    $tags = App\Models\Tag::all();
    $posts = App\Models\Post::where('status', 'public')->latest()->take(5)->get();
@endphp
<div class="col-lg-4">

    <div class="sidebar" data-aos="fade-left">

        <h3 class="sidebar-title">Search</h3>
        <div class="sidebar-item search-form">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
                <button type="submit"><i class="icofont-search"></i></button>
            </form>

        </div><!-- End sidebar search formn-->

        <h3 class="sidebar-title">Categories</h3>
        <div class="sidebar-item categories">
            <ul>
                @foreach ($categories as $category)
                    <li><a href="{{ route('filter_by_category', $category->name) }}">{{ $category->name }} <span>({{ $category->posts->count() }})</span></a></li>
                @endforeach
            </ul>

        </div><!-- End sidebar categories-->

        <h3 class="sidebar-title">Recent Posts</h3>
        <div class="sidebar-item recent-posts">
            @foreach ($posts as $post)
                <div class="post-item clearfix">
                    <a href="{{ route('home.blog.single', $post->id) }}">
                        <img src="{{ asset($post->image) }}" alt="">
                        <h4>{{ Str::limit($post->title, 20) }}</h4>
                        <time datetime="2020-01-01">{{ $post->created_at->diffForHumans() }}</time>
                    </a>
                </div>
            @endforeach

        </div><!-- End sidebar recent posts-->

        <h3 class="sidebar-title">Tags</h3>
        <div class="sidebar-item tags">
            <ul>
                @foreach ($tags as $tag)
                    <li><a href="{{ route('filter_by_tag', $tag->name) }}">{{ $tag->name }}</a></li>
                @endforeach
            </ul>

        </div><!-- End sidebar tags-->

    </div><!-- End sidebar -->

</div><!-- End blog sidebar -->
