@extends('layout')

@section('title', 'Login - Toko Sparepart Sepeda')

@section('content')


<style>
/* Wrapper */
.login-wrapper {
    padding-top: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 78vh;
}

/* Card */
.login-card {
    max-width: 500px;
    width: 100%;
    background: rgba(30, 30, 30, 0.95);
    backdrop-filter: blur(6px);
    border-radius: 16px;
    padding: 30px 30px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.6);
    animation: fadeIn 0.6s ease;
}

/* Header */
.login-header {
    text-align: center;
    margin-bottom: 25px;
}
.login-header h2 {
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    color: #ff6f61;
}
.login-header p {
    color: #aaa;
    margin-top: 6px;
}
.login-icon {
    font-size: 42px;
    margin-bottom: 10px;
}

/* Alert */
.alert-error {
    background: #3a2323;
    border: 1px solid #e53935;
    color: #ffb3b3;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

/* Form */
.form-group {
    margin-bottom: 20px;
    padding-right: 15px;
}
.form-group label {
    display: block;
    margin-bottom: 9px;
    font-weight: 600;
    color: #ddd;
}
.form-group input {
    width: 103%;
    padding: 20px 0px 20px 20px;
    border-radius: 10px;
    border: 1px solid #444;
    background: #1c1c1c;
    color: #fff;
    font-size: 14px;
    transition: all 0.3s ease;
}
.form-group input:focus {
    border-color: #ff6f61;
    outline: none;
    box-shadow: 0 0 0 3px rgba(229,57,53,0.3);
}

/* Button */
.btn-login {
    width: 100%;
    padding: 14px 14px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(90deg, #e53935, #ff6f61);
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 20px;
}
.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(229,57,53,0.5);
}

.footer-form {
    text-align: center;
    padding-top: 10px
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

{{-- Batas --}}

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon"></div>
            <h2>Login</h2>
            <p>Selamat datang</p>
        </div>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email anda" required autofocus>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password anda" required>
            </div>
            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="footer-form">
            <h4>Forgot password?</h4>
            <h4>Need an account? Sign up <a href="#" style="color: #ff6f61">here</a></h4>
        </div>
    </div>
</div>
@endsection
