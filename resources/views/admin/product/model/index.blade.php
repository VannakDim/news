@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary btn-pill mb-6 float-right" id="add-post" href="{{ route('product.model') }}"
                            role="button"><i class="bi bi-database-add"></i> ADD MODEL </a>
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
                            @foreach ($models as $model)
                                <div class="col-md-6 col-xl-3">
                                    <div class="card mb-4">
                                        <div class="card-img-cover" style="background-image: url({{ asset($model->image) }});">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">{{$model->brand->brand_name}} <strong>{{ $model->name }}</strong></h5>
                                            <p class="badge badge-warning">{{ $model->frequency}}</p><span  class="badge badge-success">{{$model->type}}</span>
                                            <p class="card-text py-3">{{ Str::limit($model->description,50) }}</p>
                                            <a href="/product/model/edit/{{$model->id}}" class="btn btn-outline-primary edit-button">Edit</a>
                                            <a class="btn btn-danger" href="{{ url('product/softDel/' . $model->id) }}"
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


