<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\kategori;
use App\Models\status;
use App\Models\produk;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name'=>'admin',
            'email'=>'admin@example.com',
            'password'=>bcrypt('password'),
        ]);
        kategori::create(['id_kategori'=>'1', 'nama_kategori'=>'L QUEENLY']);
        kategori::create(['id_kategori'=>'2', 'nama_kategori'=>'L MTH AKSESORIS (IM)']);
        kategori::create(['id_kategori'=>'3', 'nama_kategori'=>'L MTH TABUNG (LK)']);
        kategori::create(['id_kategori'=>'4', 'nama_kategori'=>'SP MTH SPAREPART (LK)']);
        kategori::create(['id_kategori'=>'5', 'nama_kategori'=>'CI MTH TINTA LAIN (IM)']);
        kategori::create(['id_kategori'=>'6', 'nama_kategori'=>'L MTH AKSESORIS (LK)']);
        kategori::create(['id_kategori'=>'7', 'nama_kategori'=>'S MTH STEMPEL (IM)']);
        status::create(['id_status'=>'1','nama_status'=>'Bisa Dijual']);
        status::create(['id_status'=>'2','nama_status'=>'Tidak Bisa Dijual']);
        produk::create(['nama_produk'=>'ALCOHOL GEL POLISH CLEANSER GP-CLN01','kategori_id'=>'1','harga'=>'12500','status_id'=>'1']);
        produk::create(['nama_produk'=>'ALUMUNIUM FOIL ALL IN ONE BULAT 23mm IM','kategori_id'=>'2','harga'=>'1000','status_id'=>'1']);
        produk::create(['nama_produk'=>'ALUMUNIUM FOIL ALL IN ONE BULAT 30mm IM','kategori_id'=>'2','harga'=>'1000','status_id'=>'1']);
        produk::create(['nama_produk'=>'ALUMUNIUM FOIL ALL IN ONE SHEET 250mm IM','kategori_id'=>'2','harga'=>'12500','status_id'=>'2']);
        produk::create(['nama_produk'=>'ALUMUNIUM FOIL HDPE/PE BULAT 23mm IM','kategori_id'=>'2','harga'=>'12500','status_id'=>'1']);
        produk::create(['nama_produk'=>'ALUMUNIUM FOIL HDPE/PE BULAT 30mm IM','kategori_id'=>'2','harga'=>'1000','status_id'=>'1']);
        produk::create(['nama_produk'=>'ALUMUNIUM FOIL HDPE/PE SHEET 250mm IM','kategori_id'=>'2','harga'=>'13000','status_id'=>'2']);
        produk::create(['nama_produk'=>'ALUMUNIUM FOIL PET SHEET 250mm IM','kategori_id'=>'2','harga'=>'1000','status_id'=>'2']);
        produk::create(['nama_produk'=>'ARM PENDEK MODEL U','kategori_id'=>'2','harga'=>'13000','status_id'=>'1']);
        produk::create(['nama_produk'=>'ARM SUPPORT KECIL','kategori_id'=>'3','harga'=>'13000','status_id'=>'2']);
        produk::create(['nama_produk'=>'ARM SUPPORT KOTAK PUTIH','kategori_id'=>'2','harga'=>'13000','status_id'=>'2']);
        produk::create(['nama_produk'=>'ARM SUPPORT PENDEK POLOS','kategori_id'=>'3','harga'=>'13000','status_id'=>'1']);
        produk::create(['nama_produk'=>'ARM SUPPORT S IM','kategori_id'=>'2','harga'=>'1000','status_id'=>'2']);
        produk::create(['nama_produk'=>'ARM SUPPORT T (IMPORT)','kategori_id'=>'2','harga'=>'13000','status_id'=>'1']);
        produk::create(['nama_produk'=>'ARM SUPPORT T - MODEL 1 ( LOKAL )','kategori_id'=>'3','harga'=>'10000','status_id'=>'1']);
        produk::create(['nama_produk'=>'BLACK LASER TONER FP-T3 (100gr)','kategori_id'=>'2','harga'=>'13000','status_id'=>'2']);
        produk::create(['nama_produk'=>'BODY PRINTER CANON IP2770','kategori_id'=>'4','harga'=>'500','status_id'=>'1']);
        produk::create(['nama_produk'=>'BODY PRINTER T13X','kategori_id'=>'4','harga'=>'15000','status_id'=>'1']);
        produk::create(['nama_produk'=>'BOTOL 1000ML BLUE KHUSUS UNTUK EPSON R1800/R800 - 4180 IM (T054920)','kategori_id'=>'5','harga'=>'10000','status_id'=>'1']);
        produk::create(['nama_produk'=>'BOTOL 1000ML CYAN KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4120 IM (T054220)','kategori_id'=>'5','harga'=>'10000','status_id'=>'2']);
        produk::create(['nama_produk'=>'BOTOL 1000ML GLOSS OPTIMIZER KHUSUS UNTUK EPSON R1800/R800/R1900/R2000/IX7000/MG6170 - 4100 IM (T054020)','kategori_id'=>'5','harga'=>'1500','status_id'=>'1']);
        produk::create(['nama_produk'=>'BOTOL 1000ML L.LIGHT BLACK KHUSUS UNTUK EPSON 2400 - 0599 IM','kategori_id'=>'5','harga'=>'1500','status_id'=>'2']);
        produk::create(['nama_produk'=>'BOTOL 1000ML LIGHT BLACK KHUSUS UNTUK EPSON 2400 - 0597 IM','kategori_id'=>'5','harga'=>'1500','status_id'=>'2']);
        produk::create(['nama_produk'=>'BOTOL 1000ML MAGENTA KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4140 IM (T054320)','kategori_id'=>'5','harga'=>'1000','status_id'=>'1']);
        produk::create(['nama_produk'=>'BOTOL 1000ML MATTE BLACK KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 3503 IM (T054820)','kategori_id'=>'5','harga'=>'1500','status_id'=>'2']);
        produk::create(['nama_produk'=>'BOTOL 1000ML ORANGE KHUSUS UNTUK EPSON R1900/R2000 IM - 4190 (T087920)','kategori_id'=>'5','harga'=>'1500','status_id'=>'1']);
        produk::create(['nama_produk'=>'BOTOL 1000ML RED KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4170 IM (T054720)','kategori_id'=>'5','harga'=>'1000','status_id'=>'2']);
        produk::create(['nama_produk'=>'BOTOL 1000ML YELLOW KHUSUS UNTUK EPSON R1800/R800/R1900/R2000 - 4160 IM (T054420)','kategori_id'=>'5','harga'=>'1500','status_id'=>'2']);
        produk::create(['nama_produk'=>'BOTOL KOTAK 100ML LK','kategori_id'=>'6','harga'=>'1000','status_id'=>'1']);
        produk::create(['nama_produk'=>'BOTOL 10ML IM','kategori_id'=>'7','harga'=>'1000','status_id'=>'2']);
    }
}