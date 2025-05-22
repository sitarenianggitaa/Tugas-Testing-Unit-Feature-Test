<?php

namespace Tests\Feature;

use Tests\TestCase;

class SquareCalculatorFeatureTest extends TestCase
{
    
    //  Test Case 1: Memverifikasi halaman kalkulator bisa diakses dengan benar
    //  Flow:
    //  1. Mengakses route GET /square-calculator
    //  2. Memastikan response status 200 (OK)
    //  3. Memverifikasi semua elemen UI penting ditampilkan
     
    public function test_square_calculator_page_loads_correctly()
    {
        $response = $this->get('/square-calculator');
        
        $response->assertStatus(200);
        $response->assertSee('Kalkulator Kuadrat'); // Judul halaman
        $response->assertSee('Masukkan Angka:'); // Label input
        $response->assertSee('Hitung Kuadrat'); // Tombol submit
        $response->assertSee('Reset'); // Tombol reset
    }

    
    //  Test Case 2: Memverifikasi perhitungan kuadrat angka bulat positif
    //  Flow:
    //  1. Mengirim POST request dengan angka 5
    //  2. Memastikan response status 200
    //  3. Memverifikasi hasil perhitungan ditampilkan dengan format yang benar
     
    public function test_calculates_square_of_number()
    {
        $response = $this->post('/square-calculator', [
            'number' => 5 
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('Hasil:'); 
        $response->assertSee('5 × 5 = 25'); 
    }

    
    // Test Case 3: Memverifikasi perhitungan kuadrat angka desimal
    // Flow:
    // 1. Mengirim POST request dengan angka 2.5
    // 2. Memastikan response status 200
    // 3. Memverifikasi hasil perhitungan desimal ditampilkan
    
    public function test_calculates_square_of_decimal_number()
    {
        $response = $this->post('/square-calculator', [
            'number' => 2.5 
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('Hasil:');
        $response->assertSee('2.5 × 2.5 = 6.25');
    }

    
    //  Test Case 4: Memverifikasi validasi input non-numerik
    //  Flow:
    //  1. Mengatur URL asal (from) untuk redirect
    //  2. Mengirim POST request dengan input 'abc' (invalid)
    //  3. Memverifikasi:
    //    - Response redirect (302)
    //   - Redirect ke halaman form
    //    - Ada error di session
    //   - Pesan error ditampilkan di halaman
     
    public function test_shows_error_for_non_numeric_input()
    {
        // 1. Set URL referer untuk redirect back
        $response = $this->from('/square-calculator')
                        ->post('/square-calculator', [
                            'number' => 'abc' // Input tidak valid
                        ]);
        
        // 2. Verifikasi response redirect
        $response->assertStatus(302);
        $response->assertRedirect('/square-calculator');
        
        // 3. Verifikasi error di session
        $response->assertSessionHasErrors('number');
        
        // 4. Verifikasi pesan error ditampilkan
        $this->get('/square-calculator')
             ->assertSee('Input harus berupa angka');
    }

    
    // Test Case 5: Memverifikasi fungsi reset/clear
    //  Flow:
    //  1. Mengirim data valid untuk membuat hasil
    //  2. Mengakses halaman lagi (GET request)
    //  3. Memverifikasi hasil sebelumnya tidak ditampilkan
     
    public function test_reset_button_clears_input_and_result()
    {
        // 1. Buat hasil perhitungan
        $this->post('/square-calculator', ['number' => 4]);
        
        // 2. Akses halaman baru
        $response = $this->get('/square-calculator');
        
        // 3. Verifikasi hasil sebelumnya hilang
        $response->assertDontSee('4 × 4 = 16');
    }

    
    // Test Case 6: Memverifikasi validasi input kosong
    // Flow:
    //  1. Mengatur URL asal (from) untuk redirect
    //  2. Mengirim POST request dengan input kosong
    //  3. Memverifikasi:
    //    - Response redirect (302)
    //    - Redirect ke halaman form
    //    - Ada error validasi required di session
    //    - Pesan error required ditampilkan
     
    public function test_empty_input_shows_validation_error()
    {
        $response = $this->from('/square-calculator')
                         ->post('/square-calculator', [
                             'number' => ''
                         ]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/square-calculator');
        $response->assertSessionHasErrors(['number' => 'The number field is required.']);
        

        $this->get('/square-calculator')
             ->assertSee('The number field is required');
    }

    
    // Test Case 7: Memverifikasi perhitungan angka negatif
    // Flow:
    // 1. Mengirim POST request dengan angka negatif (-3)
    // 2. Memastikan response status 200
    // 3. Memverifikasi hasil perhitungan angka negatif
    
    public function test_negative_number_calculation()
    {
        $response = $this->post('/square-calculator', [
            'number' => -3 
        ]);
        
        $response->assertStatus(200);
        $response->assertSee('Hasil:');
        $response->assertSee('-3 × -3 = 9'); 
    }
}