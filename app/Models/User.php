<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function register($request)
    {
        try {
            $postData = $request->all();


            $email = $postData['email'];
            $password = $postData['password'];
            $name = $postData['name'];

            $user = self::where('email',$email)->first();

            if(!empty($user)){
                throw new \Exception("This email already exists");
            }

            $encPassword = Hash::make($password);

            $data = [
                'email' => $email,
                'password' => $encPassword,
                'name' => $name
            ];

            $user = self::create($data);

            $token = $user->createToken("desktop")->plainTextToken;

            return $token;


        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public static function login($email, $password)
    {
        try {
            $user = self::where('email', $email)->first();

            if (empty($user)) {
                throw new \Exception("This email is not registered with us");
            }

            if (!Hash::check($password, $user->password)) {
                throw new \Exception("Invalid Credentials, kindly try again");
            }

            $token = $user->createToken("desktop")->plainTextToken;

            return $token;

        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }

    }


    public function logout($email){
        try{

        }catch(\Exception $ex){
            throw new \Exception($ex->getMessage());
        }
    }


}
