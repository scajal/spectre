<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'entry_date',
        'birth_date',
        'picture'
    ];

    /**
     * Return the person's full name.
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Return the person's picture full url.
     * 
     * @return string
     */
    public function getPictureUrlAttribute()
    {
        return url("/storage/pictures/{$this->picture}");
    }

    /**
     * Return the person's picture thumbnail full url.
     * 
     * @return string
     */
    public function getThumbnailUrlAttribute()
    {
        return url("/storage/pictures/tmb_{$this->picture}");
    }

    /**
     * Return the person's picture thumbnail name.
     * 
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return "tmb_{$this->picture}";
    }

    /**
     * Return the person's age.
     * 
     * @return int
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    /**
     * Return the person's anniversary.
     * 
     * @return int
     */
    public function getAnniversaryAttribute()
    {
        return Carbon::parse($this->entry_date)->age;
    }

    /**
     * Get all the people who's birthday is today.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsBirthday($query)
    {
        $today = Carbon::today();
        
        return $query->whereRaw("DAY(birth_date) = ? AND MONTH(birth_date) = ?", [$today->day, $today->month]);
    }

    /**
     * Get all the people who's birthday is this month.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsMonthBirthday($query)
    {
        $today = Carbon::today();
        
        return $query->whereRaw("MONTH(birth_date) = ?", [$today->month]);
    }

    /**
     * Get all the people who's anniversary is today.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsAnniversary($query)
    {
        $today = Carbon::today();
        
        return $query->whereRaw("DAY(entry_date) = ? AND MONTH(entry_date) = ?", [$today->day, $today->month]);
    }

    /**
     * Get all the people who's anniversary is this month.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsMonthAnniversary($query)
    {
        $today = Carbon::today();
        
        return $query->whereRaw("MONTH(entry_date) = ?", [$today->month]);
    }
}
