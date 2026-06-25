@extends('layouts.app')

@section('title', isset($karyawan) ? 'Edit Karyawan' : 'Tambah Karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ isset($karyawan) ? 'Edit' : 'Tambah' }} Karyawan</h5>
    </div>
    <div class="card-body">
        <form action="{{ isset($karyawan) ? route('karyawan.update', $karyawan->id) : route('karyawan.store') }}" method="POST">
            @csrf
            @if(isset($karyawan))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" 
                       value="{{ isset($karyawan) ? $karyawan->nik : old('nik') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input type="text" name="nama" class="form-control" 
                       value="{{ isset($karyawan) ? $karyawan->nama : old('nama') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Divisi</label>
                <input type="text" name="divisi" class="form-control" 
                       value="{{ isset($karyawan) ? $karyawan->divisi : old('divisi') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection