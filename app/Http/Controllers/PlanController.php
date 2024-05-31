<?php

namespace App\Http\Controllers;

use App\Models\PlanDetails;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function getPlans(Request $request){
        try{
           $plan =  PlanDetails::getAllPlans();

           return response()->json($plan,200);

        }catch(\Exception $ex){
            $data = ['msg'=>$ex->getMessage()];
            return response()->json($data,400);
        }
    }

    public function getPlansForCategory(Request $request, String $category){
        try{
           $plan =  PlanDetails::getPlanWithCategory($category);

           return response()->json($plan,200);

        }catch(\Exception $ex){
            $data = ['msg'=>$ex->getMessage()];
            return response()->json($data,400);
        }
    }

    public function getPlanDetails(Request $request, String $planId){
        try{
            
        }catch(\Exception $ex){
            $data = ['msg'=>$ex->getMessage()];
            return response()->json($data,400);
        }
    }

}
