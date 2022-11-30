<?php 

namespace App\Controller;

class HomeController
{
    /**
     * Index
     */
    public function index()
    {
        $title = 'Home';

        return view('home', compact('title'));
    }
}