<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        return view('pages.progress.progress');
    }

    public function detail($id = null)
    {
        if ($id) {
            return view('pages.progress.progress_detail', compact('id'));
        } else {
            return view('pages.progress.progress_detail');
        }
    }

    public function create()
    {
        return view('pages.progress.progress_add');
    }

    public function store(Request $request)
    {
        // Validation and store logic
        return redirect()->route('progress.detail')->with('success', 'Progress added successfully!');
    }

    public function show($id)
    {
        return view('pages.progress.progress_vew', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.progress.progress_edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic
        return redirect()->route('progress.show', $id)->with('success', 'Progress updated successfully!');
    }

    // New methods for routes without ID
    public function generalView()
    {
        return view('pages.progress.progress_vew');
    }

    public function generalEdit()
    {
        return view('pages.progress.progress_edit');
    }

    public function notes()
    {
        return view('pages.progress.progress_detail');
    }

    public function list()
    {
        return view('pages.progress.progress');
    }
}