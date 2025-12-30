<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::filter($request->all())->paginate(10);
        return view('admin.kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.kategori.tambah-kategori');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:categories,name',
        ], [
            'name.unique' => 'Kategori ini sudah ada.',
            'name.required' => 'Nama kategori wajib diisi.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori dibuat!');
    }

    public function edit(Category $category)
    {
        return view('admin.kategori.edit-kategori', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', Rule::unique('categories')->ignore($category->id)],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->articles()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Masih ada artikel di kategori ini.');
        }

        $category->delete();
        return back()->with('success', 'Kategori dihapus.');
    }
}
