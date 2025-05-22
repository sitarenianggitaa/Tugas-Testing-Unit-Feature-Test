<?php

namespace App\Http\Controllers;

use App\Helpers\SquareCalculatorHelper;
use Illuminate\Http\Request;

class SquareCalculatorController extends Controller
{
    public function index()
    {
        return view('square-calculator');
    }

    public function calculate(Request $request)
{
    $validated = $request->validate([
        'number' => [
            'required',
            function ($attribute, $value, $fail) {
                if (!is_numeric($value)) {
                    $fail('Input harus berupa angka.');
                }
            },
        ],
    ]);

    $number = $validated['number'];
    $result = $number * $number;
    
    return view('square-calculator', [
        'result' => $result,
        'oldNumber' => $number,
        'exactCalculation' => "$number × $number = " . ($number * $number)
    ]);
}
}