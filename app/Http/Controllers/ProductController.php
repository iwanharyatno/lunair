<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Created successfully!',
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json([
            'message' => 'Update success!',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('google')->delete($product->image->path);

        $product->delete();

        return response()->json([
            'message' => 'Deleted successfully!'
        ]);
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = $request->cookie('my_cart');

        try {
            $cartArray = collect(json_decode($cart));
        } catch (Exception $e) {
            $cartArray = collect([]);
        }

        $exist = $cartArray->where('product_id', $product->id)->first();

        if (!$exist) {
            $cartArray->add([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->image ? $product->image->path : null,
                'qty' => $request->qty,
                'subtotal' => $product->price * $request->qty
            ]);
        } else {
            $itemIndex = $cartArray->search(function ($item) use ($product) {
                return $item->product_id == $product->id;
            });
            $cartArray = json_decode($cart);
            $cartArray[$itemIndex]->qty += $request->qty;
            $cartArray[$itemIndex]->subtotal = $cartArray[$itemIndex]->qty * $cartArray[$itemIndex]->product_price;

            $cartArray = collect($cartArray);
        }

        return redirect()->route('product.cart')->withCookie('my_cart', json_encode($cartArray), 60);
    }

    public function cartView(Request $request) {
        $myCart = $request->cookie('my_cart');
        $cart = collect([]);

        if ($myCart) {
            try {
                $cart = collect(json_decode($myCart));
            } catch (Exception $e) {
                $cart = collect([]);
            }
        }

        $total = $cart->sum('subtotal');

        return view('cart', compact('cart', 'total'));
    }

    public function removeCart(Request $request, $productId) {
        $myCart = $request->cookie('my_cart');
        $cart = collect([]);

        if ($myCart) {
            try {
                $cart = collect(json_decode($myCart));
            } catch (Exception $e) {
                $cart = collect([]);
            }
        }

        $cart = $cart->whereNotIn('product_id', [$productId])->all();

        return back()->withCookie('my_cart', json_encode($cart), 60);
    }

    public function checkout(Request $request) {
        $myCart = $request->cookie('my_cart');
        $cart = collect([]);

        if ($myCart) {
            try {
                $cart = collect(json_decode($myCart));
            } catch (Exception $e) {
                $cart = collect([]);
            }
        }

        $total = $cart->sum('subtotal');

        return view('checkout', compact('cart', 'total'));
    }

    public function order(Request $request) {
        $myCart = $request->cookie('my_cart');
        $cart = collect([]);

        if ($myCart) {
            try {
                $cart = collect(json_decode($myCart));
            } catch (Exception $e) {
                $cart = collect([]);
            }
        } else {
            return redirect()->route('product.cart');
        }

        $total = $cart->sum('subtotal');

        $order = Order::create([
            'total' => $total
        ]);

        $details = [];

        foreach ($cart as $item) {
            $details[] = [
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_price' => $item->product_price,
                'qty' => $item->qty,
                'subtotal' => $item->subtotal
            ];
        }

        OrderDetail::insert($details);

        return back()->withCookie('my_cart', '', -1);
    }
}
