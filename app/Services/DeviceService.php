<?php
/**
 * Created by PhpStorm.
 * User: HoaNguyen
 * Date: 7/6/18
 * Time: 10:50
 */

namespace App\Services;

use App\Devices;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\DeviceTokenPushRequest;
use App\Http\Requests\PushFCMRequest;
use Illuminate\Support\Facades\DB;

class DeviceService extends BaseService
{
    /**
     * @param DeviceRequest $request
     *
     * @return Devices
     */
    public function addDevice(DeviceRequest $request)
    {
        $adid_old     = $request->input('adid_old');
        $deviceOldObj = Devices::where('adid', $adid_old)->first();
        $adid_new     = $request->input('adid_new');
        $deviceNewObj = Devices::where('adid', $adid_new)->first();

        if ($adid_old && $deviceOldObj) {
            //update device
            $deviceOldObj->update([
                'adid'        => $request->input('adid_new'),
                'version_app' => $request->input('version_app'),
            ]);

            return $deviceOldObj;
        } else {
            if ($deviceNewObj) {
                return $deviceNewObj;
            }
            $deviceObj = new Devices();
            $deviceObj->fill($request->toArray());
            $deviceObj->setAttribute('adid', $adid_new);
            $deviceObj->save();

            return $deviceObj;
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportCsv()
    {
        $dataExport = [
            0 => ['id', 'device_name', 'uuid', 'adid', 'os', 'version_app', 'created_at']
        ];
        $deviceObj  = Devices::all();
        if ($deviceObj->count()) {
            $i = 1;
            foreach ($deviceObj as $device) {
                $dataExport[$i][] = $device->id;
                $dataExport[$i][] = $device->device_name;
                $dataExport[$i][] = $device->uuid;
                $dataExport[$i][] = $device->adid;
                $dataExport[$i][] = $device->os;
                $dataExport[$i][] = $device->version_app;
                $dataExport[$i][] = $device->created_at;
                $i++;
            }
        }

        return export_csv($dataExport, 'device');
    }

    /**
     * @param DeviceTokenPushRequest $request
     *
     * @return mixed
     */
    public function updateTokenPush(DeviceTokenPushRequest $request)
    {
        $deviceObj = Devices::where('adid', $request->input('adid'))->first();
        $deviceObj->update([
            'token_push' => $request->input('token_push')
        ]);

        return $deviceObj;
    }

    public function pushFCM(PushFCMRequest $request)
    {
        $token = DB::table('devices')->select('token_push')
            ->where('token_push', '<>', null)
            ->pluck('token_push')->toArray();

        fcm_push($token, $request->input('title'), $request->input('content'));
    }
}