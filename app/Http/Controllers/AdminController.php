<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        $reports = Report::all();

        return view('admin.index', compact('statuses', 'reports'));
    }
}
