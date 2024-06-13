<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallBackEnquiry extends Model
{
    public $table = 'call_back_enquiry';
    public $guarded = [];


    public static function insertEnquiry($name,$email,$mobile,$description)
    {
        try {
            $data = [
                'name'=>$name,
                'email'=>$email,
                'mobile'=>$mobile,
                'description'=>$description,
                'status'=>'ACTIVE'
            ];

            self::create($data);

        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }}
