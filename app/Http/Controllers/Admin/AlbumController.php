<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::orderBy('id', 'DESC')->get();
        return view('admin.album.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(Request $request)
    {
        $album = Album::create($request->all());
        foreach ($request->images as $image) {
            $album->addMedia($image)->toMediaCollection('album');
        }
        return redirect()->route('admin.album.index');
    }

    public function edit($id)
    {
        $album = Album::find($id);
        return view('admin.album.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::find($id);
        $album->update($request->all());
        if ($request->images) {
            $old_images = $album->getMedia('album', []);
            foreach ($old_images as $old_image) $old_image->forceDelete();
            foreach ($request->images as $image) {
                $album->addMedia($image)->toMediaCollection('album');
            }
        }
        return redirect()->route('admin.album.index');
    }

    public function show($id)
    {
        $album = Album::find($id);
        return view('admin.album.show', compact('album'));
    }

    public function deleteAlbum(Request $request)
    {
        $album = Album::find($request->album_id);
        if (sizeof($album->images)) {
            if ($request->type == 0) {
                $old_images = $album->getMedia('album', []);
                if ($old_images)
                    foreach ($old_images as $old_image) $old_image->forceDelete();
                return 'success';
            } else {
                $albums = $album->getMedia('album', []);
                if ($albums) {
                    foreach ($albums as $album) {
                        $album->update([
                            'model_id' => $request->other_album_id
                        ]);
                    }
                }
                return 'success';
            }
        }
        return 0;
//        else {
//            $album->delete();
//            return 'success';
//        }
    }

    public function getOtherAlbums($id)
    {
        $albums = Album::where('id', '!=', $id)->get();
        if ($albums)
            return $albums;
        else
            return 0;
    }

}
