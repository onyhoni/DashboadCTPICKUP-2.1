<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ShowlogbookController extends BaseController
{
    public function index()
    {
        return view('ShowLogbook/index');
    }
}
