<?php

namespace App\Services\Couriers;

use App\Interfaces\ShippingInterface;
use Http;
use Setting;
use Symfony\Component\HttpFoundation\AcceptHeader;

class UpsShippingService implements ShippingInterface
{
    private $baseURL = 'https://wwwcie.ups.com/';

    protected $client_id = '';

    protected  $client_secret = '';

    protected $clientID = '';

    private $accessToken = '';

    public function __construct()
    {
        $this->client_id = Setting::get('ups_client_id');
        $this->client_secret = Setting::get('ups_client_secret');
        $this->clientID = base64_encode($this->client_id. ":" .$this->client_secret);
        
        $response = Http::asForm()->withHeaders([
            "Authorization" => "Basic ".$this->clientID,
        ])->post('https://wwwcie.ups.com/security/v1/oauth/token', [
            'grant_type' => 'client_credentials',
        ]);

        $oAuthResponse = $response->json();
        $this->accessToken = $oAuthResponse['access_token'];
    }

    public function refresh_token()
    {
        $this->client_id = Setting::get('ups_client_id');
        $this->client_secret = Setting::get('ups_client_secret');
        $this->clientID = base64_encode($this->client_id. ":" .$this->client_secret);
        
        $response = Http::asForm()->withHeaders([
            "Content-Type" => "application/x-www-form-urlencoded",
            "Authorization" => "Basic ".$this->clientID,
        ])->post('https://wwwcie.ups.com/security/v1/oauth/refresh', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->accessToken,
        ]);

        if ($response->successful()) {
            dump( $response->body());
        } else {
            dump("Error: " . $response->status() . ": " . $response->body());
        }

