Ini adalah aplikasi kalkulator kuadrat sederhana beserta pengujiannya (unit test & feature test) yang dibuat untuk memenuhi tugas mata kuliah Testing dan Implementasi Sistem Informasi.

Cara Menggunakan
1. Masuk ke halaman kalkulator melalui route: `/square-calculator`
2. Masukkan angka (bisa positif, negatif, atau desimal) pada input field
3. Klik tombol "Hitung Kuadrat" untuk melihat hasil
4. Gunakan tombol "Reset" untuk menghapus input dan hasil

Menjalankan Test

Hanya unit test
php artisan test --filter=SquareCalculatorHelperTest

Hanya feature test
php artisan test --filter=SquareCalculatorFeatureTest

