# 🛒 Zona Gadget — Aplikasi Transaksi Toko Sederhana

Aplikasi web manajemen transaksi toko berbasis **Laravel 12** dengan dua role pengguna: **Admin** dan **Customer**. Admin dapat mengelola produk dan melihat semua transaksi, sementara Customer dapat membuat dan melihat riwayat transaksi mereka sendiri.

jika ingin melihat video technical test, klik link berikut: [Video Technical Test](https://drive.google.com/file/d/1kiFJK8-Z6wN1nI0sAZj4f2ADx6OfaOMV/view?usp=sharing)

> **📝 Catatan:** Bagian _views_ (tampilan/UI) pada project ini dibantu pembuatannya menggunakan **Claude AI** (Anthropic) — mencakup seluruh file Blade template, layout, dan desain Tailwind CSS untuk mempercepat proses development.

---

## 📋 Daftar Isi

- [Tech Stack](#-tech-stack)
- [Fitur](#-fitur)
- [Struktur Database](#-struktur-database)
- [Instalasi & Setup](#-instalasi--setup)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Akun Demo](#-akun-demo)
- [Struktur Folder](#-struktur-folder)
- [Screenshot](#-screenshot)
- [Lisensi](#-lisensi)

---

## 🛠 Tech Stack

| Teknologi        | Versi | Keterangan                   |
| ---------------- | ----- | ---------------------------- |
| **PHP**          | ^8.2  | Runtime bahasa pemrograman   |
| **Laravel**      | 12.x  | Framework PHP utama          |
| **MySQL**        | 8.0   | Database populer             |
| **Tailwind CSS** | 4.x   | Utility-first CSS framework  |
| **Vite**         | 7.x   | Build tool & dev server      |
| **Font Awesome** | 6.4   | Ikon UI                      |
| **Inter Font**   | -     | Typography (via Bunny Fonts) |

---

## ✨ Fitur

### 🔐 Autentikasi

- Login dengan username & password
- Role-based access control (Admin / Customer)
- Route protection via middleware

### 👨‍💼 Admin

- **Dashboard** — Ringkasan statistik (total produk, transaksi, pendapatan, pelanggan) dan transaksi terbaru
- **Kelola Produk** — CRUD produk (tambah, lihat, edit, hapus) dengan pagination
- **Lihat Transaksi** — Melihat semua transaksi dari seluruh pelanggan beserta detailnya

### 🛒 Customer

- **Buat Transaksi** — Pilih produk, atur jumlah dengan kontrol +/-, live summary dengan kalkulasi realtime
- **Riwayat Transaksi** — Lihat daftar transaksi pribadi
- **Detail Transaksi** — Lihat item-item dalam setiap transaksi

### 🎨 UI/UX

- Desain modern dengan **Tailwind CSS**
- Sidebar navigasi dengan role-based menu
- Flash message animasi (success/error)
- Responsive layout
- Empty state dengan CTA
- Format mata uang Indonesia (Rp)

---

## 🗄 Struktur Database

```
users
├── id
├── name
├── username (unique)
├── email (unique)
├── password
├── role (admin / customer)
└── timestamps

product
├── id
├── name
├── description
├── price (decimal 10,2)
└── timestamps

transactions
├── id
├── user_id → users.id
├── total_quantity
├── total_price (decimal 12,2)
├── transaction_date
└── timestamps

transactions_items
├── id
├── transaction_id → transactions.id
├── product_id → product.id
├── quantity
├── price (decimal 12,2)
├── subtotal (decimal 12,2)
└── timestamps
```

### Relasi

- `User` → hasMany → `Transaction`
- `Transaction` → belongsTo → `User`
- `Transaction` → hasMany → `TransactionItem`
- `TransactionItem` → belongsTo → `Transaction`
- `TransactionItem` → belongsTo → `Product`
- `Product` → hasMany → `TransactionItem`

---

## 🚀 Instalasi & Setup

### Prasyarat

Pastikan di komputer kamu sudah terinstall:

- **PHP** >= 8.2
- **Composer** (PHP package manager)
- **Node.js** >= 18 & **npm**
- **Git**

### Langkah-langkah

**1. Clone repository**

```bash
git clone <url-repository> ZonaGadget
cd ZonaGadget
```

**2. Install dependensi PHP**

```bash
composer install
```

**3. Salin file environment**

```bash
cp .env.example .env
```

**4. Generate application key**

```bash
php artisan key:generate
```

**5. Buat file database mysql**

**6. Jalankan migrasi database**

```bash
php artisan migrate
```

**7. Jalankan seeder (data dummy)**

```bash
php artisan db:seed
```

> Atau langkah 6 & 7 sekaligus:
>
> ```bash
> php artisan migrate:fresh --seed
> ```

**8. Install dependensi Node.js**

```bash
npm install
```

---

## ▶ Menjalankan Aplikasi

Kamu perlu menjalankan **2 terminal** secara bersamaan:

### Terminal 1 — Laravel Server

```bash
php artisan serve
```

### Terminal 2 — Vite Dev Server (Tailwind CSS)

```bash
npm run dev
```

Atau jalankan semuanya sekaligus dengan satu perintah:

```bash
composer run dev
```

Buka browser dan akses: **http://localhost:8000**

---

## 👤 Akun Demo

Setelah menjalankan seeder, tersedia akun-akun berikut:

| Role         | Username | Password   | Nama         |
| ------------ | -------- | ---------- | ------------ |
| **Admin**    | `admin`  | `password` | Admin Toko   |
| **Customer** | `budi`   | `password` | Budi Santoso |
| **Customer** | `siti`   | `password` | Siti Aminah  |
| **Customer** | `andi`   | `password` | Andi Pratama |

### Data Seeder

| Data              | Jumlah | Keterangan                             |
| ----------------- | ------ | -------------------------------------- |
| Users             | 4      | 1 admin + 3 customer                   |
| Products          | 10     | Produk elektronik & aksesoris komputer |
| Transactions      | 4      | Tersebar di 3 customer                 |
| Transaction Items | 11     | Detail item di setiap transaksi        |

---

## 📁 Struktur Folder

```
ZonaGadget/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminController.php          # Dashboard admin
│   │       ├── AdminTransactionController.php # Admin lihat transaksi
│   │       ├── AuthController.php           # Login
│   │       ├── CustomerTransactionController.php # Customer transaksi
│   │       └── ProductController.php        # CRUD produk
│   └── Models/
│       ├── Product.php
│       ├── Transaction.php
│       ├── TransactionItem.php
│       └── User.php
├── database/
│   ├── migrations/                          # Skema database
│   └── seeders/
│       └── DatabaseSeeder.php               # Data dummy
├── resources/
│   ├── css/
│   │   └── app.css                          # Tailwind entry point
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php                # Master layout + sidebar
│       ├── auth/
│       │   └── login.blade.php              # Halaman login
│       ├── admin/
│       │   ├── dashboard.blade.php          # Dashboard admin
│       │   ├── products/
│       │   │   ├── index.blade.php          # Daftar produk
│       │   │   ├── create.blade.php         # Form tambah produk
│       │   │   └── edit.blade.php           # Form edit produk
│       │   └── transactions/
│       │       ├── index.blade.php          # Semua transaksi
│       │       └── show.blade.php           # Detail transaksi
│       └── customer/
│           └── transactions/
│               ├── index.blade.php          # Riwayat transaksi
│               ├── create.blade.php         # Buat transaksi baru
│               └── show.blade.php           # Detail transaksi
├── routes/
│   └── web.php                              # Routing aplikasi
├── .env.example
├── composer.json
├── package.json
└── vite.config.js
```

---

## 📸 Screenshot

### Halaman Login

Halaman login dengan desain modern — gradient background, glassmorphism card, dan input dengan icon.

### Dashboard Admin

Dashboard dengan 4 kartu statistik (total produk, transaksi, pendapatan, pelanggan) serta tabel transaksi terbaru.

### Manajemen Produk

Tabel produk dengan aksi edit/hapus, pagination, dan empty state.

### Buat Transaksi (Customer)

Halaman checkout interaktif dengan kartu produk, kontrol kuantitas +/-, dan ringkasan belanja realtime.

---

## 🤖 AI-Assisted Development

Bagian **views/UI** pada project ini dibantu pembuatannya menggunakan **Claude AI** (Anthropic), meliputi:

- Seluruh file Blade template (`resources/views/**/*.blade.php`)
- Desain layout dan sidebar navigasi
- Styling dengan Tailwind CSS utility classes
- Interaktivitas JavaScript (live order summary pada halaman checkout)
- Seeder data dummy (`database/seeders/DatabaseSeeder.php`)

Logika backend (Controllers, Models, Migrations, Routing) dibuat secara manual oleh saya (developer).

---
