<?php

namespace App\Http\Controllers;

use App\JobInvoices;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getInvoices(){
        return view('dashboard.invoices')->with(['invoices' => JobInvoices::all()]);
    }
}
