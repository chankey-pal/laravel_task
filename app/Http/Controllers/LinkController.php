<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinkController extends Controller
{
    public function index($page = 1)
    {
        // Fetch 5 links per page
        $links = Link::where('page', $page)->limit(5)->get();
        return view('links.index', compact('links', 'page'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page' => 'required|integer',
            'title' => 'required|string',
            'url' => 'required|url'
        ]);

        Link::create($request->all());

        return redirect()->route('links.index', ['page' => $request->page])
                         ->with('success', 'Link added successfully.');
    }
}
