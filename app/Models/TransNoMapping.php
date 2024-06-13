<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransNoMapping extends Model
{
    use HasFactory;

    public $table = 'transno_mapping';
    public $guarded = [];

    public $timestamps = false;

    public static function chkIfTranNoExist($tranNo): bool
    {
        try {
            $mapping = self::where('trans_no', $tranNo)->get();

            if (count($mapping)) {
                return true;
            }

            return false;


        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function insertTransNo($transNo)
    {
        try {

            self::create([
                'trans_no' => $transNo,
                'entry_date' => date("Y-m-d H:i:s")
            ]);



        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

    }
}
