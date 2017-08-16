<?php

namespace App\Http\Requests\Store;

use App\Enum\Ebay\Site;
use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
        $site_ids = implode(",", array_pluck(Site::toArray(), 'site_id'));
        return [
            'name'  =>  'required|string|max:200',
            'site_id'   =>  'required|numeric|in:' . $site_ids,
            'site_mode' =>  'required|string|in:sandbox,production',

            'sandbox_dev_id'    =>  'required|string|max:200',
            'sandbox_app_id'    =>  'required|string|max:200',
            'sandbox_cert_id'    =>  'required|string|max:200',
            'sandbox_auth_token'    =>  'required|string|max:4000',
            'sandbox_oauth_token'    =>  'required|string|max:4000',

            'production_dev_id'    =>  'required|string|max:200',
            'production_app_id'    =>  'required|string|max:200',
            'production_cert_id'    =>  'required|string|max:200',
            'production_auth_token'    =>  'required|string|max:4000',
            'production_oauth_token'    =>  'required|string|max:4000',
        ];
    }
}
