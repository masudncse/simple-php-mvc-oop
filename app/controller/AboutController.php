<?php 

namespace App\Controller;

class AboutController
{
    /**
     * Index
     */
    public function index()
    {
        $title = 'About';

        return view('about', compact('title'));
    }
}