<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function store(Request $request) {
        $storagePath = Storage::disk('google')->putFile('', $request->file('image'));;
        $productId = $request->input('product-id');

        $image = Image::create([
            'path' => $storagePath,
            'product_id' => $productId
        ]);

        return response()->json([
            'message' => 'Uploaded!',
            'image' => $image
        ]);
    }

    public function update(Request $request, Image $image) {
        $newStoragePath = Storage::disk('google')->putFile('', $request->file('image'));

        Storage::disk('google')->delete($image->path);

        $image->path = $newStoragePath;
        $image->save();

        return response()->json([
            'message' => 'Updated!',
            'image' => $image
        ]);
    }
}
