<?php

namespace Todocoding\Orgamax;

use Exception;
use Illuminate\Support\Facades\Storage;
use JsonException;

class Orgamax{

 public function CreateCustomer($customer){

    $bearer = $this->GenerateToken();
    $authorization = "Authorization: Bearer $bearer";

    $data['customerDefaultAddress'] = [
        "billingAddress" =>[
            "firstName" => $customer['firstName'],
            "lastName" => $customer['lastName'],
            "email"=> $customer['email'],
            "street" => $customer['street'],
            "city" => $customer['city'],
            "zipCode" => $customer['zipcode'],
            "kind" => $customer['kind'],
            "mobile" => $customer['mobile'],

        ],
    ];

    $data_string = json_encode($data);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.orgamax.de/openapi/customer/");
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', $authorization)
    );

    $result = curl_exec($ch);
    $resultArray = json_decode($result);

    if (isset($resultArray) && $resultArray != null && !isset($resultArray->error)) {
        return $resultArray;
    } else {
        if (isset($resultArray->error)) {

            return $resultArray;
        } else {
            return null;
        }
    }
 }
 public function GenerateToken(){

    $apiKey = config('orgamax.consumer_key');
    $secretKey = config('orgamax.consumer_secret');
    $iid = config('orgamax.consumer_iid');
        $data= [
        "ownershipId" =>$iid,
    ];

    $data_string = json_encode($data);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.orgamax.de/openapi/auth/token");
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $apiKey.':'.$secretKey);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json')
    );

    $result = curl_exec($ch);
    $resultArray = json_decode($result);
    //dd($resultArray->token);
    return $resultArray->token;
 }

}
