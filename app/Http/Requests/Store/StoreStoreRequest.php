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
            'auth_token'    =>  'required|string|max:4000',
            'oauth_token'    =>  'required|string|max:4000',
        ];
    }
}
