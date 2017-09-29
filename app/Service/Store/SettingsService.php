<?php

namespace App\Service\Store;


use App\Enum\Settings;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsService
{
    public function updateSettings($store_id, Request $request){
        self::updatePaypalEmails($store_id, $request);
    }

    public function getSettings($store_id){
        return Setting::where('reference_id', $store_id);
    }


    private function updatePaypalEmails($store_id, Request $request){
        $emails = $request->get('paypal_emails');
        Setting::where('scope', Settings::PAYPAL_EMAIL)
            ->where('reference_id', $store_id)
            ->where('key', 'paypal_email')
            ->delete();
        $data = [];
        foreach ($emails as $email){
            $data[] = [
                'scope' =>  Settings::PAYPAL_EMAIL,
                'reference_id'  =>  $store_id,
                'key'   =>  'paypal_email',
                'value' =>  $email
            ];
        }
        Setting::insert($data);
    }
}