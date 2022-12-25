<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'dob',
        'points',
        'referrer',
        'avatar',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['referedBy'];

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    protected static function booted()
    {
        // generate unique code on crerating.
        static::creating(function ($user) {
            $user->code = Str::random(8);

            // Check for referer code.
            if (isset(request()->referal_code)) {
                $ref = User::where('code', request()->referal_code)->first();

                if (isset($ref)) {
                    $user->referrer = $ref->id;

                    // Calculate Earned point.
                    self::CalculatePoints($ref);
                }
            }
        });
    }

    public function refCount()
    {
        return $this->referrers()->count();
    }

    public function points()
    {
        return $this->hasMany(UserPoint::class);
    }

    public function referrers()
    {
        return $this->hasMany(self::class, 'referrer', 'id')->with('referrers');
    }

    public function referedBy()
    {
        return $this->belongsTo(self::class, 'referrer', 'id');
    }

    public static function CalculatePoints($user)
    {
        $count = $user->refCount();
        if ($count <=  5) {
            $points = 5;
        } else if ($count <= 10) {
            $points = 7;
        } else if ($count >= 11) {
            $points = 10;
        }

        UserPoint::create([ 'user_id' => $user->id, 'points' => $points ]);
    }
}
