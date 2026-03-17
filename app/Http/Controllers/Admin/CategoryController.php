<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form', ['category' => new Category()]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validatedData($request);
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:100',
            'slug'  => 'nullable|string|max:100',
            'color' => 'nullable|string|max:20',
        ]);

        $validated['slug']  = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['color'] = $validated['color'] ?? '#6366F1';

        return $validated;
    }
}
