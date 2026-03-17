<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * List of all editable page settings with labels and field types.
     */
    private array $pageConfig = [
        'home' => [
            'label' => 'Halaman Home',
            'fields' => [
                'home_hero_title'       => ['label' => 'Hero Title',       'type' => 'text'],
                'home_hero_subtitle'    => ['label' => 'Hero Subtitle',    'type' => 'text'],
                'home_hero_image'       => ['label' => 'Hero Background Image', 'type' => 'image'],
                'home_section_title'    => ['label' => 'Section Title (Featured)', 'type' => 'text'],
            ],
        ],
        'about' => [
            'label' => 'Halaman About',
            'fields' => [
                'about_hero_title'      => ['label' => 'Hero Title',           'type' => 'text'],
                'about_hero_subtitle'   => ['label' => 'Hero Subtitle',        'type' => 'textarea'],
                'about_hero_image'      => ['label' => 'Hero Image',           'type' => 'image'],
                'about_story_title'     => ['label' => 'Our Story Title',      'type' => 'text'],
                'about_story_text'      => ['label' => 'Our Story Text',       'type' => 'textarea'],
                'about_mission_title'   => ['label' => 'Mission Title',        'type' => 'text'],
                'about_mission_text'    => ['label' => 'Mission Text',         'type' => 'textarea'],
                'about_team_title'      => ['label' => 'Team Section Title',   'type' => 'text'],
                'about_photo1_image'    => ['label' => 'Team Photo 1',         'type' => 'image'],
                'about_photo2_image'    => ['label' => 'Team Photo 2',         'type' => 'image'],
                'about_photo3_image'    => ['label' => 'Team Photo 3',         'type' => 'image'],
                'about_stat1_number'    => ['label' => 'Stat 1 Number',        'type' => 'text'],
                'about_stat1_label'     => ['label' => 'Stat 1 Label',         'type' => 'text'],
                'about_stat2_number'    => ['label' => 'Stat 2 Number',        'type' => 'text'],
                'about_stat2_label'     => ['label' => 'Stat 2 Label',         'type' => 'text'],
                'about_stat3_number'    => ['label' => 'Stat 3 Number',        'type' => 'text'],
                'about_stat3_label'     => ['label' => 'Stat 3 Label',         'type' => 'text'],
            ],
        ],
        'destinations' => [
            'label' => 'Halaman Destinations',
            'fields' => [
                'destinations_hero_title'    => ['label' => 'Hero Title',    'type' => 'text'],
                'destinations_hero_subtitle' => ['label' => 'Hero Subtitle', 'type' => 'text'],
                'destinations_hero_image'    => ['label' => 'Hero Image',    'type' => 'image'],
            ],
        ],
        'blog' => [
            'label' => 'Halaman Blog',
            'fields' => [
                'blog_hero_title'    => ['label' => 'Hero Title',    'type' => 'text'],
                'blog_hero_subtitle' => ['label' => 'Hero Subtitle', 'type' => 'text'],
                'blog_hero_image'    => ['label' => 'Hero Image',    'type' => 'image'],
            ],
        ],
        'general' => [
            'label' => 'Pengaturan Umum',
            'fields' => [
                'site_name'        => ['label' => 'Nama Situs',      'type' => 'text'],
                'site_tagline'     => ['label' => 'Tagline',         'type' => 'text'],
                'site_logo_image'  => ['label' => 'Logo Situs',      'type' => 'image'],
                'footer_text'      => ['label' => 'Footer Text',     'type' => 'textarea'],
                'social_instagram' => ['label' => 'Instagram URL',   'type' => 'text'],
                'social_twitter'   => ['label' => 'Twitter URL',     'type' => 'text'],
                'social_facebook'  => ['label' => 'Facebook URL',    'type' => 'text'],
            ],
        ],
    ];

    public function edit(string $page)
    {
        if (!array_key_exists($page, $this->pageConfig)) {
            abort(404);
        }

        $config = $this->pageConfig[$page];
        $keys   = array_keys($config['fields']);
        $settings = SiteSetting::whereIn('key', $keys)->pluck('value', 'key');

        return view('admin.pages.edit', [
            'page'    => $page,
            'config'  => $config,
            'settings'=> $settings,
            'pages'   => $this->pageConfig,
        ]);
    }

    public function update(Request $request, string $page)
    {
        if (!array_key_exists($page, $this->pageConfig)) {
            abort(404);
        }

        $config = $this->pageConfig[$page];

        foreach ($config['fields'] as $key => $field) {
            if ($field['type'] === 'image') {
                if ($request->hasFile($key)) {
                    // Delete old
                    $old = SiteSetting::get($key);
                    if ($old && Str::startsWith($old, '/storage/')) {
                        Storage::disk('public')->delete(Str::after($old, '/storage/'));
                    }
                    $path = $request->file($key)->store('uploads/pages', 'public');
                    SiteSetting::set($key, '/storage/' . $path);
                } elseif ($request->filled($key . '_url')) {
                    SiteSetting::set($key, $request->input($key . '_url'));
                }
                // else: keep existing
            } else {
                if ($request->has($key)) {
                    SiteSetting::set($key, $request->input($key));
                }
            }
        }

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Konten halaman berhasil disimpan!');
    }

    public function getPages(): array
    {
        return $this->pageConfig;
    }
}
