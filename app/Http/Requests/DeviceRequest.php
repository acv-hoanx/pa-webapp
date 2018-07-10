<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'device_name' => 'string|max:190',
            'uuid' => 'max:190',
            'adid_old' => 'max:190',
            'adid_new' => 'required|string|max:190',
            'os' => 'string|max:190',
            'token_push' => 'max:190',
            'version_app' => 'max:190',
        ];
    }
}
