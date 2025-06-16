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
  <h2 class="mb-4 text-custom"><i class="fa fa-user-circle"></i> Edit Profil</h2>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label fw-bold">Nama</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
          @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label fw-bold">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <hr class="my-4">

        <h5 class="text-custom"><i class="fa fa-lock"></i> Ubah Password (Opsional)</h5>

        <div class="mb-3 mt-3">
          <label for="password" class="form-label fw-bold">Password Baru</label>
          <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
          @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
          <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn bg-custom"><i class="fa fa-save"></i> Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
