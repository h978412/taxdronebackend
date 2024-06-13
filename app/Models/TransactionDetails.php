<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;

    public $table = 'transaction_details';
    public $guarded = [];
    public $timestamps = false;


    public static function insertTransactionDetails($transNo,$amount,$provider,$ip){
        try{

            $createData = [
                'transaction_no'=>$transNo,
                'utr_no'=>$transNo,
                'amount'=>$amount,
                'gateway_provider'=>$provider,
                'status'=>'INITIATED',
                'requery_status'=>'PENDING',
                'client_ip'=>$ip,
                'provider_remark'=>''
            ];

            self::create($createData);


        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
}
