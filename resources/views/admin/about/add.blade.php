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
                                <h2>Add About</h2>
                            </div>

                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{ route('store.about') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">About title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                            placeholder="About title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short description</label>
                                        <input type="text" name="short_description" class="form-control"
                                            id="exampleInputEmail1" placeholder="Short description">
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Long description</label>
                                        <div class="editor-container editor-container_classic-editor" id="editor-container">
                                            <div class="editor-container__editor">
                                                <textarea id="editor" name="long_description" class="form-control" placeholder="Long description"></textarea>
                                            </div>
                                        </div>
                                        @error('long_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">About image</label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Add About</button>
                                    <a href="{{ route('all.about') }}" class="btn btn-secondary float-right"
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
    <script src="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.umd.js" crossorigin></script>
    <script src="https://cdn.ckbox.io/ckbox/2.6.1/ckbox.js" crossorigin></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
@endsection
