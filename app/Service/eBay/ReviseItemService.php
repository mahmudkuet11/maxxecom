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

        $specifics = $request->get('specifics');
        $specificsArray = [];
        foreach ($specifics as $specific){
            $specificsArray[] = [
                'NameValueList' =>  [
                    'Name'  =>  $specific['name'],
                    'Value'  =>  $specific['value'],
                    'Source'  =>  'ItemSpecific',
                ]
            ];
        }
        $compatibilities = $request->get('compatibilities');
        $compatibilitiesArray = [];
        foreach ($compatibilities as $compatibility){
            $compatibilitiesArray[] = [
                'Compatibility' =>  [
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
                ]
            ];
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
                    'IncludeStockPhotoURL'  =>  true,
                    'UseStockPhotoURLAsGallery'  =>  true,
                    'ReturnSearchResultOnDuplicates'  =>  true,
                ],
                'PictureDetails'    =>  [
                    'GalleryType'   =>  'Gallery',
                    'GalleryURL'  =>  'https://vignette2.wikia.nocookie.net/harrypotter/images/0/00/Harry_James_Potter34.jpg',
                    'PictureURL'  =>  'https://vignette2.wikia.nocookie.net/harrypotter/images/0/00/Harry_James_Potter34.jpg',
                ],
                'ListingType'   =>  'FixedPriceItem',
                'ListingDuration'  =>  $request->get('duration'),
                'BuyItNowPrice'  =>  $request->get('price'),
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
                ]
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