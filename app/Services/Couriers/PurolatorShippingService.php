<?php

namespace App\Services\Couriers;

use App\Classes\ShippingApiResponse;
use App\Classes\Utils;
use App\Interfaces\ShippingInterface;
use SoapClient;
use SoapHeader;
use Setting;
use stdClass;
// use function App\Services\createPWSSOAPClient;

class PurolatorShippingService implements ShippingInterface
{

    

    public function createPWSSOAPClient_pickup()
    {
        $wsdlPath = public_path('wsdl/PickUpService.wsdl');
        $key = Setting::get('purolator_development_key');
        $password = Setting::get('purolator_development_password');
        $user_token = '';

        $client = new SoapClient( $wsdlPath,
            array(
				'trace'		=>	true,
				'location'	=>	"https://devwebservices.purolator.com/EWS/V1/PickUp/PickUpService.asmx",
				'uri'		=>	"http://purolator.com/pws/datatypes/v1",
				'login'		=>	$key,
				'password'	=>	$password,
            )
            );
        //Define the SOAP Envelope Headers
        $headers[] = new SoapHeader ( 'http://purolator.com/pws/datatypes/v1',
                                        'RequestContext',
                                        array (
                                                'Version'           =>  '1.2',
                                                'Language'          =>  'en',
                                                'GroupID'           =>  'xxx',
                                                'RequestReference'  =>  'Rating Example',
                                                'UserToken'         =>  $user_token
                                            )
                                    );
        //Apply the SOAP Header to your client
        $client->__setSoapHeaders($headers);

        return $client;
    }

    public function createPWSSOAPClient_shipment()
    {
        $wsdlPath = public_path('wsdl/PickUpService.wsdl');
        $key = Setting::get('purolator_development_key');
        $password = Setting::get('purolator_development_password');
        $user_token = '';
        $client = new SoapClient( $wsdlPath,
                        array	(
                                            'trace'			=>	true,
                                            'location'		=>	"https://devwebservices.purolator.com/EWS/V2/Shipping/ShippingService.asmx",
                                            'uri'			=>	"http://purolator.com/pws/datatypes/v2",
                                            'login'			=>	$key,
                                            'password'		=>	$password
                                )
                    );
        $headers[] = new SoapHeader ( 'http://purolator.com/pws/datatypes/v2', 
                                        'RequestContext', 
                                        array (
                                                'Version'           =>  '2.0',
                                                'Language'          =>  'en',
                                                'GroupID'           =>  'xxx',
                                                'RequestReference'  =>  'Shipping Example',
                                                'UserToken'         =>  $user_token
                                            )
                                    ); 
        $client->__setSoapHeaders($headers);

        return $client;
    }

    function createPWSSOAPClient_rate()
    {
        $wsdlPath = public_path('wsdl/PickUpService.wsdl');
        $key = Setting::get('purolator_development_key');
        $password = Setting::get('purolator_development_password');
        $user_token = '';
        $client = new SoapClient( "https://devwebservices.purolator.com/EWS/V2/Estimating/EstimatingService.asmx?wsdl", 
                                array	(
                                        'trace'			=>	true,
                                        'location'	=>	"https://devwebservices.purolator.com/EWS/V2/Estimating/EstimatingService.asmx",
                                        'uri'				=>	"http://purolator.com/pws/datatypes/v2",
                                        'login'			=>	$key,
                                        'password'	=>	$password,
                                    )
                            );
        //Define the SOAP Envelope Headers
        $headers[] = new SoapHeader ( 'http://purolator.com/pws/datatypes/v2', 
                                        'RequestContext', 
                                    array (
                                            'Version'           =>  '2.0',
                                            'Language'          =>  'en',
                                            'GroupID'           =>  'xxx',
                                            'RequestReference'  =>  'Rating Example',
                                            'UserToken'         =>  $user_token
                                        )
                                ); 
        //Apply the SOAP Header to your client                            
        $client->__setSoapHeaders($headers);

        return $client;
    }



