<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetails extends Model
{
    use HasFactory;

    public $table = 'plan_details';
    public $guarded = [];
    public $timestamps = false;


    public static function getAllPlans()
    {
        try {
            return self::all()->toArray();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getPlanWithCategory($category)
    {
        try {
            return self::where('category',$category)->get();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function isPlanAvailable($planId){
        try {
            $plans = self::where('plan_id',$planId)->where('status','ACTIVE')->get();

            if(count($plans) == 0){
                throw new \Exception("Plan you are looking for is not available at this moment, Kindly try with another plan");
            }

            $plan = $plans[0];
            return $plan;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
}
