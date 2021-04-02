<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Inform\InformHandler;

class InformController extends Controller
{
    private $inform_handler;

    public function __construct()
    {
        $this->inform_handler = new InformHandler();
    }

    public function sendInformation()
    {
        $this->inform_handler->saveReport()
    }
}
