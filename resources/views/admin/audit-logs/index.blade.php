@extends('admin.layouts.app')

@section('title','Audit Logs')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Audit Logs</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Event</th>
                    <th>Entity</th>
                    <th>Metadata</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->user->name ?? '-' }}</td>
                        <td>
                            <span class="badge badge-info">
                                {{ $log->event }}
                            </span>
                        </td>
                        <td>{{ $log->entity_type }} #{{ $log->entity_id }}</td>
                        <td>
                            <pre style="font-size:12px;">{{ json_encode($log->metadata, JSON_PRETTY_PRINT) }}</pre>
                        </td>
                        <td>{{ $log->created_at->format('d M Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No audit logs found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $logs->links() }}
    </div>
</div>

@endsection