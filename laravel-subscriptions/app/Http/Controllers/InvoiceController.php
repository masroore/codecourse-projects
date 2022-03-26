<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        return view('invoices.index')->with([
            'invoices' => $request->user()->invoices(),
        ]);
    }

    public function show($invoiceId, Request $request)
    {
        return $request->user()->downloadInvoice($invoiceId, [
            'vendor' => 'Codecourse Ltd',
            'product' => 'Some product',
        ]);
    }
}
