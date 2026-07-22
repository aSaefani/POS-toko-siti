<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $trashedProducts = Product::onlyTrashed()->orderBy('name')->get();
        $totalItems = Product::count();
        $lowStockAlerts = Product::where('stock', '<=', 5)->count();
        $categoriesCount = Product::distinct('category')->count('category');
        $categoryNames = Product::distinct('category')->pluck('category');
        
        return view('inventory', compact('products', 'trashedProducts', 'totalItems', 'lowStockAlerts', 'categoriesCount', 'categoryNames'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Restore Product',
            'description' => "Product '{$product->name}' restored."
        ]);
        return response()->json(['message' => 'Product restored']);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }
        
        $product = Product::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Add Product',
            'description' => "Added new product '{$product->name}' (SKU: {$product->sku})."
        ]);

        return response()->json($product, 201);
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_url) {
                $oldPath = str_replace('/storage/', '', $product->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }
        
        $product->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Product',
            'description' => "Updated product '{$product->name}' (SKU: {$product->sku})."
        ]);

        return response()->json($product);
    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $productName = $product->name;
        
        try {
            $product->delete();
            
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Delete Product',
                'description' => "Deleted product '{$productName}'."
            ]);
            
            return response()->json(['success' => true, 'message' => 'Product deleted']);
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for foreign key constraint violation
            if ($e->getCode() == "23000") {
                return response()->json([
                    'success' => false, 
                    'message' => 'Produk tidak dapat dihapus karena masih terkait dengan data transaksi riwayat penjualan.'
                ], 400);
            }
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan saat menghapus produk.'
            ], 500);
        }
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate(['stock' => 'required|integer|min:0']);
        $product = Product::findOrFail($id);
        $product->update(['stock' => $request->stock]);
        
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Stock',
            'description' => "Manually updated stock for '{$product->name}' to {$request->stock}."
        ]);
        
        return response()->json($product);
    }
}