<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        /* Background settings */
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

        /* Blur effect for the card background */
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
            margin-bottom: 20px;
        }

        .card p {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }

        /* Label and input styling */
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
            color: #5C998B; /* Color when label moves up */
        }

        .input-group input:focus {
            border-color: #5C998B; /* Change border color on focus */
            outline: none;
        }

        /* Button styling */
        .btn {
            width: 100%;
            padding: 14px;
            background-color: #5C998B; /* Button color */
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
    margin-top: 5px;
    display: block;
}

    </style>
</head>
<body>

  <div class="card">
        <h2>Sign Up</h2>
        <p>Selamat datang! Silahkan register terlebih dahulu.</p>
        <!-- Set form action to the register route and include the CSRF token -->
<form action="{{ route('register') }}" method="POST">

            @csrf 
            <div class="input-group">
                <input type="text" id="name" name="name" placeholder=" " required>
                <label for="name">Nama</label>
            </div>
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>
           
             <div class="input-group">
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder=" " required>
        <label for="password_confirmation">Konfirmasi Password</label>
        <span id="password-error" class="error" style="display:none;">Password tidak sesuai!</span>
    </div>

            <button type="submit" class="btn">Regist</button>
        </form>
        <div class="social-login">
            <a >Sudah memiliki akun?</a>
            <a href="/login">Login</a>
        </div>
        <a href="#" class="forgot-password">Lupa password?</a>
    </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    const errorMessage = document.getElementById('password-error');

    // Add event listener to confirm password field
    confirmPasswordField.addEventListener('input', function () {
        // Check if passwords match
        if (passwordField.value !== confirmPasswordField.value) {
            errorMessage.style.display = 'block'; // Show error message
        } else {
            errorMessage.style.display = 'none'; // Hide error message if passwords match
        }
    });
});

    </script>
</html>
