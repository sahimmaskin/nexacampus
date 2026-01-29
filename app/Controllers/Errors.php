<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Errors extends BaseController
{
    public function underConstruction()
    {
        return view('under_construction');
    }
}
