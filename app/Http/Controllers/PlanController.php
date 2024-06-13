<?php

namespace App\Http\Controllers;

use App\Libraries\GenerateUniqueTransNo;
use App\Libraries\PaymentGateway\Razorpay;
use App\Models\PlanDetails;
use App\Models\PlanPurchaseDetails;
use App\Models\TransactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    public function getPlans(Request $request)
    {
        try {
            \Log::error("There is an error");
            $plan = PlanDetails::getAllPlans();

            return response()->json($plan, 200);

        } catch (\Exception $ex) {
            $data = ['msg' => $ex->getMessage()];
            return response()->json($data, 400);
        }
    }

    public function getPlansForCategory(Request $request, string $category)
    {
        try {
            $plan = PlanDetails::getPlanWithCategory($category);

            return response()->json($plan, 200);

        } catch (\Exception $ex) {
            $data = ['msg' => $ex->getMessage()];
            return response()->json($data, 400);
        }
    }

    public function getPlanDetails(Request $request, string $planId)
    {
        try {

        } catch (\Exception $ex) {
            $data = ['msg' => $ex->getMessage()];
            return response()->json($data, 400);
        }
    }

    public function purchasePlan(Request $request)
    {
        try {
            $postData = $request->all();
            $ip = $request->ip();

            $validator = Validator::make($postData, [
                'user' => 'required',
                'planId' => 'required',
                'email'=>'required',
                'mobile'=>'required',
                'name'=>'required',
            ]);

            if($validator->fails()){
                throw new \Exception("Invalid User Request");
            }


            $planId = $postData['planId'];
            $userId = $postData['user'];

            $plan = PlanDetails::isPlanAvailable($planId);
            $amount = $plan['price'];
            $userActivePlans = PlanPurchaseDetails::chkIfPlanAlreadyActive($userId, $planId);

            GenerateUniqueTransNo::generateTransNo();
            $transNo = GenerateUniqueTransNo::getTransNo();

            PlanPurchaseDetails::insertPlanDetails($userId, $planId, $transNo);
            TransactionDetails::insertTransactionDetails($transNo, $amount, 'RAZORPAY', $ip);

            $razorpayPayment = new Razorpay();
            $response = $razorpayPayment->processPayment($amount,$transNo,env("RAZORPAY_RETURN_URL"));            


            $requestParams = [
                'clientKey'=>env("RAZORPAY_KEY_ID"),
                'amount'=>$amount,
                'businessName'=>"ITR FILING SYSTEM",
                'transactionDes'=>'amount for plan',
                'orderId'=>$response['id'],
                'callBackUrl'=>env('RAZORPAY_RETURN_URL'),
                'customerName'=>$postData['name'],
                'customerMobile'=>$postData['mobile'],
                'customerEmail'=>$postData['email']
            ];

            return view('razorpay.paymentRedirection')->with('requestParams', $requestParams);

        } catch (\Exception $ex) {
            $data = ['msg' => $ex->getMessage()];
            \Log::error(['error'=>$data]);
            return response()->json($data, 400);
        }
    }

}
