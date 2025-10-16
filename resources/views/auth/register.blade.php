@extends('layout')

@section('title', 'Register - Toko Sparepart Sepeda')

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
            <h2>Register</h2>
            <p>Buat akun baru</p>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Success --}}
        @if (session('success'))
            <div class="alert-error" style="border-color: #43a047; background:#1b3020; color:#b2ffb2;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama anda" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email anda" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password anda" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password anda" required>
            </div>

            <button type="submit" class="btn-login">Daftar</button>
        </form>

        <div class="footer-form">
            <h4>Already have account? <a href="{{ url('/login') }}" style="color: #ff6f61">Login here!</a></h4>
        </div>
    </div>
</div>

@endsection
