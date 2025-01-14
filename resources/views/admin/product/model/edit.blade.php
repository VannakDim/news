@extends('admin.layout.admin')
@section('link')
    {{-- CK Editor --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" crossorigin>
@endsection


@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>EDIT MODEL</h2>
                            </div>

                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form id="uploadForm" action="/product/model/update/{{$model->id}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Model:</label>
                                                <input type="text" name="name" class="form-control" value="{{$model->name}}"
                                                    id="exampleInputEmail1" placeholder="Model">
                                            </div>

                                            <div class="form-group">
                                                <label for="category">Category:</label>
                                                <select name="categories[]" id="category" class="form-control">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->name }}"
                                                            @if ($model->category->id == $category->id) selected @endif>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="brands">Brand:</label>
                                                <select name="brands[]" id="brand" class="form-control">
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->brand_name }}"
                                                            @if ($model->brand->id == $brand->id) selected @endif>
                                                            {{ $brand->brand_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Frquency band:</label>
                                                <input frquency="text" name="frequency" class="form-control" value="{{$model->frequency}}"
                                                    id="exampleInputEmail1" placeholder="Frquency band">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Type:</label>
                                                <input type="text" name="type" class="form-control" value="{{$model->type}}"
                                                    id="exampleInputEmail1" placeholder="Product type">
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Power:</label>
                                                <input type="text" name="power" class="form-control" value="{{$model->power}}"
                                                    id="exampleInputEmail1" placeholder="Product power">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Model image</label>
                                                <input type="file" name="image" id="input-image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="post-img" id="img-preview"
                                                style="display: flex; justify-content: center; align-items: center; background-image: url({{ asset($model->image) }}); background-size: cover; background-position: center; width: 100%; height: 100%;">
                                                {{-- <img id="img-preview" src="" alt="Image Preview" style="max-width: 100%;max-height: 350px;object-fit: cover;"> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" class="form-control"
                                            id="exampleInputEmail1" placeholder="Description" rows="3">{{$model->description}}</textarea>
                                    </div>

                                    <!-- Loading indicator -->
                                    <div id="loading" style="display: none;">
                                        Uploading your post..., please wait...
                                    </div>

                                    <button type="submit" class="ladda-button btn btn-primary float-right"
                                        data-style="expand-left">
                                        <span class="ladda-label">Save!</span>
                                        <span class="ladda-spinner"></span>
                                    </button>
                                    <a href="{{ route('model.show') }}" class="btn btn-secondary float-right"
                                        style="margin-right: 6px">Back</a>
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
            $('#brand').select2({
                tags: true, // Allow new tags
                placeholder: "Select or add brand",
                tokenSeparators: [',', ';']
            });
            $('#category').select2({
                tags: true, // Allow new tags
                placeholder: "Select or add category",
                tokenSeparators: [',', ';']
            });
        });
    </script>
    <script>
        // Get the input file and preview image elements
        const default_img = '{{ URL::to('') }}' + '/backend/assets/img/default-image.avif';
        const imageInput = document.getElementById('input-image');
        const previewImage = document.getElementById('img-preview');

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
    </script>
    <script src="https://cdn.tiny.cloud/1/qdi8ljnwutu3zjh290nqmze8oo8w5x9wqh925tzk9eyqpqmk/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    
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
                        // Redirect to the "home" route
                        window.location.href = "{{ route('model.show') }}";
                        alert(response.message);
                    },
                    error: function(xhr) {
                        // Hide loading indicator
                        $('#loading').hide();
                        alert('Upload failed: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection
