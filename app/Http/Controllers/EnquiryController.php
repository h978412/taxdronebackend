<?php

namespace App\Http\Controllers;

use App\Models\CallBackEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EnquiryController extends Controller
{
    //
    public function raiseCallBackEnquiry(Request $request){
        try{
            $postData = $request->all();
            $validator = Validator::make($postData, [
                'mobile' => 'required',
                'email' => 'required',
                // 'description'=>'required',
                'name'=>'required',
            ]);

            if($validator->fails()){
                throw new \Exception("Invalid User Request");
            }

            $name = $postData['name']??"";
            $email = $postData['email']??"";
            $mobile = $postData['mobile']??"";
            $description = $postData['description']??"";

            CallBackEnquiry::insertEnquiry($name,$email,$mobile,$description);

            return response()->json(['message'=>'Your enquiry registered with us successfully, We will connect with you shortly']);

        }catch(\Exception $ex){
            return response()->json(['error'=>$ex->getMessage()],400);
        }
    }
}
