<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ============================
        // 1. USERS
        // ============================
        $admin = User::create([
            'name'     => 'Admin Toko',
            'username' => 'admin',
            'email'    => 'admin@tokoapp.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        $customer1 = User::create([
            'name'     => 'Budi Santoso',
            'username' => 'budi',
            'email'    => 'budi@mail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
        ]);

        $customer2 = User::create([
            'name'     => 'Siti Aminah',
            'username' => 'siti',
            'email'    => 'siti@mail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
        ]);

        $customer3 = User::create([
            'name'     => 'Andi Pratama',
            'username' => 'andi',
            'email'    => 'andi@mail.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
        ]);

        // ============================
        // 2. PRODUCTS
        // ============================
        $products = collect([
            Product::create([
                'name'        => 'Laptop ASUS VivoBook 14',
                'description' => 'Laptop ringan dengan prosesor Intel Core i5, RAM 8GB, SSD 512GB. Cocok untuk kerja dan kuliah.',
                'price'       => 8500000,
            ]),
            Product::create([
                'name'        => 'Mouse Logitech M331',
                'description' => 'Mouse wireless silent click. Nyaman digunakan berjam-jam tanpa suara klik yang mengganggu.',
                'price'       => 250000,
            ]),
            Product::create([
                'name'        => 'Keyboard Mechanical Rexus',
                'description' => 'Keyboard mekanikal dengan switch blue, RGB lighting, dan build quality premium.',
                'price'       => 450000,
            ]),
            Product::create([
                'name'        => 'Monitor LG 24 inch IPS',
                'description' => 'Monitor Full HD IPS 75Hz dengan warna akurat, ideal untuk desain grafis dan multitasking.',
                'price'       => 2100000,
            ]),
            Product::create([
                'name'        => 'Headset HyperX Cloud II',
                'description' => 'Headset gaming 7.1 surround sound dengan mikrofon detachable. Kenyamanan maksimal.',
                'price'       => 950000,
            ]),
            Product::create([
                'name'        => 'SSD Samsung 1TB',
                'description' => 'SSD NVMe M.2 dengan kecepatan baca hingga 3500MB/s. Upgrade storage laptop Anda.',
                'price'       => 1350000,
            ]),
            Product::create([
                'name'        => 'Webcam Logitech C920',
                'description' => 'Webcam Full HD 1080p dengan autofocus dan dual stereo mic. Untuk meeting online.',
                'price'       => 1200000,
            ]),
            Product::create([
                'name'        => 'USB Hub Anker 7-in-1',
                'description' => 'USB-C hub dengan HDMI, USB 3.0, SD card reader, dan power delivery 100W.',
                'price'       => 650000,
            ]),
            Product::create([
                'name'        => 'Tas Laptop Targus 15.6"',
                'description' => 'Tas laptop anti air dengan bantalan tebal, kompartemen organizer, dan tali bahu empuk.',
                'price'       => 380000,
            ]),
            Product::create([
                'name'        => 'Mousepad Desk Mat XL',
                'description' => 'Mousepad besar 80x30cm bahan premium, anti slip, mudah dibersihkan.',
                'price'       => 120000,
            ]),
        ]);

        // ============================
        // 3. TRANSACTIONS
        // ============================

        // Transaction 1 — Budi beli laptop + mouse + mousepad
        $trx1 = Transaction::create([
            'user_id'          => $customer1->id,
            'total_quantity'   => 3,
            'total_price'      => 8870000,
            'transaction_date' => now()->subDays(5),
        ]);
        TransactionItem::create([
            'transaction_id' => $trx1->id,
            'product_id'     => $products[0]->id, // Laptop
            'quantity'        => 1,
            'price'           => 8500000,
            'subtotal'        => 8500000,
        ]);
        TransactionItem::create([
            'transaction_id' => $trx1->id,
            'product_id'     => $products[1]->id, // Mouse
            'quantity'        => 1,
            'price'           => 250000,
            'subtotal'        => 250000,
        ]);
        TransactionItem::create([
            'transaction_id' => $trx1->id,
            'product_id'     => $products[9]->id, // Mousepad
            'quantity'        => 1,
            'price'           => 120000,
            'subtotal'        => 120000,
        ]);

        // Transaction 2 — Siti beli keyboard + headset + webcam
        $trx2 = Transaction::create([
            'user_id'          => $customer2->id,
            'total_quantity'   => 3,
            'total_price'      => 2600000,
            'transaction_date' => now()->subDays(3),
        ]);
        TransactionItem::create([
            'transaction_id' => $trx2->id,
            'product_id'     => $products[2]->id, // Keyboard
            'quantity'        => 1,
            'price'           => 450000,
            'subtotal'        => 450000,
        ]);
        TransactionItem::create([
            'transaction_id' => $trx2->id,
            'product_id'     => $products[4]->id, // Headset
            'quantity'        => 1,
            'price'           => 950000,
            'subtotal'        => 950000,
        ]);
        TransactionItem::create([
            'transaction_id' => $trx2->id,
            'product_id'     => $products[6]->id, // Webcam
            'quantity'        => 1,
            'price'           => 1200000,
            'subtotal'        => 1200000,
        ]);

        // Transaction 3 — Andi beli monitor + SSD + USB Hub
        $trx3 = Transaction::create([
            'user_id'          => $customer3->id,
            'total_quantity'   => 4,
            'total_price'      => 5450000,
            'transaction_date' => now()->subDays(1),
        ]);
        TransactionItem::create([
            'transaction_id' => $trx3->id,
            'product_id'     => $products[3]->id, // Monitor
            'quantity'        => 1,
            'price'           => 2100000,
            'subtotal'        => 2100000,
        ]);
        TransactionItem::create([
            'transaction_id' => $trx3->id,
            'product_id'     => $products[5]->id, // SSD
            'quantity'        => 2,
            'price'           => 1350000,
            'subtotal'        => 2700000,
        ]);
        TransactionItem::create([
            'transaction_id' => $trx3->id,
            'product_id'     => $products[7]->id, // USB Hub
            'quantity'        => 1,
            'price'           => 650000,
            'subtotal'        => 650000,
        ]);

        // Transaction 4 — Budi beli headset + tas
        $trx4 = Transaction::create([
            'user_id'          => $customer1->id,
            'total_quantity'   => 2,
            'total_price'      => 1330000,
            'transaction_date' => now(),
        ]);
        TransactionItem::create([
            'transaction_id' => $trx4->id,
            'product_id'     => $products[4]->id, // Headset
            'quantity'        => 1,
            'price'           => 950000,
            'subtotal'        => 950000,
        ]);
        TransactionItem::create([
            'transaction_id' => $trx4->id,
            'product_id'     => $products[8]->id, // Tas
            'quantity'        => 1,
            'price'           => 380000,
            'subtotal'        => 380000,
        ]);

        $this->command->info('✅ Seeder berhasil! Data yang dibuat:');
        $this->command->info('   👤 4 Users (1 admin + 3 customer) — password: "password"');
        $this->command->info('   📦 10 Products');
        $this->command->info('   🧾 4 Transactions dengan items');
        $this->command->info('');
        $this->command->info('   Login Admin : username "admin", password "password"');
        $this->command->info('   Login Customer : username "budi"/"siti"/"andi", password "password"');
    }
}
