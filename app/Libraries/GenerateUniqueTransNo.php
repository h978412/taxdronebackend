<?php

namespace App\Libraries;
use App\Models\TransNoMapping;


class GenerateUniqueTransNo
{

    private static $tranNo;


    public static function generateTransNo(){
        try{
            $transNo =  self::getRandomString(4) . self::getTimeStamp() . self::getRandomString(6);
            $iteration = 0;
            while($iteration < 4 && TransNoMapping::chkIfTranNoExist($transNo)){
                $transNo =  self::getRandomString(4) . self::getTimeStamp() . self::getRandomString(6);
                $iteration++;
            }

            if($iteration == 4){
                throw new \Exception("Something went wrong, Please contact with support");
            }
            TransNoMapping::insertTransNo($transNo);
            self::$tranNo = $transNo;
            
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    public static function getTransNo(){
        return self::$tranNo;
    }

    public static function setTransNo($transNo){
        self::$tranNo = $transNo;
    }


    private static function getTimeStamp(){
        try{
            return Date("Ymd");//8 digit
        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }


    private static function getRandomString($length){
        try{
            $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $finalString = "";

            for($i=0;$i<$length;$i++){
                $index = mt_rand(0,36);
                $finalString .= $string[$index];
            }

            return $finalString;

        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }

    


 
}
