<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;


class BayarController extends Controller
{
    public function index()
    {
        return view('supervisor.payment.index');
    }
}
