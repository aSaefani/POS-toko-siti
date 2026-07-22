<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clean existing data safely (disable FK checks to allow truncate)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Product::truncate();
        Transaction::truncate();
        TransactionItem::truncate();
        ActivityLog::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // =====================
        // USERS
        // =====================
        $admin1 = User::create([
            'name'     => 'Admin Toko Siti',
            'email'    => 'admin@tokositi.com',
            'password' => bcrypt('admin123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Siti (Owner)',
            'email'    => 'siti@tokositi.com',
            'password' => bcrypt('admin123'),
            'role'     => 'admin',
        ]);

        $kasir = User::create([
            'name'     => 'Kasir Toko Siti',
            'email'    => 'kasir@tokositi.com',
            'password' => bcrypt('kasir123'),
            'role'     => 'kasir',
        ]);

        // =====================
        // PRODUCTS (sembako & kebutuhan toko umum)
        // Harga disesuaikan dengan harga eceran normal 2024
        // =====================
        $products = [
            // --- Beras ---
            ['name' => 'Beras Pandan Wangi 5kg',        'sku' => 'BRS001', 'category' => 'Beras',         'price' => 78000,   'stock' => 30],
            ['name' => 'Beras Rojolele 5kg',             'sku' => 'BRS002', 'category' => 'Beras',         'price' => 72000,   'stock' => 25],
            ['name' => 'Beras IR64 10kg',                'sku' => 'BRS003', 'category' => 'Beras',         'price' => 140000,  'stock' => 20],
            ['name' => 'Beras Setra Ramos 5kg',          'sku' => 'BRS004', 'category' => 'Beras',         'price' => 80000,   'stock' => 18],
            ['name' => 'Beras Merah Organik 1kg',        'sku' => 'BRS005', 'category' => 'Beras',         'price' => 22000,   'stock' => 12],

            // --- Minyak & Lemak ---
            ['name' => 'Minyak Goreng Bimoli 2L',        'sku' => 'MNY001', 'category' => 'Minyak',        'price' => 38000,   'stock' => 24],
            ['name' => 'Minyak Goreng Tropical 2L',      'sku' => 'MNY002', 'category' => 'Minyak',        'price' => 36000,   'stock' => 20],
            ['name' => 'Minyak Goreng Filma 1L',         'sku' => 'MNY003', 'category' => 'Minyak',        'price' => 20000,   'stock' => 30],
            ['name' => 'Minyak Kelapa Barco 1L',         'sku' => 'MNY004', 'category' => 'Minyak',        'price' => 24000,   'stock' => 15],
            ['name' => 'Mentega Blue Band 200g',         'sku' => 'MNY005', 'category' => 'Minyak',        'price' => 12000,   'stock' => 20],

            // --- Gula & Pemanis ---
            ['name' => 'Gula Pasir Gulaku 1kg',          'sku' => 'GLA001', 'category' => 'Gula',          'price' => 16000,   'stock' => 4],
            ['name' => 'Gula Pasir Manis 2kg',           'sku' => 'GLA002', 'category' => 'Gula',          'price' => 30000,   'stock' => 20],
            ['name' => 'Gula Merah Aren 250g',           'sku' => 'GLA003', 'category' => 'Gula',          'price' => 8000,    'stock' => 30],
            ['name' => 'Gula Jawa 500g',                 'sku' => 'GLA004', 'category' => 'Gula',          'price' => 14000,   'stock' => 25],

            // --- Mie & Pasta ---
            ['name' => 'Indomie Goreng Spesial',         'sku' => 'MIE001', 'category' => 'Mie Instan',    'price' => 3500,    'stock' => 120],
            ['name' => 'Indomie Soto Ayam',              'sku' => 'MIE002', 'category' => 'Mie Instan',    'price' => 3500,    'stock' => 100],
            ['name' => 'Mie Sedaap Goreng',              'sku' => 'MIE003', 'category' => 'Mie Instan',    'price' => 3200,    'stock' => 80],
            ['name' => 'Supermi Soto',                   'sku' => 'MIE004', 'category' => 'Mie Instan',    'price' => 3000,    'stock' => 60],
            ['name' => 'Indomie Kuah Ayam Bawang',       'sku' => 'MIE005', 'category' => 'Mie Instan',    'price' => 3500,    'stock' => 100],

            // --- Tepung & Bahan Kue ---
            ['name' => 'Tepung Terigu Segitiga Biru 1kg','sku' => 'TPG001', 'category' => 'Tepung',        'price' => 13000,   'stock' => 30],
            ['name' => 'Tepung Terigu Kunci Biru 1kg',   'sku' => 'TPG002', 'category' => 'Tepung',        'price' => 12000,   'stock' => 25],
            ['name' => 'Tepung Beras Rose Brand 500g',   'sku' => 'TPG003', 'category' => 'Tepung',        'price' => 10000,   'stock' => 20],
            ['name' => 'Tepung Maizena 250g',            'sku' => 'TPG004', 'category' => 'Tepung',        'price' => 8000,    'stock' => 20],
            ['name' => 'Baking Powder Koepoe-Koepoe',    'sku' => 'TPG005', 'category' => 'Tepung',        'price' => 6000,    'stock' => 15],

            // --- Bumbu & Rempah ---
            ['name' => 'Garam Refina 500g',              'sku' => 'BMB001', 'category' => 'Bumbu',         'price' => 4500,    'stock' => 40],
            ['name' => 'Merica Bubuk Lada Putih 50g',    'sku' => 'BMB002', 'category' => 'Bumbu',         'price' => 9000,    'stock' => 30],
            ['name' => 'Kecap Manis ABC 135ml',          'sku' => 'BMB003', 'category' => 'Bumbu',         'price' => 9500,    'stock' => 40],
            ['name' => 'Kecap Manis Bango 135ml',        'sku' => 'BMB004', 'category' => 'Bumbu',         'price' => 10000,   'stock' => 35],
            ['name' => 'Saos Tomat Indofood 140ml',      'sku' => 'BMB005', 'category' => 'Bumbu',         'price' => 8000,    'stock' => 30],
            ['name' => 'Saos Sambal ABC 140ml',          'sku' => 'BMB006', 'category' => 'Bumbu',         'price' => 8500,    'stock' => 30],
            ['name' => 'Penyedap Rasa Royco Ayam 100g',  'sku' => 'BMB007', 'category' => 'Bumbu',         'price' => 7000,    'stock' => 50],
            ['name' => 'Penyedap Masako Sapi 100g',      'sku' => 'BMB008', 'category' => 'Bumbu',         'price' => 7000,    'stock' => 50],
            ['name' => 'Santan Kara 200ml',              'sku' => 'BMB009', 'category' => 'Bumbu',         'price' => 9000,    'stock' => 25],
            ['name' => 'Terasi ABC 50g',                 'sku' => 'BMB010', 'category' => 'Bumbu',         'price' => 5000,    'stock' => 20],

            // --- Minuman ---
            ['name' => 'Teh Celup Sariwangi 25s',        'sku' => 'MNM001', 'category' => 'Minuman',       'price' => 10000,   'stock' => 50],
            ['name' => 'Kopi Kapal Api 165g',            'sku' => 'MNM002', 'category' => 'Minuman',       'price' => 20000,   'stock' => 35],
            ['name' => 'Kopi Nescafe Classic 50g',       'sku' => 'MNM003', 'category' => 'Minuman',       'price' => 22000,   'stock' => 25],
            ['name' => 'Susu Indomilk Full Cream 1L',    'sku' => 'MNM004', 'category' => 'Minuman',       'price' => 18500,   'stock' => 20],
            ['name' => 'Susu Kental Manis Frisian Flag', 'sku' => 'MNM005', 'category' => 'Minuman',       'price' => 13000,   'stock' => 30],
            ['name' => 'Minuman Serbuk Nutrisari 10s',   'sku' => 'MNM006', 'category' => 'Minuman',       'price' => 12000,   'stock' => 40],

            // --- Rokok ---
            ['name' => 'Rokok Gudang Garam Merah 12s',   'sku' => 'RKK001', 'category' => 'Rokok',         'price' => 22000,   'stock' => 60],
            ['name' => 'Rokok Djarum Super 12s',         'sku' => 'RKK002', 'category' => 'Rokok',         'price' => 23000,   'stock' => 50],
            ['name' => 'Rokok Sampoerna Mild 16s',       'sku' => 'RKK003', 'category' => 'Rokok',         'price' => 31000,   'stock' => 45],
            ['name' => 'Rokok Marlboro Red 20s',         'sku' => 'RKK004', 'category' => 'Rokok',         'price' => 39000,   'stock' => 30],

            // --- Sabun & Kebersihan ---
            ['name' => 'Sabun Mandi Lifebuoy 85g',       'sku' => 'SBN001', 'category' => 'Kebersihan',    'price' => 5000,    'stock' => 50],
            ['name' => 'Sabun Cuci Sunlight 400ml',      'sku' => 'SBN002', 'category' => 'Kebersihan',    'price' => 13000,   'stock' => 30],
            ['name' => 'Deterjen Rinso 800g',            'sku' => 'SBN003', 'category' => 'Kebersihan',    'price' => 22000,   'stock' => 25],
            ['name' => 'Deterjen Attack Bubuk 800g',     'sku' => 'SBN004', 'category' => 'Kebersihan',    'price' => 20000,   'stock' => 20],
            ['name' => 'Sampo Pantene 180ml',            'sku' => 'SBN005', 'category' => 'Kebersihan',    'price' => 23000,   'stock' => 20],
            ['name' => 'Sampo Sunsilk 170ml',            'sku' => 'SBN006', 'category' => 'Kebersihan',    'price' => 20000,   'stock' => 18],
            ['name' => 'Pasta Gigi Pepsodent 190g',      'sku' => 'SBN007', 'category' => 'Kebersihan',    'price' => 15000,   'stock' => 30],
            ['name' => 'Sikat Gigi Formula 1pc',         'sku' => 'SBN008', 'category' => 'Kebersihan',    'price' => 7000,    'stock' => 25],

            // --- Makanan Ringan & Snack ---
            ['name' => 'Chiki Balls Keju 55g',           'sku' => 'SNK001', 'category' => 'Snack',         'price' => 5000,    'stock' => 60],
            ['name' => 'Pringles Sour Cream 107g',       'sku' => 'SNK002', 'category' => 'Snack',         'price' => 30000,   'stock' => 20],
            ['name' => 'Oreo 137g',                      'sku' => 'SNK003', 'category' => 'Snack',         'price' => 16000,   'stock' => 30],
            ['name' => 'Biscuit Roma Marie 400g',        'sku' => 'SNK004', 'category' => 'Snack',         'price' => 18000,   'stock' => 25],
            ['name' => 'Wafer Tango Coklat 176g',        'sku' => 'SNK005', 'category' => 'Snack',         'price' => 16000,   'stock' => 25],

            // --- Telur & Protein ---
            ['name' => 'Telur Ayam Kampung 1kg',         'sku' => 'TLR001', 'category' => 'Telur & Protein','price' => 33000,  'stock' => 20],
            ['name' => 'Telur Ayam Ras 1kg',             'sku' => 'TLR002', 'category' => 'Telur & Protein','price' => 29000,  'stock' => 30],
            ['name' => 'Ikan Teri Nasi 100g',            'sku' => 'TLR003', 'category' => 'Telur & Protein','price' => 15000,  'stock' => 20],
            ['name' => 'Udang Kering 100g',              'sku' => 'TLR004', 'category' => 'Telur & Protein','price' => 20000,  'stock' => 15],

            // --- Gas & Energi ---
            ['name' => 'LPG 3kg (Tabung)',               'sku' => 'GAS001', 'category' => 'Gas & Energi',  'price' => 22000,   'stock' => 10],

            // --- Lain-lain ---
            ['name' => 'Plastik Kresek Hitam 1kg',       'sku' => 'LLN001', 'category' => 'Lain-lain',     'price' => 20000,   'stock' => 15],
            ['name' => 'Korek Api Gas Ronson',            'sku' => 'LLN002', 'category' => 'Lain-lain',     'price' => 12000,   'stock' => 20],
            ['name' => 'Lilin Lebah 100g',               'sku' => 'LLN003', 'category' => 'Lain-lain',     'price' => 8000,    'stock' => 15],
            ['name' => 'Tisu Paseo 250 Sheet',           'sku' => 'LLN004', 'category' => 'Lain-lain',     'price' => 17000,   'stock' => 25],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Ambil beberapa produk untuk transaksi sampel
        $p1 = Product::where('sku', 'BRS001')->first();
        $p2 = Product::where('sku', 'MNY001')->first();
        $p3 = Product::where('sku', 'GLA001')->first();

        // =====================
        // TRANSAKSI SAMPEL
        // =====================
        $t1 = Transaction::create([
            'transaction_code' => 'TRX-' . date('Ymd') . '-A1B2C3',
            'total'            => 132000,
            'paid_amount'      => 150000,
            'change_amount'    => 18000,
            'user_id'          => $kasir->id,
            'created_at'       => now()->subHours(2),
        ]);

        TransactionItem::create(['transaction_id' => $t1->id, 'product_id' => $p1->id, 'quantity' => 1, 'price' => 78000]);
        TransactionItem::create(['transaction_id' => $t1->id, 'product_id' => $p2->id, 'quantity' => 1, 'price' => 38000]);
        TransactionItem::create(['transaction_id' => $t1->id, 'product_id' => $p3->id, 'quantity' => 1, 'price' => 16000]);

        // =====================
        // ACTIVITY LOGS SAMPEL
        // =====================
        ActivityLog::create([
            'user_id'     => $admin1->id,
            'action'      => 'Add Product',
            'description' => "Menambahkan produk baru 'Beras Pandan Wangi 5kg' (SKU: BRS001).",
            'created_at'  => now()->subHours(4),
        ]);

        ActivityLog::create([
            'user_id'     => $admin1->id,
            'action'      => 'Update Stock',
            'description' => "Memperbarui stok 'Gula Pasir Gulaku 1kg' menjadi 4.",
            'created_at'  => now()->subHours(3),
        ]);

        ActivityLog::create([
            'user_id'     => $kasir->id,
            'action'      => 'Process Transaction',
            'description' => "Memproses transaksi {$t1->transaction_code} total Rp 132.000",
            'created_at'  => now()->subHours(2),
        ]);
    }
}