        $oAuthResponse = $response->json();
        dd($oAuthResponse);
        $this->accessToken = $oAuthResponse['access_token'];
    }


    public function createPickup(array $input_data)
    {
       
        $version = 'v1';
        $headers = [
            "Authorization" => "Bearer " . $this->accessToken,
            "Content-Type" => "application/json",
            "transId" => "string",
            "transactionSrc" => "testing"
        ];

        $pickup_date = str_replace( '-', '', $input_data['pickup_date']);
        $time_until = str_replace( ':', '', $input_data['time_until']);
        $time_from = str_replace( ':', '', $input_data['time_from']);
        
        $payload = [
            "PickupCreationRequest" => [
                "RatePickupIndicator" => "N",
                "Shipper" => array(
                "Account" => array(
                    "AccountNumber" => Setting::get('ups_account_number'),
                    "AccountCountryCode" => "US"
                )
                ),
                "PickupDateInfo" => array(
                "CloseTime" => $time_until,
                "ReadyTime" => $time_from,
                "PickupDate" => $pickup_date //20110612
                ),
                "PickupAddress" => array(
                "CompanyName" => $input_data['company_name'],
                "ContactName" => $input_data['sender_name'],
                "AddressLine" => $input_data['address'],
                "Room" => $input_data['suite'],
                "Floor" => "2",
                "City" => $input_data['city'],
                "StateProvince" => "NJ",
                "Urbanization" => "",
                "PostalCode" => "07401",//$input_data['postal_code'],
                "CountryCode" => "US",
                "ResidentialIndicator" => "Y",
                "PickupPoint" => "Lobby",
                "Phone" => array(
                    "Number" => $input_data['phone'],
                    "Extension" => $input_data['ext']
                )
                ),
                "AlternateAddressIndicator" => "Y",
                "PickupPiece" => array(
                array(
                    "ServiceCode" => "001",
                    "Quantity" => "27",
                    "DestinationCountryCode" => "US",
                    "ContainerCode" => "01"
                ),
                array(
                    "ServiceCode" => "012",
                    "Quantity" => "4",
                    "DestinationCountryCode" => "US",
                    "ContainerCode" => "01"
                )
                ),
                "TotalWeight" => array(
                "Weight" => $input_data['weight'],
                "UnitOfMeasurement" => 'LBS',
                ),
                "OverweightIndicator" => "N",
                "PaymentMethod" => "01",
                "SpecialInstruction" => "Test ",
                "ReferenceNumber" => "CreatePickupRef",
                "Notification" => array(
                "ConfirmationEmailAddress" => "test@ups.com",
                "UndeliverableEmailAddress" => "test@ups.com"
                ),
                "CSR" => array(
                "ProfileId" => "1 Q83 122",
                "ProfileCountryCode" => "US"
                )
            ]
        ];

        $response = Http::withHeaders($headers)
            ->post("https://wwwcie.ups.com/api/pickupcreation/" . $version . "/pickup", $payload);

        if ($response->failed()) {
            return null;
            //echo "HTTP Error #" . $response->status() . ": " . $response->body();
        } else {
            echo $body = $response->body();
            $data = json_decode($body, true); 
            $prn = $data['PickupCreationResponse']['PRN'];
            return $prn;
        }

       
    }

    public function cancelPickup(string $prn)
    {
        $version = 'v1';
        $headers = [
            "Authorization" => "Bearer " . $this->accessToken,
            "Prn" => $prn,
            "transId" => "string",
            "transactionSrc" => "testing"
        ];

        $response = Http::withHeaders($headers)
            ->post("https://wwwcie.ups.com/api/shipments/" . $version . "/pickup", $prn);

        if ($response->failed()) {
            echo "HTTP Error #" . $response->status() . ": " . $response->body();
        } else {
            echo $body = $response->body();
            // $data = json_decode($body, true); 
            // $prn = $data['PickupCreationResponse']['PRN'];
            // return $prn;
            dd(1);
        }
    }

    function getShippingRates(array $input_data)
    {
       // $this->refresh_token();
        $version = 'v1';
        
        $headers = [
            "Authorization" => "Bearer " . $this->accessToken,
            "Content-Type" => "application/json",
            "transId" => "string",
            "transactionSrc" => "testing"
        ];
        $requestOption = "rate";
        $query = [
            "additionalinfo" => "string"
        ];

        $payload = array(
          "RateRequest" => array(
            "Request" => array(
              "RequestOption" => "Rate",
              "TransactionReference" => array(
                "CustomerContext" => "CustomerContext",
                "TransactionIdentifier" => "TransactionIdentifier"
              )
            ),
            "Shipment" => array(
              "Shipper" => array(
                "Name" => "ShipperName",
                "ShipperNumber" => Setting::get('ups_account_number'),
                "Address" => array(
                  "AddressLine" => array(
                    "ShipperAddressLine",
                    "ShipperAddressLine",
                    "ShipperAddressLine"
                  ),
                  "City" => "TIMONIUM",
                  "StateProvinceCode" => "MD",
                  "PostalCode" => "21093",
                  "CountryCode" => "US"
                )
              ),
              "ShipTo" => array(
                "Name" => "ShipToName",
                "Address" => array(
                  "AddressLine" => array(
                    "ShipToAddressLine",
                    "ShipToAddressLine",
                    "ShipToAddressLine"
                  ),
                  "City" => "Alpharetta",
                  "StateProvinceCode" => "GA",
                  "PostalCode" => "30005",
                  "CountryCode" => "US"
                )
              ),
              "ShipFrom" => array(
                "Name" => "ShipFromName",
                "Address" => array(
                  "AddressLine" => array(
                    "ShipFromAddressLine",
                    "ShipFromAddressLine",
                    "ShipFromAddressLine"
                  ),
                  "City" => "TIMONIUM",
                  "StateProvinceCode" => "MD",
                  "PostalCode" => "21093",
                  "CountryCode" => "US"
                )
              ),
              "PaymentDetails" => array(
                "ShipmentCharge" => array(
                  array(
                    "Type" => "01",
                    "BillShipper" => array(
                      "AccountNumber" => Setting::get('ups_account_number')
                    )
                  )
                )
              ),
              "Service" => array(
                "Code" => "03",
                "Description" => "Ground"
              ),
              "NumOfPieces" => "1",
              "Package" => array(
                array(
                  "SimpleRate" => array(
                    "Description" => "SimpleRateDescription",
                    "Code" => "XS"
                  ),
                  "PackagingType" => array(
                    "Code" => "02",
                    "Description" => "Packaging"
                  ),
                  "Dimensions" => array(
                    "UnitOfMeasurement" => array(
                      "Code" => "IN",
                      "Description" => "Inches"
                    ),
                    "Length" => "5",
                    "Width" => "5",
                    "Height" => "5"
                  ),
                  "PackageWeight" => array(
                    "UnitOfMeasurement" => array(
                      "Code" => "LBS",
                      "Description" => "Pounds"
                    ),
                    "Weight" => "000010"
                  )
                )
              )
            )
          )
        );

        
        echo "<pre>";
        print_r($payload);
        print(json_encode($payload));
        
        $url = "https://wwwcie.ups.com/api/rating/" . $version . "/" . $requestOption; //. "?" . http_build_query($query);
        
        print($this->accessToken);
       
        $response = Http::withHeaders($headers)->post($url, $payload);
        dd($response);

        if ($response->successful()) {
            return $response->body();
        } else {
            return "Error: " . $response->status() . ": " . $response->body();
        }
    }

}
