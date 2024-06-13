<?php

namespace App\Libraries\PaymentGateway;


class Razorpay
{

    private  $returnUrl;
    private  $transNo;
    private  $amount;

    public function processPayment($amount,$transNo,$returnUrl){
        $this->amount = $amount;
        $this->transNo = $transNo;
        $this->returnUrl = $returnUrl;
        $response = $this->apiCall(env("RAZORPAY_PAYMENT_URL"),$this->getHeaders(),$this->createOrderRequest());
        $response = json_decode($response,true);
        return $response;

    }

    private function createOrderRequest(){
        try{
            $request = [
                'amount'=>$this->amount,
                'currency'=>"INR",
                'receipt'=>$this->transNo,
                'notes'=>[
                    'trans_no'=>$this->transNo,
                    'return_url'=>$this->returnUrl
                ],
                'partial_payment'=>false,
            ];

            return $request;

        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    private function getHeaders(){
        try{
            $headers = [
                "content-type: application/json"
            ];
            return $headers;
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }


    private function apiCall($url,$headers,$request){
        try{

            \Log::error(['createOrderRequest'=>$request]);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_USERPWD=>env("RAZORPAY_KEY_ID") . ":" . env("RAZORPAY_KEY_SECRET"),
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($request),
                CURLOPT_HTTPHEADER => $headers
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }


    



    


 
}
