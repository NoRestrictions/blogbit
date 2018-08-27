<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {   
        $title = 'Welcome to Blogbit';
        return view('pages.index')->with('title', $title);
    }

    public function about()
    {   
        $title = 'Get to Know About Us';
        return view('pages.about')->with('title', $title);
    }
 
    public function services()
    {
        $data = [ 
            'title' => 'Services',
            'services' => ['Web Programming', 'Digital Marketing', 'Graphics Design', 'Documentary Creation'
            ]
        ];

        return view('pages.services')->with($data);
    }
}

