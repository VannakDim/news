@extends('admin.layout.admin')

@section('main_body')
    

    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Add Service</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.service') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Service name</label>
                                        <input type="text" name="service_name" class="form-control"
                                            id="exampleInputEmail1" placeholder="Service name">
                                        @error('service_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short description</label>
                                        <input type="text" name="short_description" class="form-control"
                                            id="exampleInputEmail1" placeholder="Service description">
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Long description</label>
                                        <textarea name="long_description" class="form-control" placeholder="Long description" rows="3"></textarea>

                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Service image</label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Add Service</button>
                                    <a href="{{route('all.service')}}" class="btn btn-secondary float-right" style="margin-right: 6px">Back</a>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
