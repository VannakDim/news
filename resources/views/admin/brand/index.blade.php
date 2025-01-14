@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class="mx-auto">
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
                        {{-- @show --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand name</th>
                                    <th scope="col">Brand image</th>
                                    <th scope="col">Created by</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_image }}"
                                                width="50"></td>
                                        <td>{{ $brand->user->name }}</td>
                                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ url('brand/edit/' . $brand->id) }}">Edit</a>
                                            <a class="btn btn-danger" href="{{ url('brand/softDel/' . $brand->id) }}"
                                                href="">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Brand
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand name</label>
                                        <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1"
                                            placeholder="Brand name">
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand image</label>
                                        <input type="file" name="brand_image" class="form-control"
                                            id="exampleInputEmail1" placeholder="Brand image">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Brand</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
