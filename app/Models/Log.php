<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'action',
        'data',
        'metadata',
    ];

	/**
	 * The accessors to append to the model's array.
	 *
	 * @var array
	 */
	protected $appends = [
		'ip_filtered',
	];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
        'metadata' => 'array',
    ];

    /**
     * Return the user linked to the oauth provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

	/**
	 * Filter a IP address
	 *
	 * @return  string
	 */
	public function getIpFilteredAttribute()
	{
		$ip_array = explode('.', $this->ip_address);
		$new_ip = [];
		$i = 0;

		foreach($ip_array as $part) {
			if($part != $ip_array[0] && $part != end($ip_array)) {
				$new_ip[$i++] = str_repeat("*", strlen($part));
			} else {
				$new_ip[$i++] = $part;
			}
		}

		return implode('.', $new_ip);
	}
}
