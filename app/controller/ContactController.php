<?php 

namespace App\Controller;

class ContactController
{
    /**
     * Index
     */
    public function index()
    {
        $title = 'Contact';

        return view('contact', compact('title'));
    }
}