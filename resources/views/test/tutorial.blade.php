@extends('layout.dashboard')

@section('content')
<style>
    :root {
        --primary-color: #2ca086;
        --primary-hover: #239176;
        --light-bg: #f8f9fa;
        --option-hover: #e0f5ef;
    }

    .question-box {
        background-color: var(--light-bg);
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-top: 20px;
    }

    .question-title {
        font-size: 24px;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 20px;
    }

    .options label {
        display: block;
        padding: 10px 15px;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .options input[type="radio"] {
        margin-right: 10px;
        accent-color: var(--primary-color);
    }

    .options label:hover {
        background-color: var(--option-hover);
        border-color: var(--primary-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
    }

    .alert-info {
        background-color: #d1f4ee;
        border-color: var(--primary-color);
        color: #155f53;
    }
</style>

<div class="container my-5">
    <h2 class="question-title">Tutorial Sebelum Tes</h2>
    <p class="mb-4">Sebelum memulai tes, bacalah petunjuk berikut dan kerjakan contoh soal terlebih dahulu.</p>

    <div class="question-box">
        <h4 class="mb-3">📌 Petunjuk Pengerjaan Tes TIU</h4>
        <ul>
            <li><strong>Jumlah Soal:</strong> Tes terdiri dari <strong>30 soal pilihan ganda</strong>.</li>
            <li><strong>Sistem Skor:</strong> Jawaban benar akan menambah skor dan dikonversi menjadi nilai WS.</li>
            <li><strong>Kategori:</strong>
                <ul>
                    <li>BS = Baik Sekali</li>
                    <li>B = Baik</li>
                    <li>S = Sedang</li>
                    <li>K = Kurang</li>
                    <li>KS = Kurang Sekali</li>
                </ul>
            </li>
            <li><strong>Aturan:</strong>
                <ul>
                    <li>Tes hanya bisa dikerjakan satu kali.</li>
                    <li>Tidak dapat logout atau kembali selama tes berlangsung.</li>
                    <li>Pastikan koneksi internet stabil.</li>
                </ul>
            </li>
            <li><strong>Contoh:</strong> Lihat ilustrasi soal di bawah sebelum memulai.</li>
        </ul>
    </div>

    <div class="question-box">
        <h5 class="mb-3">Penjelasan soal</h5>

        {{-- Gambar penjelasan: menggunakan gambar yang diunggah --}}
       <img src="/images/contoh.png" alt="Keterangan Soal" class="img-fluid mb-3" style="width:90%;">

        @if(session('showFeedback'))
            <div class="alert alert-info">
                <h5 class="mb-2">💡 Hasil Jawaban Anda:</h5>
                <p><strong>Jawaban Anda:</strong> {{ session('userAnswer') }}</p>
                <p><strong>Jawaban yang benar:</strong> <span>{{ session('correctAnswer') }}</span></p>
                <p>Silakan coba lagi.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('test.submitTutorial') }}">
            @csrf
                  <h5 class="mb-3">Contoh soal</h5>
           <img src="/images/keterangan.png" alt="Keterangan Soal" class="img-fluid mb-3" style="width:90%;">
            <img src="{{ asset('questions/' . $dummy->image) }}" class="img-fluid rounded shadow-sm mb-4" style="width:90%;">

            <div class="options">
                @foreach([1, 2, 3, 4, 5] as $opt)
                    <label>
                        <input type="radio" name="dummy_answer" value="{{ $opt }}" required>
                        {{ $opt }}
                    </label>
                @endforeach
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4">Submit Jawaban</button>
            </div>
        </form>
    </div>
</div>
@endsection
