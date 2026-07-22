<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\ActivityLog;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $categories = Product::distinct('category')->pluck('category');
        
        return view('cashier', compact('products', 'categories'));
    }
    
    public function processTransaction(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0'
        ]);
        
        DB::beginTransaction();
        
        try {
            $total = 0;
            $cartItems = $request->cart;
            
            foreach ($cartItems as $item) {
                $product = Product::find($item['id']);
                $total += $product->price * $item['quantity'];
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi!");
                }
                
                $product->stock -= $item['quantity'];
                $product->save();
            }
            
            $transaction = Transaction::create([
                'transaction_code' => 'TRX-' . date('ymd') . '-' . rand(1000, 9999),
                'total' => $total,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->paid_amount - $total,
                'user_id' => auth()->id()
            ]);
            
            foreach ($cartItems as $item) {
                $product = Product::find($item['id']);
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);
            }
            
            DB::commit();

            $paymentMethod = $request->payment_method ?? 'cash';
            $paymentMethodLabel = strtoupper($paymentMethod);
            
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'Process Transaction',
                'description' => "Memproses transaksi {$transaction->transaction_code} sebesar Rp " . number_format($transaction->total, 0, ',', '.') . " via {$paymentMethodLabel} (Struk tidak dicetak)"
            ]);

            // Load items with product info for the receipt
            $transaction->load('items.product');

            return response()->json([
                'success' => true,
                'transaction' => $transaction,
                'message' => 'Transaksi berhasil'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logPrint($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        $log = ActivityLog::where('action', 'Process Transaction')
            ->where('description', 'like', "%{$transaction->transaction_code}%")
            ->first();
            
        if ($log) {
            $log->description = str_replace('(Struk tidak dicetak)', '(Struk dicetak)', $log->description);
            $log->save();
        } else {
            ActivityLog::create([
                'user_id' => auth()->id() ?: $transaction->user_id,
                'action' => 'Print Receipt',
                'description' => "Mencetak struk untuk transaksi {$transaction->transaction_code}"
            ]);
        }
        
        // Tandai struk sudah dicetak di transaksi
        $transaction->update(['is_printed' => true]);
        
        return response()->json(['success' => true]);
    }
}