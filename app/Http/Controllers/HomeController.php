<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Http\Resources\Devices;
use App\Services\DeviceService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var DeviceService
     */
    protected $device_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DeviceService $device_service)
    {
        $this->device_service = $device_service;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function exportCsv()
    {
        return $this->device_service->exportCsv();
    }

}
