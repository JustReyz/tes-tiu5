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

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background-color: #f0faf7;
    }

    .btn-sm {
        border-radius: 12px;
        padding: 6px 12px;
    }

    .badge {
        font-size: 0.85rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .btn-info {
        background-color: #5bc0de;
        border-color: #46b8da;
        color: white;
    }

    .btn-danger {
        background-color: #f86c6b;
        border-color: #f63d3d;
        color: white;
    }

    .btn-info:hover {
        background-color: #31b0d5;
    }

    .btn-danger:hover {
        background-color: #e55252;
    }

    .table thead th {
        background-color: #eafaf6;
        color: #333;
    }
</style>

<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📊 Hasil Tes Pengguna</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Status Tes</th>
                            <th>Nilai</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->result)
                                        <span class="badge bg-success">Sudah Tes</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Tes</span>
                                    @endif
                                </td>
                                <td>{{ $user->result->score ?? '-' }}</td>
                                <td>{{ $user->result->category ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.results.view', $user->id) }}"
                                       class="btn btn-sm btn-info me-1">
                                        🔍 Lihat
                                    </a>
                                    @if($user->result)
                                        <form action="{{ route('admin.results.delete', $user->id) }}"
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus hasil tes ini?')">
                                                🗑 Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada data pengguna tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
