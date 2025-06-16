@extends('layout.dashboard-admin')

@section('content')
<style>
    :root {
        --primary-color: #2ca086;
        --primary-hover: #239176;
        --light-bg: #f8f9fa;
    }

    .card {
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        background-color: white;
        border: none;
    }

    .card-header {
        background: linear-gradient(90deg, var(--primary-color), var(--primary-hover));
        color: white;
        padding: 1.25rem 1.5rem;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .question-image {
        width: 100%;
        max-width: 500px;
        border-radius: 8px;
        margin-bottom: 10px;
        border: 1px solid #dee2e6;
    }

    .list-group-item {
        margin-bottom: 15px;
        padding: 20px;
        border-radius: 12px;
        background-color: #f9fdfc;
        border: 1px solid #e0f1eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }

    .btn-secondary {
        border-radius: 10px;
    }
</style>

<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0"> Jawaban: {{ $user->name }}</h4>
        </div>
        <div class="card-body">

            <div class="mb-4">
                <a href="{{ route('admin.results') }}" class="btn btn-secondary">
                    ← Kembali ke Daftar Hasil
                </a>
            </div>

            @forelse($answers as $answer)
                <div class="list-group-item">
                    <h6><strong>Soal:</strong></h6>

                    @if($answer->question && $answer->question->image)
                        <img src="/images/keterangan.png" alt="Keterangan Soal" class="question-image">
                        <img src="{{ asset($answer->question->image) }}" alt="Gambar Soal" class="question-image">
                        <p class="mb-0 mt-2"><strong>Jawaban user:</strong> {{ $answer->selected_option }}</p>
                    @else
                        <p class="text-muted">(Gambar soal tidak ditemukan)</p>
                    @endif
                </div>
            @empty
                <div class="alert alert-info">Belum ada jawaban yang diisi oleh user ini.</div>
            @endforelse

        </div>
    </div>
</div>
@endsection
