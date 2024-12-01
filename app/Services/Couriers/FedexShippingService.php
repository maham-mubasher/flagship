<?php

namespace App\Services\Couriers;

use App\Interfaces\ShippingInterface;
use Http;
use Setting;
use Illuminate\Support\Carbon;

class FedexShippingService implements ShippingInterface
{
    private $baseURL = 'https://apis-sandbox.fedex.com/';

    private $accessToken = '';

    public function __construct()
    {
        $response = Http::asForm()->post($this->getBaseUrl().'oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => Setting::get('fedex_key'),
            'client_secret' => Setting::get('fedex_secret')
        ]);

        $this->setAccessToken( $response->json()['access_token'] );
    }

    public function setAccessToken($accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getBaseUrl()
    {
        if ( Setting::get('fedex_mode', "0") !== "1" ) {

            return 'https://apis-sandbox.fedex.com/';
        } else {

            return 'https://apis.fedex.com/';
        }
    }

    public function createPickup(array $input_data)
    {
        $url = $this->getBaseUrl() . 'pickup/v1/pickups';
        $token = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'X-locale' => 'en_US',
            'Content-Type' => 'application/json',
        ];
        
        
        
        // $pickupDate = Carbon::parse($input_data['pickup_date']);
        // $pickupDate1 = $pickupDate->toIso8601String();

        $payload = array(
            "associatedAccountNumber" => array(
              "value" => "740561073"
            ),
            "originDetail" => array(
              "pickupLocation" => array(
                "contact" => array(
                  "companyName" => $input_data['company_name'],
                  "personName" => $input_data['sender_name'],
                  "phoneNumber" => $input_data['phone']
                ),
                "address" => array(
                  "streetLines" => array(
                    $input_data['address']
                  ),
                  "city" => $input_data['city'],
                  "stateOrProvinceCode" => "TN",
                  "postalCode" => $input_data['postal_code'],
                  "countryCode" => "US",
                  "residential" => true
                )
              ),
              "readyDateTimestamp" => '2020-04-21T11:00:00Z',
              "companyCloseTime" => "18:00:00"
            ),
            "carrierCode" => "FDXE",
            "expressFreightDetail" => array(
              "truckType" => "DROP_TRAILER_AGREEMENT",
              "service" => "INTERNATIONAL_ECONOMY_FREIGHT",
              "trailerLength" => "TRAILER_28_FT",
              "bookingNumber" => "1234AGTT",
              "dimensions" => array(
                "length" => 20,
                "width" => 15,
                "height" => 12,
                "units" =>  $input_data['unit']
              )
            )
        );

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'X-locale' => 'en_US',
            'Content-Type' => 'application/json',
        ])->post($url, $payload);
        // $response = $response->json();
        if ($response->failed()) {
            echo "HTTP Error #" . $response->status() . ": " . $response->body();
        } else {
            echo $body = "Body". $response->body();
            // $data = json_decode($body, true); 
            // $prn = $data['PickupCreationResponse']['PRN'];
            // return $prn;
        }
        dd($response);
        
        
    }

    public function cancelPickup(string $confirmation_number)
    {
        $url = $this->baseURL . 'pickup/v1/pickups/cancel';
        $token = $this->getAccessToken();
        $headers = [
            'Authorization: Bearer ' . $this->accessToken,
            'X-locale: en_US',
            'Content-Type: application/json',
        ];
        $payload = [
            "pickupConfirmationCode" => $confirmation_number,
            //"scheduledDate" => "2019-10-15", 
        ];

        $response = Http::withHeaders($headers)->put($url, $payload);
        // $response = $response->json();
        dd($response);
        if ($response->failed()) {
            echo "HTTP Error #" . $response->status() . ": " . $response->body();
            return false;
        } else {
            return true;
        }
        
    }

    public function create_shipment(array $input_data)
    {
        $url = $this->getBaseUrl() . 'ship/v1/shipments';
        $token = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'X-locale' => 'en_US',
            'Content-Type' => 'application/json',
        ];

        $payload = [
                "labelResponseOptions" => "URL_ONLY",
                "requestedShipment" => [
                    "shipper" => [
                        "contact" => [
                            "personName" => "SHIPPER NAME",
                            "phoneNumber" => 1234567890,
                            "companyName" => "Shipper Company Name"
                        ],
                        "address" => [
                            "streetLines" => [
                                "SHIPPER STREET LINE 1"
                            ],
                            "city" => "Memphis",
                            "stateOrProvinceCode" => "TN",
                            "postalCode" => 38116,
                            "countryCode" => "US"
                        ]
                    ],
                    "recipients" => [
                        [
                            "contact" => [
                                "personName" => "RECIPIENT NAME",
                                "phoneNumber" => 1234567890,
                                "companyName" => "Recipient Company Name"
                            ],
                            "address" => [
                                "streetLines" => [
                                    "RECIPIENT STREET LINE 1"
                                ],
                                "city" => "Irving",
                                "stateOrProvinceCode" => "TX",
                                "postalCode" => 75063,
                                "countryCode" => "US",
                                "residential" => true
                            ]
                        ]
                    ],
                    "shipDatestamp" => "2020-07-03",
                    "serviceType" => "GROUND_HOME_DELIVERY",
                    "packagingType" => "YOUR_PACKAGING",
                    "pickupType" => "USE_SCHEDULED_PICKUP",
                    "blockInsightVisibility" => false,
                    "shippingChargesPayment" => [
                        "paymentType" => "SENDER"
                    ],
                    "shipmentSpecialServices" => [
                        "specialServiceTypes" => [
                            "HOME_DELIVERY_PREMIUM"
                        ],
                        "homeDeliveryPremiumDetail" => [
                            "homedeliveryPremiumType" => "APPOINTMENT",
                            "deliveryDate" => "2020-07-07",
                            "phoneNumber" => [
                                "localNumber" => 1234567890
                            ]
                        ]
                    ],
                    "labelSpecification" => [
                        "imageType" => "PDF",
                        "labelStockType" => "PAPER_85X11_TOP_HALF_LABEL"
                    ],
                    "requestedPackageLineItems" => [
                        [
                            "weight" => [
                                "units" => "LB",
                                "value" => 10
                            ]
                        ]
                    ]
                ],
                "accountNumber" => [
                    "value" => "740561073"
                ]
            
                ];
                $response = Http::withHeaders($headers)->put($url, $payload);
                // $response = $response->json();
                
                if ($response->failed()) {
                    echo "HTTP Error #" . $response->status() . ": " . $response->body();
                    return false;
                } else {
                    return $response;
                }
        

    }

    public function cancelShipment(string $confirmation_number)
    {
        $url = $this->baseURL . 'ship/v1/shipments/cancel';
        $token = $this->getAccessToken();
        $headers = [
            'Authorization: Bearer ' . $this->accessToken,
            'X-locale: en_US',
            'Content-Type: application/json',
        ];
        $payload = [
            
                "accountNumber" => [
                "value" => "740561073"
                ],
                "trackingNumber"=> "794842623031"
        ];

        $response = Http::withHeaders($headers)->put($url, $payload);
        // $response = $response->json();
        if ($response->failed()) {
            echo "HTTP Error #" . $response->status() . ": " . $response->body();
            return false;
        } else {
            return $response;
        }
        
    }

    function getShippingRates(array $input_data)
    {
        $url = $this->getBaseUrl() . 'rate/v1/rates/quotes';
        $token = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'X-locale' => 'en_US',
            'Content-Type' => 'application/json',
        ];

        $payload = array(
            "accountNumber" => array(
                "value" => "740561073"
            ),
            "requestedShipment" => array(
                "shipper" => array(
                    "address" => array(
                        "postalCode" => 'V3A1N3',
                        "countryCode" => "CA"
                    )
                ),
                "recipient" => array(
                    "address" => array(
                        "postalCode" => "T5T 6R8",
                        "countryCode" => "CA"
                    )
                ),
                "pickupType" => "DROPOFF_AT_FEDEX_LOCATION",
                "rateRequestType" => array(
                    "ACCOUNT",
                    "LIST"
                ),
                "requestedPackageLineItems" => array(
                    array(
                        "weight" => array(
                            "units" => "LB",
                            "value" => 10
                        )
                    )
                )
            )
        );

        $response = Http::withHeaders($headers)->post($url, $payload);
        
        if ($response->failed()) {
            echo "HTTP Error #" . $response->status() . ": " . $response->body();
            return false;
        } else {
            return $response;
        }

    }
    
}
