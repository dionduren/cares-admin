<?php

namespace App\Http\Controllers\Dsahboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    function index_new()
    {
        return view('helpdesk.tiket-baru');
    }
}
