<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return the OAuthProviders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oauthProviders()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    /**
     * Return the logs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(Logs::class);
    }

	/**
	 * Create a user specific log
	 *
	 * @param   string  $action
	 *
	 * @return  App\Models\User\Log
	 */
	public function log($action = null, $data = [], $metadata = [])
	{
		return Log::create([
			'user_id' => $this->id,
			'ip_address' => $this->getIpAddress(),
			'action' => $action,
			'data' => json_encode($data),
			'metadata' => json_encode($metadata),
		]);
	}

    /**
     * Return the JWT identifier
     *
     * @return  string
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return the custom JWT claims
     *
     * @return  array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

	/**
	 * Return the client's REAL ip
	 *
	 * @return  $ip_address
	 */
	protected function getIpAddress()
	{
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $ip){
					$ip = trim($ip); // just to be safe
					if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
						return $ip;
					}
				}
			}
		}

		return request()->ip();
	}
}
