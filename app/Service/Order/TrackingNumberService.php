<?php

namespace App\Service\Order;

use App\Enum\TrackingNumberScope;
use App\Models\Order\TrackingNumber;
use App\Models\Order\Transaction;

class TrackingNumberService
{
    public function updateOnSync($downloadedTrackingNumbers, $transaction_id){
        $all_saved_trackings = collect();
        $transaction = Transaction::with('tracking_numbers', 'skus', 'skus.tracking_numbers')->find($transaction_id);
        $transaction->tracking_numbers->each(function($tracking) use ($all_saved_trackings){
            $all_saved_trackings->push($tracking);
        });
        $transaction->skus->each(function($sku) use ($all_saved_trackings){
            $sku->tracking_numbers->each(function($tracking) use ($all_saved_trackings){
                $all_saved_trackings->push($tracking);
            });
        });
        $downloadedTrackingNumbers = collect($downloadedTrackingNumbers);
        $trackings_to_remove = $all_saved_trackings->whereNotIn('carrier', $downloadedTrackingNumbers->pluck('carrier_used')->all())
            ->whereNotIn('tracking_no', $downloadedTrackingNumbers->pluck('tracking_no')->all());
        TrackingNumber::whereIn('id', $trackings_to_remove->pluck('id')->all())->delete();

        $newTrackings = $downloadedTrackingNumbers->whereNotIn('carrier_used', $all_saved_trackings->pluck('carrier')->all())
            ->whereNotIn('tracking_no', $all_saved_trackings->pluck('tracking_no')->all());
        foreach ($newTrackings as $newTracking){
            TrackingNumber::create([
                'scope' =>  TrackingNumberScope::TRANSACTION,
                'reference_id'  =>  $transaction_id,
                'carrier'   =>  $newTracking['carrier_used'],
                'tracking_no'   =>  $newTracking['tracking_no']
            ]);
        }
    }

}