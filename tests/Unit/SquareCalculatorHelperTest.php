<?php

namespace Tests\Unit;

use App\Helpers\SquareCalculatorHelper;
use PHPUnit\Framework\TestCase;

class SquareCalculatorHelperTest extends TestCase
{
    // Test case untuk angka positif
    public function test_calculate_square_positive_number()
    {
        $this->assertEquals(25, SquareCalculatorHelper::calculate(5));
        $this->assertEquals(6.25, SquareCalculatorHelper::calculate(2.5));
    }

    // Test case untuk angka negatif
    public function test_calculate_square_negative_number()
    {
        $this->assertEquals(16, SquareCalculatorHelper::calculate(-4));
    }

    // Test case untuk nol
    public function test_calculate_square_zero()
    {
        $this->assertEquals(0, SquareCalculatorHelper::calculate(0));
    }

    // Test case untuk string numerik
    public function test_numeric_string_input()
    {
        $this->assertEquals(16, SquareCalculatorHelper::calculate('4'));
        $this->assertEquals(6.25, SquareCalculatorHelper::calculate('2.5'));
    }

    // Test case untuk input bukan angka
    public function test_non_numeric_input_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Input harus berupa angka");
        SquareCalculatorHelper::calculate('abc');
    }

    // Test case untuk berbagai tipe input tidak valid
    public function test_invalid_input_types()
    {
        // Test array
        $this->expectException(\InvalidArgumentException::class);
        SquareCalculatorHelper::calculate([1, 2, 3]);

        // Test boolean
        $this->expectException(\InvalidArgumentException::class);
        SquareCalculatorHelper::calculate(true);

        // Test null
        $this->expectException(\InvalidArgumentException::class);
        SquareCalculatorHelper::calculate(null);

        // Test object
        $this->expectException(\InvalidArgumentException::class);
        SquareCalculatorHelper::calculate(new \stdClass());
    }

    // Data provider harus static
    public static function squareCalculationDataProvider(): array
    {
        return [
            [3, 9],
            [1.5, 2.25],
            [-2, 4],
            [0, 0],
            [10, 100],
            ['4', 16],
            ['2.5', 6.25],
        ];
    }

    /**
     * @dataProvider squareCalculationDataProvider
     */
    public function test_square_calculations_with_data_provider($input, $expected)
    {
        $result = SquareCalculatorHelper::calculate($input);
        $this->assertEqualsWithDelta($expected, $result, 0.00001);
    }
}