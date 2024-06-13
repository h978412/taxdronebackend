<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPurchaseDetails extends Model
{
    use HasFactory;

    public $table = 'plan_purchase_details';
    public $guarded = [];
    public $timestamps = false;


    public static function chkIfPlanAlreadyActive($userId,$planId){
        try{
            $userActivePlan = self::where('plan_id',$planId)->where('user_id',$userId)->where('status','ACTIVE')->get();

            if(!count($userActivePlan)){
                return [];
            }

            return $userActivePlan->toArray();
            
            
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    public static function insertPlanDetails($userId,$planId,$tranNo){
        try{

            $planPurchaseId = Date("YmdHis") . mt_rand(1000,9999);

            
            $createData = [
                'plan_purchase_id'=>$planPurchaseId,
                'transaction_id'=>$tranNo,
                'purchase_date'=>Date("Y-m-d H:i:s"),
                'expiry_date'=>Date("Y-m-d H:i:s"),
                'purchased_by'=>$userId,
                'plan_id'=>$planId,
                'status'=>'INITIATED',
                'user_id'=>$userId
            ];

            self::create($createData);
            
            
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
}
