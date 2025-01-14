@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <img src="{{ asset($brands->brand_image) }}" alt="" width="150" style="float: right">
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Edit Brand <b>{{$brands->brand_name}}</b>
                            </div>

                            <div class="card-body">
                                <form action="{{ url('brand/update/' . $brands->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Brand name</label>
                                        <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1"
                                            placeholder=" Brand name" value="{{ $brands->brand_name }}">
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                        <label for="exampleInputEmail1"> Brand image</label>
                                        <input type="file" name="brand_image" class="form-control"
                                            id="exampleInputEmail1" placeholder=" Brand image">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <a class="btn btn-secondary" href="{{route('all.brand')}}">Back</a>
                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection