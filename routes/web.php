<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Product;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/catalogue', function() {
    $products = Product::all();

    return view('catalogue', [
        'products' => $products
    ]);
});
Route::get('/cart', [ProductController::class, 'cartView'])->name('product.cart');
Route::post('/catalogue/{product}/cart', [ProductController::class, 'addToCart'])->name('product.store-cart');
Route::delete('/catalogue/{product}/cart', [ProductController::class, 'removeCart'])->name('product.delete-cart');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('product.checkout');
Route::post('/checkout', [ProductController::class, 'order'])->name('product.order');
Route::get('/orders/{id}', [ProductController::class, 'orderDetail'])->name('product.order-detail');
Route::post('/orders/{id}/success', [ProductController::class, 'paymentSuccess'])->name('product.payment-success');

Route::get('/admin', [ProductController::class, 'index'])->middleware('auth');
Route::post('/admin/add-product', [ProductController::class, 'store']);
Route::post('/admin/edit-product/{product}', [ProductController::class, 'update']);
Route::get('/admin/delete-product/{product}', [ProductController::class, 'destroy']);

Route::post('/admin/upload-image', [ImageController::class, 'store']);
Route::post('/admin/edit-image/{id}', [ImageController::class, 'update']);

Route::get('/admin/login', function() {
    return view('admin.login');
})->name('login');
Route::post('/admin/login', function(Request $request) {
    if (Illuminate\Support\Facades\Auth::attempt($request->only(['email', 'password']), $request->input('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/admin');
    }
    return back()->with('error', [
        'message' => 'Invalid credentials'
    ])->withInput();
});

Route::get('/image/{path}', function($path) {
    $img = \Illuminate\Support\Facades\Storage::disk('google')->get($path);
    $ext = explode('.', $path)[1];
    return response($img)->header('Content-type', 'image/' . $ext);
});