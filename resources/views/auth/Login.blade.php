<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('http://localhost:8000/images/bg-web.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding-left:40px;
            padding-right:40px;
            padding-bottom:40px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px); 
        }

        .card h2 {
            font-size: 32px;
            color: #333333;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            margin-top: 10px;
            background: transparent;
        }

        .input-group label {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 16px;
            color: #777;
            transition: 0.3s ease all;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -10px;
            left: 12px;
            font-size: 12px;
            color: #5C998B; 
        }

        .input-group input:focus {
            border-color: #5C998B; 
            outline: none;
        }

 
        .btn {
            width: 100%;
            padding: 14px;
            background-color: #5C998B;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #4b7d6a;
        }

        /* Social login buttons */
        .social-login {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .social-login a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }

        .social-login a:hover {
            color: #5C998B;
        }

        /* Forgot Password */
        .forgot-password {
            font-size: 14px;
            color: #5C998B;
            margin-top: 10px;
            display: inline-block;
        }

        /* Responsive styling */
        @media (max-width: 600px) {
            .card {
                width: 90%;
                padding: 20px;
            }
        }
     .error {
    color: red;
    font-size: 14px;
    margin-bottom: 10px; /* Memberikan jarak antara pesan error dan input */
    display: block; /* Memastikan pesan error tampil di baris baru */
    text-align: center; /* Memposisikan teks error di tengah secara horizontal */
    width: 100%; /* Pastikan lebar pesan error sama dengan lebar container input */
}



    </style>
</head>
<body>
     <div class="card">
        <h2>Sign In</h2>
        <p>Selamat datang! Silakan masuk menggunakan akun Anda.</p>


        

        <form action="{{ route('login') }}" method="POST">
             @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
    @endif
            @csrf
         <div class="input-group">
    
    <input type="email" name="email" id="email" placeholder=" " required value="{{ old('email') }}">
    <label for="email">Email Address</label>
</div>

<div class="input-group">
    @if ($errors->has('password'))
        <span class="error">{{ $errors->first('password') }}</span>
    @endif
    <input type="password" name="password" id="password" placeholder=" " required>
    <label for="password">Password</label>
</div>

            <button type="submit" class="btn">Sign In</button>
             </form>
        <div class="social-login">
            <a href="{{ route('register') }}">Belum memiliki akun? Daftar</a>
        </div>
        {{-- <a href="#" class="forgot-password">Lupa password?</a> --}}
    </div>
</body>
</html>
