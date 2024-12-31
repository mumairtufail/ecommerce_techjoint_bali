<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $banners = [
            'homeBanner' => Banner::where('type', 'home')->first(),
            'shopBanner' => Banner::where('type', 'shop')->first(),
            'aboutBanner' => Banner::where('type', 'about')->first(),
            'contactBanner' => Banner::where('type', 'contact')->first(),
            'midPhotoBanner' => Banner::where('type', 'mid_photo')->first(),
            'leftImageBanner' => Banner::where('type', 'left_image')->first(),
            'rightImageBanner' => Banner::where('type', 'right_image')->first(),
        ];
    
        return view('admin.settings', $banners);
    }

    public function updateBanners(Request $request)
    {
        $request->validate([
            'home_banner' => 'nullable|image|mimes:jpeg,png,jpg',
            'shop_banner' => 'nullable|image|mimes:jpeg,png,jpg',
            'about_banner' => 'nullable|image|mimes:jpeg,png,jpg',
            'contact_banner' => 'nullable|image|mimes:jpeg,png,jpg',
            'mid_photo' => 'nullable|image|mimes:jpeg,png,jpg',
            'left_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'right_image' => 'nullable|image|mimes:jpeg,png,jpg',
            
            // Title validations
            'home_title' => 'nullable|string|max:255',
            'shop_title' => 'nullable|string|max:255',
            'about_title' => 'nullable|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'mid_title' => 'nullable|string|max:255',
            'left_title' => 'nullable|string|max:255',
            'right_title' => 'nullable|string|max:255',
            
            // Subtitle validations
            'home_subtitle' => 'nullable|string|max:255',
            'shop_subtitle' => 'nullable|string|max:255',
            'about_subtitle' => 'nullable|string|max:255',
            'contact_subtitle' => 'nullable|string|max:255',
            'mid_subtitle' => 'nullable|string|max:255',
            'left_subtitle' => 'nullable|string|max:255',
            'right_subtitle' => 'nullable|string|max:255',
        ]);

        $bannerConfigs = [
            [
                'type' => 'home',
                'image_key' => 'home_banner',
                'title_key' => 'home_title',
                'subtitle_key' => 'home_subtitle'
            ],
            [
                'type' => 'shop',
                'image_key' => 'shop_banner',
                'title_key' => 'shop_title',
                'subtitle_key' => 'shop_subtitle'
            ],
            [
                'type' => 'about',
                'image_key' => 'about_banner',
                'title_key' => 'about_title',
                'subtitle_key' => 'about_subtitle'
            ],
            [
                'type' => 'contact',
                'image_key' => 'contact_banner',
                'title_key' => 'contact_title',
                'subtitle_key' => 'contact_subtitle'
            ],
            [
                'type' => 'mid_photo',
                'image_key' => 'mid_photo',
                'title_key' => 'mid_title',
                'subtitle_key' => 'mid_subtitle'
            ],
            [
                'type' => 'left_image',
                'image_key' => 'left_image',
                'title_key' => 'left_title',
                'subtitle_key' => 'left_subtitle'
            ],
            [
                'type' => 'right_image',
                'image_key' => 'right_image',
                'title_key' => 'right_title',
                'subtitle_key' => 'right_subtitle'
            ]
        ];


        foreach ($bannerConfigs as $config) {
            $banner = Banner::firstOrCreate(['type' => $config['type']]);
            
            // Handle image upload
            if ($request->hasFile($config['image_key'])) {
                // Delete old image if exists
                if ($banner->image) {
                    Storage::disk('public')->delete($banner->image);
                }
                

                $file = $request->file($config['image_key']);
                $filename = $config['type'] . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('banners', $filename, 'public');
                $banner->image = $path;
            }
            
            // Update title and subtitle
            $banner->title = $request->input($config['title_key'], $banner->title);
            $banner->subtitle = $request->input($config['subtitle_key'], $banner->subtitle);
            $banner->save();
        }

        return redirect()->back()->with('success', 'All banners and images have been updated successfully!');
    }
}