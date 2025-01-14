@extends('admin.layout.admin')
@section('link')

@endsection

@section('main_body')
    <div class="py-12">
        <div class=" mx-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Edit Contact</h2>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="/contact/update/{{ $contact->id }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" name="address" class="form-control" 
                                            placeholder="Address" value="{{ $contact->address }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Map</label>
                                        <textarea name="map" rows="5" class="form-control" placeholder="Map embed url">{{ $contact->map }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone</label>
                                                <input type="text" name="phone" class="form-control" 
                                                    placeholder="Phone" value="{{ $contact->phone }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="text" name="email" class="form-control" 
                                                    placeholder="Email" value="{{ $contact->email }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Telegram</label>
                                                <input type="text" name="telegram" class="form-control" 
                                                    placeholder="Telegram" value="{{ $contact->telegram }}">
                                                @error('facebook')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Facebook</label>
                                                <input type="text" name="facebook" class="form-control" 
                                                    placeholder="Facebook" value="{{ $contact->facebook }}">
                                                @error('facebook')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Twitter</label>
                                                <input type="text" name="twitter" class="form-control" 
                                                    placeholder="Twitter" value="{{ $contact->twitter }}">
                                                @error('twitter')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Linkin</label>
                                                <input type="text" name="linkedin" class="form-control" 
                                                    placeholder="Linkin" value="{{ $contact->linkedin }}">
                                                @error('linkedin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Instagram</label>
                                                <input type="text" name="instagram" class="form-control" 
                                                    placeholder="Instagram" value="{{ $contact->instagram }}">
                                                @error('instagram')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Youtube</label>
                                                <input type="text" name="youtube" class="form-control" 
                                                    placeholder="Youtube" value="{{ $contact->youtube }}">
                                                @error('youtube')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
