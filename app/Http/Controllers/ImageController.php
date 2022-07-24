<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function store(Request $request) {
        $storagePath = $request->file('image')->store('public');
        $publicPath = 'storage/' . explode('/', $storagePath)[1];
        $productId = $request->input('product-id');

        $image = Image::create([
            'storage_path' => $storagePath,
            'public_path' => $publicPath,
            'product_id' => $productId
        ]);

        return response()->json([
            'message' => 'Uploaded!',
            'image' => $image
        ]);
    }

    public function update(Request $request, Image $image) {
        $newStoragePath = $request->file('image')->store('public');
        $newPublicPath = 'storage/' . explode('/', $newStoragePath)[1];

        Storage::delete($image->storage_path);

        $image->storage_path = $newStoragePath;
        $image->public_path = $newPublicPath;
        $image->save();

        return response()->json([
            'message' => 'Updated!',
            'image' => $image
        ]);
    }
}
