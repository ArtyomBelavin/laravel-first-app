<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ReportController extends Controller
{


    public function index(Request $request)
    {
        $sort = $request->input('sort');

        if ($sort != 'asc' && $sort != 'desc') {
            $sort = 'desc';
        }

        $status = $request->input('status');

        $validate = $request->validate([
            'status' => 'exists:statuses,id'
        ]);

        if ($validate) {
            $reports = Report::where('status_id', $status)
                ->where('user_id', Auth::user()->id)
                ->orderBy('created_at', $sort)
                ->paginate(8);
        } else {
            $reports = Report::where('user_id', Auth::user()->id)
                ->orderBy('created_at', $sort)
                ->paginate(8);
        }


        $statuses = Status::all();

        return view('report.index', compact('reports', 'statuses', 'sort', 'status'));
    }

    // task 5

    public function destroy(Report $report)
    {
        if (Auth::user()->id === $report->user_id) {
            $report->delete();
            return redirect()->back();
        } else {
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|string',
            'description' => 'required|string',
            'path_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('path_img')) {

            $path = Storage::disk('public')->put(
                'reports',
                $request->file('path_img')
            );

            $data['path_img'] = $path;
        }

        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;

        Report::create($data);

        return redirect()->back();
    }

    public function update(Request $request, Report $report)
    {

        if (Auth::user()->id === $report->user_id) {
            $data = $request->validate([
                'number' => 'string',
                'description' => 'string',
            ]);

            $report->update($data);
            return redirect()->back();
        } else {
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function edit(Report $report)
    {
        if (Auth::user()->id === $report->user_id) {
            return view('report.edit', compact('report'));
        } else {
            abort(403, 'У вас нет прав на редактирование этой записи.');
        }
    }

    public function statusUpdate(Request $request, Report $report)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id'
        ]);

        $report->update($request->only(['status_id']));
        return redirect()->back();
    }
}
