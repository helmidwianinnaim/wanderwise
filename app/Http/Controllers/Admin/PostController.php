<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.form', ['post' => new Post(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['image'] = $this->handleImage($request, null);

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil ditambahkan!');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.form', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validatedData($request);
        $newImage = $this->handleImage($request, $post->image);
        if ($newImage !== null) {
            $data['image'] = $newImage;
        } else {
            $data['image'] = $post->image;
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        if ($post->image && Str::startsWith($post->image, '/storage/')) {
            $path = Str::after($post->image, '/storage/');
            Storage::disk('public')->delete($path);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus!');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'category_id'  => 'nullable|exists:categories,id',
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255',
            'excerpt'      => 'required|string',
            'content'      => 'required|string',
            'author'       => 'nullable|string|max:100',
            'read_time'    => 'nullable|integer|min:1',
            'featured'     => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug']         = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['featured']     = $request->boolean('featured');
        $validated['author']       = $validated['author'] ?? 'WanderWise Team';
        $validated['read_time']    = $validated['read_time'] ?? 5;
        $validated['published_at'] = $validated['published_at'] ?? now();

        return $validated;
    }

    private function handleImage(Request $request, ?string $current): ?string
    {
        if ($request->hasFile('image')) {
            if ($current && Str::startsWith($current, '/storage/')) {
                $path = Str::after($current, '/storage/');
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('image')->store('uploads/posts', 'public');
            return '/storage/' . $path;
        }

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return null;
    }
}
