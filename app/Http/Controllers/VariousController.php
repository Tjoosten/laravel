<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class VariousController extends Controller
{

    /**
     * The frontpage of this application
     *
     * @link   GET /
     * @return \Illuminate\View\View
     */
    public function frontpage()
    {
        $data['title'] = "Index";
        $data['active'] = 0;

        return view('client.frontpage', $data);
    }

    public function contact()
    {

    }

}
