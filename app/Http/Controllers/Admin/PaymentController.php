<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with([
            'user',
            'order'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'admin.payments.index',
            compact('payments')
        );
    }
}