    public function createPickup(array $input_data)
    {
       
        try {
           
            $client = $this->createPWSSOAPClient_pickup();
            

            $request = new stdClass();
            $request->PickupInstruction = new stdClass();
            $request->PickupInstruction->TotalWeight = new stdClass();
            $request->PickupInstruction->SupplyRequestCodes = new stdClass();
            $request->Address = new stdClass();
            $request->NotificationEmails = new stdClass();
            $request->Address->PhoneNumber = new stdClass();
            $request->ShipmentSummary = new stdClass();
            $request->ShipmentSummary->ShipmentSummaryDetails = new stdClass();
            $request->ShipmentSummary->ShipmentSummaryDetails->ShipmentSummaryDetail = new stdClass();
            $request->ShipmentSummary->ShipmentSummaryDetails->ShipmentSummaryDetail->TotalWeight = new stdClass();

            $request->BillingAccountNumber = 'F271';
            $request->PickupInstruction->Date = '2023-09-23'; //$input_data['pickup_date'];
            $request->PickupInstruction->AnyTimeAfter = "1200";
            $request->PickupInstruction->UntilTime = "1500";
            
            $request->PickupInstruction->TotalWeight->Value = "1";
            $request->PickupInstruction->TotalWeight->WeightUnit = "kg";
            $request->PickupInstruction->TotalPieces = "1";
            $request->PickupInstruction->BoxIndicator = "";
            $request->PickupInstruction->PickUpLocation = "BackDoor";
            $request->PickupInstruction->AdditionalInstructions = "";
            $request->PickupInstruction->SupplyRequestCodes->SupplyRequestCode = "PuroletterExpressEnvelope";												      
            
            $request->PickupInstruction->LoadingDockAvailable=false;
            $request->PickupInstruction->TrailerAccessible=false;
            $request->PickupInstruction->ShipmentOnSkids=false;
            $request->PickupInstruction->NumberOfSkids=0;
            
            $request->Address->Name = "PWS User";
            $request->Address->Company = "Company";
            $request->Address->Department = "Department";
            $request->Address->StreetNumber = "5280";
            $request->Address->StreetSuffix = "";
            $request->Address->StreetName ="Solar";
            $request->Address->StreetType ="Drive";
            $request->Address->StreetDirection = "";
            $request->Address->Suite = "";
            $request->Address->Floor = "";
            $request->Address->StreetAddress2 = "";
            $request->Address->StreetAddress3 = "";
            $request->Address->City = "Mississauga";
            $request->Address->Province = "ON";
            $request->Address->Country = "CA";
            $request->Address->PostalCode = "L4W5M8";
            $request->Address->PhoneNumber->CountryCode = "1";
            $request->Address->PhoneNumber->AreaCode = "905";
            $request->Address->PhoneNumber->Phone = "7128101";
            $request->NotificationEmails->NotificationEmail="your_email@email.com";
            $request->ShipmentSummary->ShipmentSummaryDetails->ShipmentSummaryDetail->DestinationCode="DOM";
            $request->ShipmentSummary->ShipmentSummaryDetails->ShipmentSummaryDetail->ModeOfTransport= "Ground";//Express, Ground, Express/Ground.
            $request->ShipmentSummary->ShipmentSummaryDetails->ShipmentSummaryDetail->TotalPieces="70";
            $request->ShipmentSummary->ShipmentSummaryDetails->ShipmentSummaryDetail->TotalWeight->Value = "100";
            $request->ShipmentSummary->ShipmentSummaryDetails->ShipmentSummaryDetail->TotalWeight->WeightUnit = "kg";
            
            //Execute the request and capture the response
            $response = $client->SchedulePickUp($request);
            if($response)
            {
                $confirmation_number = $response->PickUpConfirmationNumber;
                //return $confirmation_number;
            }
        } catch(\Exception $exception) {

            $exception->getMessage();
        }
    }

