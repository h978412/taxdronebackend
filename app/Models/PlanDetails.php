<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetails extends Model
{
    use HasFactory;

    public $table = 'plan_details';
    public $guarded = [];

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
}
