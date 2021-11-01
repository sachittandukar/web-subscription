<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email'];

    public function websites()
    {
        return $this->belongsToMany(Website::class);
    }

    /**
     * @param $website
     *
     * @return bool
     */
    public function hasSubscribed($website){
        return $this->websites()->where('website_id', $website)->exists();
    }


    public function websiteSubscribers($website){
        return $this->belongsToMany(Website::class)->wherePivot('website_id', $website);
    }
}
