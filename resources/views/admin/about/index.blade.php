@extends('admin.layout.admin')


@section('main_body')
    <div class="py-12">
        <div class="mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom"
                                style="display: flex; justify-content:space-between">
                                <h2 class="kh-koulen" style="font-weight: 700">PAGE "ABOUT"</h2>

                                <a href="{{ url('about/edit/' . $abouts->id) }}" class="btn btn-primary align-right">EDIT
                                    PAGE</a>
                                <div class="card-body">
                                    {{-- <p class="mb-5 text-muted">This is the view of about page.</p> --}}
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="card-deck">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary kh-koulen">
                                                            {{ $abouts->title }}</h5>
                                                        <p class="card-text pb-3 kh-battambang">
                                                            {{ $abouts->short_description }}</p>
                                                        <p class="card-text">
                                                            <small class="text-muted">Created at
                                                                {{ $abouts->created_at->diffForHumans() }}</small>
                                                        </p>
                                                    </div>
                                                    <img class="card-img-top" src="{{ asset($abouts->image) }}"
                                                        alt="Card image cap">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="card-deck">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p class="kh-battambang" style="text-align: justify">
                                                            {!! $abouts->long_description !!}</p>
                                                        @foreach ($abouts->items as $item)
                                                            <ul>
                                                                <li class="kh-battambang">
                                                                    <i class="ri-check-double-line px-2"
                                                                        style="color: #1bbd36"></i>{!! $item->about_item !!}
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                        <p class="kh-battambang">{!! $abouts->more_description !!}</p>
                                                        <p class="card-text">
                                                            <small class="text-muted">Last updated
                                                                {{ $abouts->updated_at->diffForHumans() }}</small>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- <a class="btn btn-primary btn-pill mb-6 float-right" id="add-task" href="{{ route('add.about') }}"
                            role="button"><i class="bi bi-database-add"></i> ADD  </a> --}}

                        {{-- @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif --}}

                        {{-- @show --}}
                        {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">About title</th>
                                    <th scope="col">About description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($abouts as $about)
                                    <tr>
                                        <th scope="row">{{ $abouts->firstItem() + $loop->index }}</th>
                                        <td>{{ $about->title }}</td>
                                        <td>{{ $about->short_description }}</td>
                                        <td><img id="img-td" src="{{ asset($about->image) }}" alt=""></td>
                                        <td>{{ $about->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ url('about/edit/' . $about->id) }}">Edit</a>
                                            <a class="btn btn-danger" href="{{ url('about/softDel/' . $about->id) }}"
                                                href="">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $abouts->links() }} --}}
                    </div>
                </div>


            </div>
        </div>
    </div>

    <style>
        #img-td {
            height: 50px;

        }
    </style>
@endsection
