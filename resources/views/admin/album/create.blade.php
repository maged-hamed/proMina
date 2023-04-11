@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Create Album
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("admin.album.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="form-group col-md-6">
                        <label class="required" for="title">Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}"
                               required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="title">Images</label>
                        <input class="form-control" type="file" name="images[]" multiple accept="image/png, image/gif, image/jpeg" required >
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <button class="btn btn-danger" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
