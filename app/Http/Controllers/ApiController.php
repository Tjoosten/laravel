<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class ApiController extends BaseController
{
    use DispatchesCommands, ValidatesRequests;

    public function KloekecodeCallback()
    {
        return function ($data) {
            return [
                [
                    'id'         => (int)    $data['id'],
                    'Kloekecode' => (string) $data['Kloekecode'],
                    'Plaats'     => (string) $data['plaats'],
                    'Gemeente'   => (string) $data['gemeente'],
                    'Provincie'  => (string) $data['provincie'],
                ],
            ];
        };
    }

    public function ErrorCallback()
    {
        return function() {
            return [
                [
                    'error'   => (bool)   true,
                    'message' => (string) 'Could not find any data',
                ],
            ];
        };
    }

}