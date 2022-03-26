<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function phoneNumber()
    {
        return $this->hasOne(PhoneNumber::class);
    }

    public function hasTwoFactorAuthenticationEnabled()
    {
        return 'off' !== $this->two_factor_type;
    }

    public function hasSmsTwoFactorAuthenticationEnabled()
    {
        return 'sms' === $this->two_factor_type;
    }

    public function hasTwoFactorType($type)
    {
        return $this->two_factor_type === $type;
    }

    public function hasDiallingCode($diallingCodeId)
    {
        if (false === $this->hasPhoneNumber()) {
            return false;
        }

        return $this->phoneNumber->diallingCode->id === $diallingCodeId;
    }

    public function getPhoneNumber()
    {
        if (false === $this->hasPhoneNumber()) {
            return false;
        }

        return $this->phoneNumber->phone_number;
    }

    public function hasPhoneNumber()
    {
        return null !== $this->phoneNumber;
    }

    public function registeredForTwoFactorAuthentication()
    {
        return null !== $this->authy_id;
    }

    public function updatePhoneNumber($phoneNumber, $phoneNumberDiallingCode)
    {
        $this->phoneNumber()->delete();

        if (!$phoneNumber) {
            return;
        }

        return $this->phoneNumber()->create([
            'phone_number' => $phoneNumber,
            'dialling_code_id' => $phoneNumberDiallingCode,
        ]);
    }
}
