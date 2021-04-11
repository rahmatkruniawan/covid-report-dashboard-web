<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Inform\InformHandler;

class InformController extends Controller
{
    private $inform_handler;

    public function __construct(Request $request)
    {
    	$this->request = $request;
        $this->inform_handler = new InformHandler($request);
    }

    public function sendReport()
    {
        return $this->inform_handler->saveReport();
    }

    public function searchReport()
    {
    	return $this->inform_handler->searchReport($this->request);
    }
}
