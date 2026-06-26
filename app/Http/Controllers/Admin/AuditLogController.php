<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuditLog;
use App\Http\Controllers\Controller;

class AuditLogController extends Controller
{
    public function index()
    {
        $logs = AuditLog::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.audit-logs.index', compact('logs'));
    }
}