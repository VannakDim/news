@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary btn-pill mb-6 float-right" id="add-post" href="{{ route('page.add-post') }}"
                            role="button"><i class="bi bi-database-add"></i> ADD POST </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        @session('success')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            
                        @endsession
                        <div class="row">
                            @foreach ($posts as $post)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card mb-4">
                                        <div class="card-img-cover" style="background-image: url({{ asset($post->image) }});">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-primary kh-koulen">{{ $post->title }}</h5>
                                            <p class="card-text pb-3">{{ Str::limit($post->description,50) }}</p>
                                            <a href="/post/edit/{{$post->id}}" class="btn btn-outline-primary edit-button">Edit</a>
                                            <a class="btn btn-danger" href="{{ url('post/softDel/' . $post->id) }}"
                                                href="">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


