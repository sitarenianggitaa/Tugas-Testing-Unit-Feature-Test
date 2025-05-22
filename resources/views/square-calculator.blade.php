<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kuadrat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        .container { 
            max-width: 500px; 
            margin: 40px auto; 
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            color: #d63384;
            text-align: center;
            margin-bottom: 25px;
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .result { 
            margin-top: 25px; 
            padding: 20px; 
            background-color: #fff5f9;
            border-radius: 8px;
            border-left: 4px solid #d63384;
        }
        .error { 
            color: #e63946; 
            font-size: 14px;
            margin-top: 5px;
        }
        .input-error { 
            border-color: #e63946; 
        }
        .button-group { 
            display: flex; 
            gap: 12px; 
            margin-top: 15px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button[type="submit"] {
            background-color: #d63384;
            color: white;
        }
        button[type="submit"]:hover {
            background-color: #c22575;
            transform: translateY(-2px);
        }
        #resetButton {
            background-color: #f1f1f1;
            color: #333;
        }
        #resetButton:hover {
            background-color: #e1e1e1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kalkulator Kuadrat</h1>
        
        <form method="POST" action="/square-calculator" id="calculatorForm">
            @csrf
            
            <div class="form-group">
                <label for="number">Masukkan Angka:</label>
                <input type="text" id="number" name="number" 
                       value="{{ old('number', $oldNumber ?? '') }}" 
                       class="@error('number') input-error @enderror"
                       required>
                @error('number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="button-group">
                <button type="submit">Hitung Kuadrat</button>
                <button type="button" id="resetButton">Reset</button>
            </div>
        </form>
        
        @if(isset($result) && !$errors->any())
            <div class="result" id="resultContainer">
                <h3>Hasil:</h3>
                <p>{{ $exactCalculation }}</p>
            </div>
        @endif
    </div>

    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
            document.getElementById('number').value = '';
            const resultContainer = document.getElementById('resultContainer');
            if (resultContainer) resultContainer.remove();
            
            document.querySelectorAll('.error').forEach(error => error.remove());
            document.querySelectorAll('.input-error').forEach(input => 
                input.classList.remove('input-error'));
        });
    </script>
</body>
</html>