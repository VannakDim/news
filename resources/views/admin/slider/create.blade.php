@extends('admin.layout.admin')

@section('main_body')
    

    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Add Slider</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title:</label>
                                        <input type="text" name="title" class="form-control"
                                            id="exampleInputEmail1" placeholder="Slider title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short description</label>
                                        <input type="text" name="description" class="form-control"
                                            id="exampleInputEmail1" placeholder="Slider description">
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slider image</label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Add Slider</button>
                                    <a href="{{route('all.slider')}}" class="btn btn-secondary float-right" style="margin-right: 6px">Back</a>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
