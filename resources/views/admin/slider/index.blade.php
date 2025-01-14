@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            @foreach ($sliders as $slider)
                                <div class="col-md-6 col-xl-4">
                                    <div class="card mb-4">
                                        <div class="card-img-cover"
                                            style="background-image: url({{ asset($slider->image) }});"></div>
                                        {{-- <img style="" class="card-img-top" src="{{ asset($slider->image) }}"> --}}
                                        <div class="card-body">
                                            <h5 class="card-title text-primary kh-koulen">{{ $slider->title }}</h5>
                                            <p class="card-text pb-3">{{ $slider->description }}</p>
                                            <a href="#" class="btn btn-outline-primary edit-button"
                                                data-id={{ $slider->id }}>Edit</a>
                                            <a class="btn btn-danger" href="{{ url('slider/softDel/' . $slider->id) }}"
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

        {{-- MODAL FORM --}}
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><strong>EDIT SLIDER</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="edit-error" class="alert-danger" style="display: none">
                            <ul class="mb-0"></ul>
                        </div>
                        <form id="edit-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="edit-id" name="id">

                            <div class="row">
                                <div class="col-lg">
                                    <img src="" alt="" id="edit-image">
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-lg">
                                    {{-- <p class="text-muted">Image file must be less than 2mb</p> --}}
                                    <input type="file" id="edit-newimage" name="image">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <label>Title</label>
                                    <input type="text" id="edit-title" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <label>Description</label>
                                    <textarea type="text" id="edit-description" name="description" class="form-control"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="edit-form">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        var SITEURL = '{{ URL::to('') }}' + '/';


        $(document).ready(function() {

            $('.card').on('click', '.edit-button', function() {

                var id = ($(this).data('id'));
                $.ajax({
                        url: '/slider/get/' + id,
                        type: 'GET',
                    })
                    .done(function(response) {
                        console.log(response.message);
                        $('#edit-id').val(id);
                        $('#edit-title').val(response.slider.title);
                        $('#edit-description').val(response.slider.description);
                        $('#edit-image').attr('src', SITEURL + response.slider.image);
                        $('#editModal').modal('show');

                    })
            });

            $('#edit-form').submit(function(e) {

                $('#edit-error').hide();
                e.preventDefault();
                const sliderData = new FormData(this);
                $.ajax({
                    url: '{{ route('update_slider') }}',
                    method: 'POST',
                    data: sliderData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            $('#edit-form')[0].reset();
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            $('#edit-error').find('ul').html('');
                            $.each(response.error, function(index, val) {
                                $('#edit-error').find('ul').append('<li>' + val +
                                    '</li>');
                            })
                            $('#edit-error').show();
                            console.log(response.error);
                        }
                    }
                });
            });
        });
    </script>
@endsection

@section('link')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
