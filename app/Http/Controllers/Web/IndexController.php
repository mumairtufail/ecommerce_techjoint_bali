<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{

    
    public function index()
    {
        return view('web.index', $this->banners);
    }
}
