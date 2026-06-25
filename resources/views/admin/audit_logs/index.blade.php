@extends('layouts.app')

@section('title', 'Audit Log')

@section('content')
<h2><i class="fas fa-history"></i> Audit Log</h2>

<div class="card mt-3">
    <div class="card-body">
        <form method="GET" class="row mb-3">
            <div class="col-md-3">
                <select name="role" class="form-control">
                    <option value="">Semua Role</option>
                    @foreach($roles as $role)
                    <option value="{{ $role }}" {{ request('role')==$role?'selected':'' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="action" class="form-control">
                    <option value="">Semua Aksi</option>
                    @foreach($actions as $action)
                    <option value="{{ $action }}" {{ request('action')==$action?'selected':'' }}>{{ $action }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="start_date" class="form-control" placeholder="Dari Tanggal" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="end_date" class="form-control" placeholder="Sampai Tanggal" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                        <th>Tabel</th>
                        <th>Record ID</th>
                        <th>IP Address</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $index => $log)
                    <tr>
                        <td>{{ $logs->firstItem() + $index }}</td>
                        <td>
                            <small>{{ $log->created_at->format('d/m/Y H:i:s') }}</small><br>
                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <strong>{{ $log->username }}</strong>
                            @if($log->user)
                                <br><small class="text-muted">{{ $log->user->nama_lengkap }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ 
                                $log->role == 'admin' ? 'danger' : 
                                ($log->role == 'hrd' ? 'primary' : 'warning') 
                            }}">
                                {{ strtoupper($log->role) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ 
                                str_contains($log->action, 'LOGIN') ? 'success' : 
                                (str_contains($log->action, 'CREATE') ? 'info' : 
                                (str_contains($log->action, 'UPDATE') ? 'warning' : 
                                (str_contains($log->action, 'DELETE') ? 'danger' : 'secondary'))) 
                            }}">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td>{{ $log->table_name ?? '-' }}</td>
                        <td>{{ $log->record_id ?? '-' }}</td>
                        <td><small>{{ $log->ip_address }}</small></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $log->id }}">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada data audit log</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $logs->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- Modal Detail untuk setiap log -->
@foreach($logs as $log)
<div class="modal fade" id="modalDetail{{ $log->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle"></i> Detail Audit Log
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Waktu</th>
                        <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $log->username }} ({{ $log->role }})</td>
                    </tr>
                    <tr>
                        <th>Aksi</th>
                        <td>{{ $log->action }}</td>
                    </tr>
                    <tr>
                        <th>Tabel</th>
                        <td>{{ $log->table_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Record ID</th>
                        <td>{{ $log->record_id ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>IP Address</th>
                        <td>{{ $log->ip_address }}</td>
                    </tr>
                    <tr>
                        <th>User Agent</th>
                        <td><small>{{ $log->user_agent ?? '-' }}</small></td>
                    </tr>
                    
                    @if($log->old_data)
                    <tr>
                        <th>Data Lama</th>
                        <td>
                            <pre class="bg-light p-2" style="max-height: 200px; overflow: auto;">{{ json_encode(json_decode($log->old_data), JSON_PRETTY_PRINT) }}</pre>
                        </td>
                    </tr>
                    @endif
                    
                    @if($log->new_data)
                    <tr>
                        <th>Data Baru</th>
                        <td>
                            <pre class="bg-light p-2" style="max-height: 200px; overflow: auto;">{{ json_encode(json_decode($log->new_data), JSON_PRETTY_PRINT) }}</pre>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('styles')
<style>
    pre {
        font-size: 12px;
        border-radius: 5px;
    }
    .table td {
        vertical-align: middle;
    }
</style>
@endpush