<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model{
    protected $table = "social_networks";

    // protected $fillable = [];


    public function allianses()
    {
        return $this->belongsTo(Ally::class);
    }

    // public $timestamps = false;
}
