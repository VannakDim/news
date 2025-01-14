<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Categories') }} {{ $categories->category_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                
                </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      Add Category
                    </div>
                    <div class="card-body">
                      <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Category name</label>
                          <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Category name" value="{{ $categories->category_name }}">
                          @error('category_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Category</button>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        </div>
      </div>
</x-app-layout>