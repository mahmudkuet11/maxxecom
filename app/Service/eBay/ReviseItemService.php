<?php

namespace App\Service\eBay;

use App\Models\Item\Item;
use App\Models\Store;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

class ReviseItemService extends EbayRequest
{

    protected function getCallName(){
        return 'ReviseItem';
    }

    public function updateList(Item $item, Store $store, Request $request){

        $specifics = collect($request->get('specifics'))->groupBy('name');
        $specificsArray = [];
        $specifics->each(function($specific, $key) use (&$specificsArray){
            $values = [];
            foreach ($specific as $val){
                $values[] = $val['value'];
            }
            $specificsArray['NameValueList'][] = [
                'Name'  =>  $key,
                'Value'  =>  $values,
                'Source'  =>  'ItemSpecific',
            ];
        });

        $compatibilities = $request->get('compatibilities');
        $compatibilitiesArray = [];
        foreach ($compatibilities as $compatibility){
            $compatibilitiesArray['Compatibility'][] = [
                'NameValueList' =>  [
                    [
                        'Name'  =>  'Year',
                        'Value'  =>  $compatibility['year'],
                    ],
                    [
                        'Name'  =>  'Make',
                        'Value'  =>  $compatibility['make'],
                    ],
                    [
                        'Name'  =>  'Model',
                        'Value'  =>  $compatibility['model'],
                    ],
                    [
                        'Name'  =>  'Trim',
                        'Value'  =>  $compatibility['trim'],
                    ],
                    [
                        'Name'  =>  'Engine',
                        'Value'  =>  $compatibility['engine'],
                    ],
                ]
            ];
        }
        $images = [];
        foreach ($request->get('images') as $image){
            $images[] = $image;
        }
        $shippingServices = [];
        $priority = 1;
        foreach ($request->get('domestic_shipping_services') as $service){
            if(array_key_exists('is_free', $service)){
                if($service['is_free'] == 'true'){
                    $shippingServices[] = [
                        'FreeShipping'  =>  'true',
                        'ShippingService'   =>  $service['shipping_service'],
                        'ShippingServicePriority'   =>  $priority,
                    ];
                }else{
                    $shippingServices[] = [
                        'FreeShipping'  =>  'false',
                        'ShippingService'   =>  $service['shipping_service'],
                        'ShippingServicePriority'   =>  $priority,
                        'ShippingServiceCost'   =>  $service['cost'],
                        'ShippingServiceAdditionalCost'   =>  $service['additional_cost'],
                        'ShippingSurcharge'   =>  $service['surcharge'],
                    ];
                }
            }else{
                $shippingServices[] = [
                    'ShippingService'   =>  $service['shipping_service'],
                    'ShippingServicePriority'   =>  $priority,
                    'ShippingServiceCost'   =>  $service['cost'],
                    'ShippingServiceAdditionalCost'   =>  $service['additional_cost'],
                    'ShippingSurcharge'   =>  $service['surcharge'],
                ];
            }
            $priority++;
        }

        $reqArray = [
            'RequesterCredentials'  =>  [
                'eBayAuthToken' =>  $store->auth_token
            ],
            'Item'  =>  [
                'ItemID'    =>  $item->item_id,
                'Country'  =>  $request->get('country'),
                'Location'  =>  $request->get('location'),
                'DispatchTimeMax'  =>  $request->get('max_dispatch_time'),
                'ConditionID'  =>  $request->get('condition_id'),
                'Title'  =>  $request->get('title'),
                'SKU'  =>  $request->get('sku'),
                'PrimaryCategory'   =>  [
                    'CategoryID'    =>  $request->get('primary_category_id')
                ],
                'Description'  =>  $request->get('description'),
                'ProductListingDetails' =>  [
                    'UPC'  =>  $request->get('upc'),
                    //'IncludeStockPhotoURL'  =>  'true',
                    //'UseStockPhotoURLAsGallery'  =>  'true',
                    'ReturnSearchResultOnDuplicates'  =>  'true',
                ],
                'PictureDetails'    =>  [
                    'GalleryType'   =>  'Gallery',
                    'GalleryURL'  =>  $images[0],
                    'PictureURL'  =>  $images,
                ],
                'ItemSpecifics' =>  $specificsArray,
                'ItemCompatibilityList' =>  $compatibilitiesArray,
                'ListingType'   =>  'FixedPriceItem',
                'ListingDuration'  =>  $request->get('duration'),
                'StartPrice'  =>  $request->get('price'),
                'Quantity'  =>  $request->get('quantity'),
                'PaymentMethods'  =>  $request->get('payment_method', 'PayPal'),
                'PayPalEmailAddress'  =>  $request->get('paypal_email'),
                'ReturnPolicy'  =>  [
                    'ReturnsAcceptedOption'  =>  $request->get('return_option') == 'yes' ? 'ReturnsAccepted' : 'ReturnsNotAccepted',
                    'RefundOption'  =>  $request->get('refund_option'),
                    'ReturnsWithinOption'  =>  $request->get('returns_within'),
                    'Description'  =>  $request->get('return_policy_desc'),
                    'ShippingCostPaidByOption'  =>  $request->get('return_shipping_paid_by'),
                ],
                'ShippingPackageDetails'    =>  [
                    'PackageLength'  =>  $request->get('package_length'),
                    'PackageWidth'  =>  $request->get('package_width'),
                    'PackageDepth'  =>  $request->get('package_depth'),
                    'ShippingPackage'  =>  $request->get('shipping_package_type'),
                    'WeightMajor'  =>  $request->get('weight_major'),
                    'WeightMinor'  =>  $request->get('weight_minor'),
                ],
                'ShippingDetails'   =>  [
                    'ShippingType'  =>  'Flat',
                    'ShippingServiceOptions'    =>  $shippingServices
                ],
            ]
        ];

        $request_body = ArrayToXml::convert($reqArray, [
            'rootElementName'   =>  'ReviseItemRequest',
            '_attributes'   =>  [
                'xmlns' =>  'urn:ebay:apis:eBLBaseComponents'
            ]
        ], false, 'UTF-8');

        return $this->fetch($store, $request_body);
    }
}
