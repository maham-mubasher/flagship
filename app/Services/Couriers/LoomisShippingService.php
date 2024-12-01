<?php

namespace App\Services\Couriers;

use SoapClient;
use SoapFault;
use App\Interfaces\ShippingInterface;
use SoapHeader;
use Setting;


class LoomisShippingService implements ShippingInterface
{
    private $wsdlUrl;
    private $username;
    private $password;


    public function createPickup($input_data)
    {
        $this->wsdlUrl = 'https://sandbox.loomis-express.com/axis2/services/USSAddonsService?wsdl';
        $this->username = Setting::get('loomis_test_api_user');
        $this->password = Setting::get('loomis_test_api_password');

       /* $request = [
            'xsd:user_id' => $this->username,
            'xsd:password' => $this->password,
            'xsd:pickup' => [
                'xsd1:closing_time' => '1800',
                'xsd1:comments' => 'Ring the doorbell',
                'xsd1:collect' => false,
                'xsd1:courier' => 'L',
                'xsd1:number_of_parcels' => 2,
                'xsd1:pickup_address_line_1' => '123 Main Street',
                'xsd1:pickup_address_line_2' => 'Unit 2',
                'xsd1:pickup_attention' => 'William',
                'xsd1:pickup_city' => 'MISSISSAUGA',
                'xsd1:pickup_date' => '20210724',
                'xsd1:pickup_email' => 'clientemail@email.com',
                'xsd1:pickup_location' => 'Back entrance',
                'xsd1:pickup_name' => 'Company Name',
                'xsd1:pickup_phone' => '6056661212',
                'xsd1:pickup_extension' => '',
                'xsd1:pickup_postal_code' => 'L5R3R3',
                'xsd1:pickup_province' => 'ON',
                'xsd1:ready_time' => '1200',
                'xsd1:shipper_num' => 'AB1234',
                'xsd1:unit_of_measure' => 'L',
                'xsd1:weight' => 10.5,
            ],
        ];
        */
        

        $request = [
            'user_id' => $this->username,
            'password' => $this->password,
            'pickup' => [
                'closing_time' => '1800',
                'comments' => 'Ring the doorbell',
                'collect' => false,
                'courier' => 'L',
                'number_of_parcels' => 2,
                'pickup_address_line_1' => '123 Main Street',
                'pickup_address_line_2' => 'Unit 2',
                'pickup_attention' => 'William',
                'pickup_city' => 'MISSISSAUGA',
                'pickup_date' => '20210724',
                'pickup_email' => 'clientemail@email.com',
                'pickup_location' => 'Back entrance',
                'pickup_name' => 'Company Name',
                'pickup_phone' => '6056661212',
                'pickup_extension' => '',
                'pickup_postal_code' => 'L5R3R3',
                'pickup_province' => 'ON',
                'ready_time' => '1200',
                'shipper_num' => 'AB1234',
                'unit_of_measure' => 'L',
                'weight' => 10.5,
            ],
        ];

        $options = [
            'trace' => true,
            'exceptions' => true,
            'login' => $this->username,
            'password' => $this->password,
            'uri' => 'http://ws.addons.uss.transforce.ca',
        ];


        $client = new SoapClient($this->wsdlUrl, $options);
       
        $client->__setLocation('https://sandbox.loomis-express.com/axis2/services/USSAddonsService');
        $client->__setSoapHeaders(new SoapHeader('http://ws.addons.uss.transforce.ca', 'TargetNamespace'));
        dump($client);

        try {
            $response = $client->SchedulePickUp($request);
            //$response = $client->__soapCall('schedulePickup', $request);

            dd($response);
            return $response;
        } catch (SoapFault $e) {
            $errorMessage = $e->getMessage();

            // Display the error message
            echo "SOAP Error: " . $errorMessage;
        }
    }

    public function cancelPickup(string $pickupId)
    {
        
    }
}
