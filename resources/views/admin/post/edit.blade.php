@extends('admin.layout.admin')
@section('link')
    {{-- CK Editor --}}
    {{-- <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" crossorigin> --}}
@endsection
@php
    $categories = App\Models\Category::all();
@endphp
@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Edit Blog</h2>
                            </div>

                            <div class="card-body">
                                <div id="response-message"></div> <!-- Add this div to display messages -->
                                <form id="uploadForm" action="/post/update/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Blog title</label>
                                                <input type="text" name="title" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Blog title"
                                                    value="{{ $post->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category:</label>
                                                <select name="categories[]" id="category" class="form-control">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->name }}"
                                                            @if ($post->categories->contains($category->id)) selected @endif>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tags">Tags:</label>
                                                <select name="tags[]" id="tags" class="form-control"
                                                    multiple="multiple">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->name }}"
                                                            @if ($post->tags->contains($tag->id)) selected @endif>
                                                            {{ $tag->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tags')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="featured">Featured</label>
                                                <input type="checkbox" name="featured" id="featured"
                                                    value="@if (true) 1 @else 0 @endif"
                                                    @if ($post->is_featured) checked @endif>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect12">Publish status:</label>
                                                <select name="status" class="form-control" id="exampleFormControlSelect12">
                                                    <option value="public"
                                                        {{ $post->status == 'public' ? 'selected' : '' }}>Public</option>
                                                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>
                                                        Draft</option>
                                                </select>
                                            </div>
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Thumbnail image</label>
                                                <input id="input-image" type="file" name="image" class="form-control" accept="image/*"
                                                    style="border: rgb(209, 215, 221) 0.1px solid;">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Additional Images</label>
                                                <input type="file" name="images[]" id="input-images" class="form-control" multiple>
                                                <div id="image-preview-container" style="display: flex; flex-wrap: wrap; gap: 10px;">
                                                    @if ($post->images->count() > 0)
                                                        @foreach ($post->images as $image)
                                                            <div style="background-image: url('{{ asset('images/' . $image->image) }}'); width: 100px; height: 100px; background-size: contain; background-repeat:no-repeat; background-position: center;"></div>
                                                        @endforeach
                                                    @else
                                                        <div style="background-image: url('{{ asset('images/default-image.avif') }}'); width: 100px; height: 100px; background-size: contain; background-position: center;"></div>
                                                    @endif
                                                </div>
                                                @error('images')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="audio">Choose an audio file:</label>
                                                <input type="file" name="audio" id="audio" accept="audio/*">
                                                @if ($post->audio)
                                                    <audio controls>
                                                        <source src="{{ asset( $post->audio) }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @endif
                                                @error('audio')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube_url">YouTube URL:</label>
                                                <input type="url" name="video" id="youtube_url" class="form-control" placeholder="Enter YouTube URL" value="{{ $post->video }}">
                                                @if ($post->video)
                                                    <div class="mt-3">
                                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($post->video, '/') }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                    </div>
                                                @endif
                                                @error('youtube_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div id="img-preview"
                                                style="display: flex; justify-content: center; align-items: center; background-image: url({{ asset($post->image) }}); background-size: contain; background-repeat:no-repeat; background-position: center; width: 100%; height: 100%;">
                                            </div>
                                            {{-- <img src="{{ asset($post->image) }}" alt="" style="width: 100%"> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Description</label>
                                                <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="Description" value="{{ $post->description }}">
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Content</label>
                                                <textarea id="editor" name="content" class="form-control" placeholder="Content" rows="5">{{ $post->content }}</textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Loading indicator -->
                                            <div id="loading" style="display: none;">
                                                Updating, please wait...
                                            </div>
                                            <button type="submit" class="ladda-button btn btn-primary float-right"
                                                data-style="expand-left">
                                                <span class="ladda-label">Update!</span>
                                                {{-- <span class="ladda-spinner"></span> --}}
                                            </button>
                                            <a href="{{ route('all.post') }}" class="btn btn-secondary float-right"
                                                style="margin-right: 6px">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#tags').select2({
                tags: true, // Allow new tags
                placeholder: "Select or add tags",
                tokenSeparators: [',', ' ']
            });
            $('#category').select2({
                tags: true, // Allow new tags
                placeholder: "Select or add category",
                tokenSeparators: [',', ' ']
            });
        });
    </script>
    <script>
        // Get the input file and preview image elements
        const default_img = '{{ URL::to('') }}' + '/backend/assets/img/default-image.avif';
        const imageInput = document.getElementById('input-image');
        const previewImage = document.getElementById('img-preview');
        const imagesInput = document.getElementById('input-images');
        const imagePreviewContainer = document.getElementById('image-preview-container');

        // Listen for the file input change event
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the selected file

            if (file) {
                // Create a file reader
                const reader = new FileReader();

                // Load the image and set it as the src of the previewImage
                reader.onload = function(e) {
                    previewImage.style.backgroundImage = `url('${e.target.result}')`;
                    previewImage.style.display = 'block'; // Make the image visible
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            } else {
                // If no file is selected, hide the image preview
                previewImage.style.backgroundImage = `url('${default_img}')`;
                previewImage.style.display = 'none';
            }
        });

        // Listen for the multiple images input change event
        imagesInput.addEventListener('change', function(event) {
            const files = event.target.files; // Get the selected files
            imagePreviewContainer.innerHTML = ''; // Clear previous previews

            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('div');
                    img.style.backgroundImage = `url('${e.target.result}')`;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.backgroundSize = 'contain';
                    img.style.backgroundPosition = 'center';
                    imagePreviewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/qdi8ljnwutu3zjh290nqmze8oo8w5x9wqh925tzk9eyqpqmk/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'autolink lists link image charmap preview anchor pagebreak',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | charmap | pagebreak | help',
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Show loading indicator
                $('#loading').show();

                // Submit the form via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Hide loading indicator
                        $('#loading').hide();
                        $('#response-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    },
                    error: function(xhr) {
                        // Hide loading indicator
                        $('#loading').hide();
                        $('#response-message').html('<div class="alert alert-danger">' + xhr.responseJSON.error + '</div>');
                    }
                });
            });
        });
    </script>
@endsection
