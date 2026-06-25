@extends('layouts.app')

@section('title', 'Detail Audit Log')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-history"></i> Detail Audit Log</h2>
    <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%">ID Log</th>
                        <td>{{ $auditLog->id }}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>{{ $auditLog->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $auditLog->username }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>
                            <span class="badge bg-primary">{{ strtoupper($auditLog->role) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Aksi</th>
                        <td>
                            <span class="badge bg-info">{{ $auditLog->action }}</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%">Tabel</th>
                        <td>{{ $auditLog->table_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Record ID</th>
                        <td>{{ $auditLog->record_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>IP Address</th>
                        <td>{{ $auditLog->ip_address }}</td>
                    </tr>
                    <tr>
                        <th>User Agent</th>
                        <td><small>{{ $auditLog->user_agent ?? '-' }}</small></td>
                    </tr>
                </table>
            </div>
        </div>

        @if($auditLog->old_data)
        <div class="mt-3">
            <h5>Data Lama</h5>
            <div class="bg-light p-3 rounded" style="max-height: 300px; overflow: auto;">
                <pre>{{ json_encode(json_decode($auditLog->old_data), JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
        @endif

        @if($auditLog->new_data)
        <div class="mt-3">
            <h5>Data Baru</h5>
            <div class="bg-light p-3 rounded" style="max-height: 300px; overflow: auto;">
                <pre>{{ json_encode(json_decode($auditLog->new_data), JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection