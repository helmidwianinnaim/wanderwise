<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(15);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.form', ['destination' => new Destination()]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['image'] = $this->handleImage($request, null);
        $data['gallery_photos'] = $this->handleGallery($request, []);

        Destination::create($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.form', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $this->validatedData($request);
        $newImage = $this->handleImage($request, $destination->image);
        if ($newImage !== null) {
            $data['image'] = $newImage;
        } else {
            $data['image'] = $destination->image;
        }

        $data['gallery_photos'] = $this->handleGallery($request, is_array($destination->gallery_photos) ? $destination->gallery_photos : []);

        $destination->update($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diperbarui!');
    }

    public function destroy(Destination $destination)
    {
        // Delete local uploaded image if it's a storage path
        if ($destination->image && Str::startsWith($destination->image, '/storage/')) {
            $path = Str::after($destination->image, '/storage/');
            Storage::disk('public')->delete($path);
        }

        // Delete gallery photos
        $gallery = is_array($destination->gallery_photos) ? $destination->gallery_photos : [];
        foreach ($gallery as $photo) {
            if (isset($photo['url']) && Str::startsWith($photo['url'], '/storage/')) {
                $path = Str::after($photo['url'], '/storage/');
                Storage::disk('public')->delete($path);
            }
        }

        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil dihapus!');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255',
            'country'      => 'required|string|max:255',
            'region'       => 'required|in:usa,europe',
            'description'  => 'required|string',
            'tag'          => 'nullable|string|max:100',
            'guides_count' => 'nullable|integer|min:0',
            'rating'       => 'nullable|integer|min:1|max:5',
            'featured'     => 'nullable|boolean',
        ]);

        $validated['slug']         = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['featured']     = $request->boolean('featured');
        $validated['guides_count'] = $validated['guides_count'] ?? 0;
        $validated['rating']       = $validated['rating'] ?? 5;

        return $validated;
    }

    private function handleImage(Request $request, ?string $current): ?string
    {
        if ($request->hasFile('image')) {
            // Delete old local image
            if ($current && Str::startsWith($current, '/storage/')) {
                $path = Str::after($current, '/storage/');
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('image')->store('uploads/destinations', 'public');
            return '/storage/' . $path;
        }

        // If user provided an image URL in text field
        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return null;
    }

    private function handleGallery(Request $request, array $currentGallery): array
    {
        $gallery = $currentGallery;
        
        if ($request->has('delete_gallery')) {
            $deleteIndices = $request->input('delete_gallery');
            foreach ($deleteIndices as $index) {
                if (isset($gallery[$index])) {
                    $photo = $gallery[$index];
                    if (isset($photo['url']) && Str::startsWith($photo['url'], '/storage/')) {
                        $path = Str::after($photo['url'], '/storage/');
                        Storage::disk('public')->delete($path);
                    }
                    unset($gallery[$index]);
                }
            }
            $gallery = array_values($gallery);
        }

        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('uploads/destinations/gallery', 'public');
                    $gallery[] = [
                        'url' => '/storage/' . $path,
                        'label' => 'Gallery Photo'
                    ];
                }
            }
        }
        
        if ($request->filled('gallery_urls')) {
            $urls = explode("\n", str_replace("\r", "", $request->input('gallery_urls')));
            foreach ($urls as $url) {
                $url = trim($url);
                if (!empty($url)) {
                    $gallery[] = [
                        'url' => $url,
                        'label' => 'Gallery Photo'
                    ];
                }
            }
        }

        return $gallery;
    }
}
