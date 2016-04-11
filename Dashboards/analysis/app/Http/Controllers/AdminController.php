<?php
/**
 * Copyright Heddoko(TM) 2016, all rights reserved.
 *
 * @brief   Handles genereal requests
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    February 2016
 */
namespace App\Http\Controllers;

use Log;
use Session;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     *
     */
    public function getDashboard() {
        return view('admin.dashboard', [
            'version' => '0.3'
        ]);
    }

    /**
     *
     */
    public function authenticate()
    {
        return redirect(route('auth.login'));
    }
}
