<?php

namespace App\Models\StarWars;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'star_wars_characters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'character_id',
        'name',
        'height',
        'mass',
        'hair_color',
        'skin_color',
        'eye_color',
        'birth_year',
        'gender',
        'homeworld',
        'films',
        'species',
        'vehicles',
        'starships',
        'url',
    ];

	/**
	 * The accessors to append to the model's array.
	 *
	 * @var array
	 */
	protected $appends = [
		'planet',
	];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'films' => 'array',
        'species' => 'array',
        'vehicles' => 'array',
        'starships' => 'array',
    ];

    /**
     * Return the planets linked to the character
     *
     * @return \App\Models\StarWars\Planet
     */
	public function getPlanetAttribute()
	{
		return $this->planets()->first();
	}

    /**
     * Return the planet linked to the character
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planets()
    {
        return $this->hasMany(Planet::class, 'id');
    }
}
