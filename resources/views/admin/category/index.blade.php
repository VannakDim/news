@extends('admin.layout.admin')

@section('main_body')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
                  
              @show
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Category name</th>
                      <th scope="col">Created by</th>
                      <th scope="col">Created at</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                    <tr>
                      <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                      <td>{{ $category->category_name }}</td>
                      <td>{{ $category->user->name }}</td>
                      <td>{{ $category->created_at->diffForHumans() }}</td>
                      <td>
                        <a class="btn btn-info" href="{{ url('category/edit/'. $category->id) }}">Edit</a>
                      <a class="btn btn-danger" href="{{ url('category/softDel/'.$category->id) }}" href="">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $categories->links() }}
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    Add Category
                  </div>
                  <div class="card-body">
                    <form action="{{ route('store.category') }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category name</label>
                        <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Category name">
                        @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
      </div>
      </div>
    </div>

@endsection
