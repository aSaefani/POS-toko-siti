<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Total penjualan hari ini
        $todaySales = Transaction::whereDate('created_at', today())->sum('total');
        
        // Jumlah transaksi hari ini
        $todayTransactions = Transaction::whereDate('created_at', today())->count();
        
        // Total produk
        $totalProducts = Product::count();
        
        // Low stock products
        $lowStockProducts = Product::where('stock', '<=', 5)->count();
        
        // Transaksi terakhir
        $recentTransactions = Transaction::with('items.product')
            ->withCount('items')
            ->latest()
            ->take(5)
            ->get();
        
        // Produk hampir habis
        $nearOutOfStock = Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->get();
        
        // ==========================================
        // DATA CHART UNTUK HARI INI (PER JAM)
        // ==========================================
        $chartDataToday = [];
        for ($hour = 6; $hour <= 22; $hour++) {
            $total = Transaction::whereDate('created_at', today())
                ->whereTime('created_at', '>=', sprintf('%02d:00:00', $hour))
                ->whereTime('created_at', '<', sprintf('%02d:00:00', $hour + 1))
                ->sum('total');
            $chartDataToday[] = [
                'hour' => $hour,
                'total' => $total
            ];
        }
        
        // ==========================================
        // DATA CHART UNTUK BULAN INI (PER MINGGU)
        // ==========================================
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        $chartDataThisMonth = [];
        $weeksInMonth = ceil(now()->daysInMonth / 7);
        for ($week = 1; $week <= $weeksInMonth; $week++) {
            $startDay = ($week - 1) * 7 + 1;
            $endDay = min($week * 7, now()->daysInMonth);
            
            $total = Transaction::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->whereDay('created_at', '>=', $startDay)
                ->whereDay('created_at', '<=', $endDay)
                ->sum('total');
            
            $chartDataThisMonth[] = [
                'week' => $week,
                'total' => $total
            ];
        }
        
        // ==========================================
        // DATA CHART UNTUK TAHUN INI (PER BULAN)
        // ==========================================
        $chartDataThisYear = [];
        for ($month = 1; $month <= 12; $month++) {
            $total = Transaction::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->sum('total');
            
            $chartDataThisYear[] = [
                'month' => $month,
                'total' => $total
            ];
        }
        
        $allTransactions = Transaction::with('items')
            ->withCount('items')
            ->orderBy('created_at', 'desc')
            ->get();

        $activityLogs = \App\Models\ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'todaySales', 
            'todayTransactions', 
            'totalProducts', 
            'lowStockProducts', 
            'recentTransactions', 
            'nearOutOfStock',
            'chartDataToday',
            'chartDataThisMonth',
            'chartDataThisYear',
            'allTransactions',
            'activityLogs'
        ));
    }
    
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);
        
        $product = Product::findOrFail($id);
        $product->update(['stock' => $request->stock]);
        
        return response()->json(['message' => 'Stock updated successfully', 'product' => $product]);
    }

    public function exportCsv()
    {
        $transactions = Transaction::with('items.product')->latest()->get();
        $filename = "laporan-transaksi-" . date('Y-m-d') . ".csv";
        
        $handle = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // CSV Header
        fputcsv($handle, ['ID Transaksi', 'Kode', 'Waktu', 'Metode', 'Total', 'Item']);
        
        foreach ($transactions as $t) {
            $itemsString = $t->items->map(function($item) {
                return $item->product->name . " (" . $item->quantity . ")";
            })->implode(', ');
            
            fputcsv($handle, [
                $t->id,
                $t->transaction_code,
                $t->created_at,
                'TUNAI',
                $t->total,
                $itemsString
            ]);
        }
        
        fclose($handle);

        return exit;
    }
}