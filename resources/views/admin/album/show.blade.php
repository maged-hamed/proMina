@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Show: {{$album->name}}
        </div>

        <div class="card-body">
            <div class="form-group">

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>
                            Images
                        </th>
                    </thead>
                    <tbody>
                    @foreach($album->images as $image)
{{--                        <tr>--}}
                            <td>
                                <div class="row">
                                   <a href="{{ $image->url  }}" target="_blank"> <img style="width: 100px; height: 100px;"
                                         src="{{ $image->url  }}">
                                   </a>
                                    {{--                                    {{$image->url}}--}}
                                </div>
                            </td>
{{--                        </tr>--}}
                    @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.album.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection
