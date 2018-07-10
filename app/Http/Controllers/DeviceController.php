<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Http\Requests\DeviceTokenPushRequest;
use App\Http\Resources\Devices as DeviceResource;
use App\Services\DeviceService;

class DeviceController extends Controller
{
    /**
     * @var DeviceService
     */
    protected $device_service;

    public function __construct(DeviceService $device_service)
    {
        $this->device_service = $device_service;
    }

    public function addDevice(DeviceRequest $request)
    {
        return new DeviceResource($this->device_service->addDevice($request));
    }

    public function tokenPush(DeviceTokenPushRequest $request)
    {
        return new DeviceResource($this->device_service->updateTokenPush($request));
    }
}
