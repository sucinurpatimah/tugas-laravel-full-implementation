<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.admin.index', compact('products'));
    }

    //addProduct
    public function addProduct()
    {
        return view('dashboard.admin.add');
    }

    // store product
    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kondisi' => 'required|in:Bekas,Baru',
            'deskripsi' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.admin.add')
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('storage/admin', $fileName);

        Product::create([
            'user_id' => Auth::user()->id,
            'image' => '/storage/admin/' . $fileName,
            'name' => $request->nama,
            'weight' => $request->berat,
            'price' => $request->harga,
            'condition' => $request->kondisi,
            'stock' => $request->stok,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route('dashboard.admin.index')->with('success', 'Product added successfully');
    }

    // edit product
    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('dashboard.admin.edit', compact('product'));
    }

    // update product
    public function updateProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kondisi' => 'required|in:Bekas,Baru',
            'deskripsi' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.admin.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/products', $fileName);

            $imagePath = public_path($product->image);
            if (file_exists($imagePath))
                unlink($imagePath);

            $product->image = '/storage/admin/' . $fileName;
        }

        $product->name = $request->nama;
        $product->weight = $request->berat;
        $product->price = $request->harga;
        $product->condition = $request->kondisi;
        $product->stock = $request->stok;
        $product->description = $request->deskripsi;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // delete product
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        // delete image
        $imagePath = public_path($product->image);
        if (file_exists($imagePath))
            unlink($imagePath);

        return redirect()->route('dashboard.admin.index')->with('success', 'Product deleted successfully');
    }
}