    public function getShippingRates(array $input_data)
    {
        try {

            $client = $this->createPWSSOAPClient_rate();

            $request = new stdClass();
            $request->ReceiverAddress = new stdClass();
            $request->TotalWeight = new stdClass();

            $request->BillingAccountNumber = '';
            
            $request->SenderPostalCode = "V3A1N3";
            //Populate the Desination Information
            $request->ReceiverAddress->City = "EDMONTON";
            $request->ReceiverAddress->Province = "AB";
            $request->ReceiverAddress->Country = "CA";
            $request->ReceiverAddress->PostalCode = "T5T 6R8";  
            //Populate the Package Information
            $request->PackageType = "CustomerPackaging";
            //Populate the Shipment Weight
            $request->TotalWeight->Value = "10";
            $request->TotalWeight->WeightUnit = "lb";
            //Execute the request and capture the response
            $response = $client->GetQuickEstimate($request);

            if ($response) {
             return $response;
            } else {
                return null;
            }
        } catch(\Exception $exception) {
            dd($exception);
        }

    }



    public function cancelPickup(string $pickupId)
    {

    }

    public function create_shipment(array $input_data)
    {
        try {
        $client = $this->createPWSSOAPClient_shipment();

        $request = new stdClass();
        $request->Shipment = new stdClass();
        $request->Shipment->SenderInformation = new stdClass();
        $request->Shipment->SenderInformation->Address = new stdClass();
        $request->Shipment->SenderInformation->Address->PhoneNumber = new stdClass();
        $request->Shipment = new stdClass();
        $request->Shipment->ReceiverInformation = new stdClass();
        $request->Shipment->ReceiverInformation->Address = new stdClass();
        $request->Shipment->ReceiverInformation->Address->PhoneNumber = new stdClass();
        $request->Shipment->PackageInformation = new stdClass();
        $request->Shipment->PackageInformation->TotalWeight = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0] = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Weight = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Length = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Width = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Height = new stdClass();
        $request->Shipment->PaymentInformation = new stdClass();
        $request->Shipment->PickupInformation = new stdClass();
        $request->Shipment->TrackingReferenceInformation = new stdClass();
        $request->Shipment->OtherInformation = new stdClass();
        $request->Shipment->ProactiveNotification = new stdClass();
        $request->Shipment->ProactiveNotification = new stdClass();
        $request->Shipment->Subscriptions = new stdClass();
        $request->Shipment->Subscriptions->Subscription = new stdClass();
        $request->PrinterType = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Options = new stdClass();
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Options->OptionIDValuePair = new stdClass();
        //Populate the Origin Information
        $request->Shipment->SenderInformation->Address->Name = "Sender Name";
        $request->Shipment->SenderInformation->Address->Company = "Purolator Ltd";
        $request->Shipment->SenderInformation->Address->Department = "Web Services";
        $request->Shipment->SenderInformation->Address->StreetNumber = "1234";
        $request->Shipment->SenderInformation->Address->StreetName = "Main Street";
        $request->Shipment->SenderInformation->Address->StreetType = "Street";
        $request->Shipment->SenderInformation->Address->City = "Mississauga";
        $request->Shipment->SenderInformation->Address->Province = "ON";
        $request->Shipment->SenderInformation->Address->Country = "CA";
        $request->Shipment->SenderInformation->Address->PostalCode = "L4W5M8";    
        $request->Shipment->SenderInformation->Address->PhoneNumber->CountryCode = "1";
        $request->Shipment->SenderInformation->Address->PhoneNumber->AreaCode = "905";
        $request->Shipment->SenderInformation->Address->PhoneNumber->Phone = "5555555";

        //Populate the Desination Information
        $request->Shipment->ReceiverInformation->Address->Name = "Receiver Name";
        $request->Shipment->ReceiverInformation->Address->Company = "Purolator Ltd";
        $request->Shipment->ReceiverInformation->Address->Department = "Web Services";
        $request->Shipment->ReceiverInformation->Address->StreetNumber = "2245";
        $request->Shipment->ReceiverInformation->Address->StreetName = "Douglas Road";
        $request->Shipment->ReceiverInformation->Address->StreetType = "Street";
        $request->Shipment->ReceiverInformation->Address->City = "Burnaby";
        $request->Shipment->ReceiverInformation->Address->Province = "BC";
        $request->Shipment->ReceiverInformation->Address->Country = "CA";
        $request->Shipment->ReceiverInformation->Address->PostalCode = "V5C1A1";    
        $request->Shipment->ReceiverInformation->Address->PhoneNumber->CountryCode = "1";
        $request->Shipment->ReceiverInformation->Address->PhoneNumber->AreaCode = "604";
        $request->Shipment->ReceiverInformation->Address->PhoneNumber->Phone = "2982181";

        //Future Dated Shipments - YYYY-MM-DD format (optional)
        //$request->Shipment->ShipmentDate = "YOUR_SHIPMENT_DATE_HERE";

        //Populate the Package Information
        $request->Shipment->PackageInformation->TotalWeight->Value = "40";
        $request->Shipment->PackageInformation->TotalWeight->WeightUnit = "lb";
        $request->Shipment->PackageInformation->TotalPieces = "1";
        $request->Shipment->PackageInformation->ServiceID = "PurolatorExpress";

        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Weight->Value = "40";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Weight->WeightUnit = "lb";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Length->Value = "40";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Length->DimensionUnit = "in";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Width->Value = "10";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Width->DimensionUnit = "in";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Height->Value = "2";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Height->DimensionUnit = "in";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Options->OptionIDValuePair[0]->ID="SpecialHandling";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Options->OptionIDValuePair[0]->Value="true";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Options->OptionIDValuePair[1]->ID="SpecialHandlingType";
        $request->Shipment->PackageInformation->PiecesInformation->Piece[0]->Options->OptionIDValuePair[1]->Value="LargePackage";
        //Define OptionsInformation
        //ResidentialSignatureDomestic
        $request->Shipment->PackageInformation->OptionsInformation->Options->OptionIDValuePair->ID = "ResidentialSignatureDomestic";
        $request->Shipment->PackageInformation->OptionsInformation->Options->OptionIDValuePair->Value = "true";
        //Populate the Payment Information
        $request->Shipment->PaymentInformation->PaymentType = "Sender";
        $request->Shipment->PaymentInformation->RegisteredAccountNumber = '';
        $request->Shipment->PaymentInformation->BillingAccountNumber = 'F271';

        //Populate the Pickup Information
        $request->Shipment->PickupInformation->PickupType = "DropOff";

        //Shipment Reference (optional)
        $request->Shipment->TrackingReferenceInformation->Reference1 = "Reference For Shipment";

        //Shipment Notes / Special Instructions (optional)
        $request->Shipment->OtherInformation->SpecialInstructions = "Notes go here";

        // Define Proactive Notification Email details (optional)
        $request->Shipment->ProactiveNotification->RequestorName = "MyName";
        $request->Shipment->ProactiveNotification->RequestorEmail = "test@test.com ";
        $request->Shipment->ProactiveNotification->Subscriptions->Subscription->Name = "MyName";
        $request->Shipment->ProactiveNotification->Subscriptions->Subscription->Email = "test@test.com";
        $request->Shipment->ProactiveNotification->Subscriptions->Subscription->NotifyWhenExceptionOccurs = "true";
        $request->Shipment->ProactiveNotification->Subscriptions->Subscription->NotifyWhenDeliveryOccurs = "true";


        //Define the Shipment Document Type
        $request->PrinterType = "Thermal";


        //Execute the request and capture the response
        $response = $client->CreateShipment($request);

        dd($response);

    } catch(\Exception $exception) {
        dd($exception);
    }

    }

    public function cancelShipment(string $confirmation_id)
    {
        return true;
    }
}
