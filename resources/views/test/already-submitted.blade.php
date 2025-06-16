@extends('layout.dashboard')

@section('content')
<style>
    body {
        background-color: #E6F7FF; 
        color: #1D4B6B; 
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 600;
        color:#2ca086; 
        margin-top: 20px;
    }

    .page-description {
        font-size: 1.25rem;
        color: #2ca086; 
        margin-top: 10px;
    }

    .result-link {
        color: #2172C5;; 
        text-decoration: none;
    }

    .result-link:hover {
        text-decoration: underline;
        color: #ff7043; 
    }

    
    .container {
        max-width: 600px;
        padding: 40px;
        background-color: #ffffff; 
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }
</style>
<div class="container text-center">
    <h2 class="page-title">Anda sudah mengisi tes ini</h2>
    <p class="page-description">Silakan lihat hasil pada halaman <a href="/test/result" class="result-link">Hasil Tes</a>.</p>
</div>
@endsection


