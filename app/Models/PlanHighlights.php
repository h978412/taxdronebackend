<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanHighlights extends Model
{
    use HasFactory;

    public static function getHighlightForPlan($planId){
        try{
            return self::where('plan_id',$planId)->get()->toArray();
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }
}
