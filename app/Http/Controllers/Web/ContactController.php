<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
class ContactController extends BaseController
{
    public function View()
    {
        return view('web.contact', $this->withBanners());
    }
}
