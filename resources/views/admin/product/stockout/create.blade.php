@extends('admin.layout.admin')
@section('link')
    {{-- CK Editor --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" crossorigin>
@endsection


@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>STOCK OUT</h2>
                            </div>

                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form id="uploadForm" method="POST" action="{{ route('stockout.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Receiver:</label>
                                                <input type="text" name="receiver" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Receiver">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Purpose:</label>
                                                <input type="text" name="type" class="form-control"
                                                    id="exampleInputEmail1" placeholder="Purpose or unit">
                                            </div>

                                            <label for="model">Product list:</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="models" id="model" class="form-control">
                                                            @foreach ($models as $model)
                                                                <option value="{{ $model->id }}">
                                                                    {{ $model->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" id="quantity"
                                                            placeholder="Quantity" min="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="addItem(event)">ADD TO LIST</button>
                                                </div>
                                            </div>
                                            <table class="table table-bordered" id="itemsTable">
                                                <thead>
                                                    <tr>
                                                        <th>Model ID</th>
                                                        <th>Model name</th>
                                                        <th>Quantity</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Items will be added here dynamically -->
                                                </tbody>
                                            </table>
                                            <!-- Hidden input to store the items data -->
                                            <input type="hidden" name="items" id="itemsInput" required>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Invoice image</label>
                                                <input type="file" name="image" id="input-image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="post-img" id="img-preview"
                                                style="display: flex; justify-content: center; align-items: center; background-image: url({{ asset('backend/assets/img/default-image.avif') }}); background-size: cover; background-position: center; width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Note:</label>
                                        <textarea name="note" class="form-control" id="exampleInputEmail1" placeholder="Description your note"
                                            rows="3"></textarea>
                                    </div>

                                    <!-- Loading indicator -->
                                    <div id="loading" style="display: none;">
                                        Uploading..., please wait...
                                    </div>

                                    <button type="submit" class="ladda-button btn btn-primary float-right"
                                        data-style="expand-left">
                                        <span class="ladda-label">Save!</span>
                                        <span class="ladda-spinner"></span>
                                    </button>
                                    <a href="{{ route('all.product') }}" class="btn btn-secondary float-right"
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
        // Get the input file and preview image elements
        const default_img = '{{ URL::to('') }}' + '/backend/assets/img/default-image.avif';
        const imageInput = document.getElementById('input-image');
        const previewImage = document.getElementById('img-preview');

        // Listen for the file input change event
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the selected file

            if (file) {
                // Create a file reader
                const reader = new FileReader();

                // Load the image and set it as the src of the previewImage
                reader.onload = function(e) {
                    previewImage.style.backgroundImage = `url('${e.target.result}')`;
                    previewImage.style.display = 'block'; // Make the image visible
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            } else {
                // If no file is selected, hide the image preview
                previewImage.style.backgroundImage = `url('${default_img}')`;
                previewImage.style.display = 'none';
            }
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/qdi8ljnwutu3zjh290nqmze8oo8w5x9wqh925tzk9eyqpqmk/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Show loading indicator
            $('#loading').show();

            // Submit the form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // Hide loading indicator
                    $('#loading').hide();
                    alert(response.message);
                    window.location.href =
                        '{{ route('stockout.create') }}'; // Redirect to the "home" route
                },
                error: function(xhr) {
                    // Hide loading indicator
                    $('#loading').hide();
                    alert('Upload failed: ' + xhr.responseJSON.message);
                }
            });
        });
    </script>
    <script>
        // Array to store added items
        let items = [];

        // Function to add an item to the list
        function addItem(event) {
            event.preventDefault(); // Prevent form submission
            const modelId = document.getElementById('model').value;
            const modelText = document.getElementById('model').options[document.getElementById('model').selectedIndex]
                .text;
            const quantity = document.getElementById('quantity').value;

            if (!modelId || !quantity) {
                alert('Please fill the product and quantity.');
                return;
            }

            // Add item to the array
            items.push({
                model_id: modelId,
                model_text: modelText,
                quantity: quantity
            });

            // Update the table
            updateTable();

            // Clear the form fields
            // document.getElementById('model').value = '';
            document.getElementById('quantity').value = '';
        }

        // Function to update the table with added items
        function updateTable() {
            const tableBody = document.querySelector('#itemsTable tbody');
            tableBody.innerHTML = '';

            items.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${item.model_id}</td>
                <td>${item.model_text}</td>
                <td>${item.quantity}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">Remove</button>
                </td>
            `;
                tableBody.appendChild(row);
            });

            // Update the hidden input with the items data
            document.getElementById('itemsInput').value = JSON.stringify(items);
        }

        // Function to remove an item from the list
        function removeItem(index) {
            items.splice(index, 1);
            updateTable();
        }
    </script>
@endsection
