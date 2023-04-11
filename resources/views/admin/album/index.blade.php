@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.album.create') }}">
                Create Album
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Albums
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>

                        <th>&nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($albums as $album)
                        <tr>

                            <td>
                                {{ $album->id ?? '' }}
                            </td>
                            <td>
                                {{ $album->name ?? '' }}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-info"
                                   href="{{ route('admin.album.show', $album->id) }}">
                                    Show
                                </a>
                                <a class="btn btn-xs btn-info"
                                   href="{{ route('admin.album.edit', $album->id) }}">
                                    Edit
                                </a>

                                <button onclick="showDeleteModal({{$album->id}})"
                                        class="btn btn-xs btn-danger"> Delete
                                </button>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control" name="type" id="type" required onchange="selectType()">
                        <option selected disabled value="">Choose</option>
                        <option value="0">Delete all pictures</option>
                        <option value="1">Move to another album</option>
                        {{--                        <option value="2">Delete album</option>--}}
                        {{--                        you didnt mention if user has to delete his album--}}

                    </select>
                    <select class="form-control" name="album_id" id="albums" style="display: none;">
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="save()" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        @parent
        let album_id = ''

        function showDeleteModal(albumID) {
            this.album_id = albumID
            $('#deleteModal').modal('show')
        }

        function selectType() {
            if ($('#type').val() == 1) {
                $.ajax({
                    url: '{{url('admin/other-album')}}' + '/' + this.album_id,
                    method: 'GET',
                    success: function (data) {
                        if (data != 0) {
                            let albums = $('#albums');
                            albums.empty()
                            for (let i = 0; i < data.length; i++) {
                                albums.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
                            }
                        } else {
                            alert('there are no other albums!..')
                        }
                    }
                });
                $('#albums').show()
            } else {
                $('#albums').empty()
                $('#albums').hide()
            }
        }

        function save() {
            $.ajax({
                url: '{{url('admin/delete-album-action')}}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    type: $('#type').val(),
                    album_id: this.album_id,
                    other_album_id: $('#albums').val()
                },
                success: function (data) {
                    if (data == 0) {
                        alert('no pictures in this album!')
                    }
                    $('#deleteModal').modal('hide');
                },
            })

        }
    </script>
@endsection

