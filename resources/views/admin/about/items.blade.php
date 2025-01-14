@extends('admin.layout.admin')

@section('main_body')
    <div class="py-12">
        <div class="mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-4 shadow">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>About items</h4>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="bi bi-database-add"></i> ADD
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Item</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="employee-form" method="post">

                                        <div class="row">
                                            <div class="col-lg">
                                                <label>Item</label>
                                                <input type="text" name="item" id="item" class="form-control">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" form="employee-form">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-form" method="post">
                            <input type="hidden" id="edit-id" name="id">

                            <div class="row">
                                <div class="col-lg">
                                    <label>Item</label>
                                    <input type="text" id="edit-item" name="item" class="form-control">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="edit-form">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                "ajax": {
                    "url": "{{ route('about_item') }}",
                    "type": "GET",
                    "dataType": "json",
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "dataSrc": function(response) {
                        if (response.status === 200) {
                            return response.item;
                        } else {
                            return [];
                        }
                    }
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "about_item"
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<a href="#" class="btn btn-sm btn-success edit-btn" data-id="' +
                                data.id + '" data-about_item="' + data.about_item + '">Edit</a> ' +
                                '<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="' +
                                data.id + '">Delete</a>';
                        }
                    }
                ]
            });

            $('#myTable tbody').on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var item = $(this).data('about_item');
                $('#edit-id').val(id);
                $('#edit-item').val(item);
                $('#editModal').modal('show');
            });

            $('#employee-form').submit(function(e) {
                e.preventDefault();
                const itemData = new FormData(this);
                $.ajax({
                    url: '{{ route('store.item') }}',
                    method: 'post',
                    data: itemData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            alert("Saved successfully");
                            $('#employee-form')[0].reset();
                            $('#exampleModal').modal('hide');
                            $('#myTable').DataTable().ajax.reload();
                        }
                    }
                });
            });
        });

        
    </script>
@endsection

@section('link')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
