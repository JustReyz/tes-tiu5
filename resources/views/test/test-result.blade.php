@extends('layout.dashboard')

@section('content')

<style>
  .text-custom {
    color: #2ca086 !important;
}

.bg-custom {
    background-color: #2ca086 !important;
    color: #fff !important;
}

.badge-custom {
    background-color: #2ca086 !important;
    color: #fff !important;
}

    </style>
<div class="container my-5">
    <h2 class="mb-4 text-custom"><i class="fa fa-check-circle"></i> Hasil Tes TIU 5</h2>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h4 class="card-title mb-3">📊 Ringkasan Nilai</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Skor Anda</strong>
                    <span class="badge bg-info fs-6">{{ $score }} / {{ $totalQuestions }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Nilai WS</strong>
                    <span class="badge bg-secondary fs-6">{{ $ws }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Kategori</strong>
                    <span class="badge badge-custom fs-6">{{ $category }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="card-title mb-3">📋 Rincian Jawaban</h5>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="bg-custom text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Soal</th>
                            <th>Jawaban Benar</th>
                            <th>Jawaban Anda</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($answers as $index => $answer)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($answer->question && $answer->question->image)
                                        <img src="{{ asset($answer->question->image) }}" alt="Soal" class="img-fluid rounded shadow-sm" style="max-width: 150px;">
                                    @else
                                        <em class="text-muted">Tidak ada gambar</em>
                                    @endif
                                </td>
                                <td><span class="badge bg-success">{{ strtoupper($answer->question->correct_option) }}</span></td>
                                <td><span class="badge bg-warning text-dark">{{ strtoupper($answer->selected_option) }}</span></td>
                                <td>
                                    @if($answer->selected_option === $answer->question->correct_option)
                                        <span class="badge bg-success"><i class="fa fa-check"></i> Benar</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fa fa-times"></i> Salah</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
