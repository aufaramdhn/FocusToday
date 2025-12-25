<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::filter($request->all())->paginate(10);
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.tambah-tag');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:tags,name',
        ], [
            'name.required' => 'Nama tag wajib diisi.',
            'name.unique'   => 'Tag ini sudah ada.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.tag.index')->with('success', 'Tag berhasil dibuat!');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit-tag', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', Rule::unique('tags')->ignore($tag->id)],
        ], [
            'name.unique' => 'Nama tag sudah dipakai.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.tag.index')->with('success', 'Tag diperbarui!');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->articles()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Tag ini masih dipakai di beberapa artikel.');
        }

        $tag->delete();
        return back()->with('success', 'Tag dihapus.');
    }
}
