@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img class="float-right" src="{{ asset($services->service_icon) }}" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Edit Service</h2>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="{{ $services->id }}">
                                <form action="{{ url('service/update/' . $services->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $services->service_icon }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Service name</label>
                                        <input type="text" name="service_name" class="form-control"
                                            value="{{ $services->service_name }}" id="exampleInputEmail1"
                                            placeholder="Service name">
                                        @error('service_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Short description</label>
                                        <input type="text" name="short_description" class="form-control"
                                            value="{{ $services->short_description }}" id="exampleInputEmail1"
                                            placeholder="Service description">
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Long description</label>
                                        <textarea id="editor" name="long_description" class="form-control" placeholder="Long description" rows="3">{{ $services->long_description }}</textarea>
                                        @error('long_description')
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

                                    <button type="submit" class="btn btn-primary float-right">Save Service</button>
                                    <a href="{{ route('all.service') }}" class="btn btn-secondary float-right"
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
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
    console.error( error );
    });
</script>
@endsection