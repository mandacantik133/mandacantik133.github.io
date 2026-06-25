@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                <h4>{{ $user->nama_lengkap }}</h4>
                <p class="text-muted">
                    <span class="badge bg-primary">{{ strtoupper($user->role) }}</span>
                </p>
                <hr>
                <p><i class="fas fa-user"></i> {{ $user->username }}</p>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <!-- Form Edit Profile -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Edit Profile</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('/profile') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>

        <!-- Form Ganti Password -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ganti Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('/change-password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Ganti Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection