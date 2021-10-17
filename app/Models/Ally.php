<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ally extends Model{
    protected $table = "allianses";

    // protected $fillable = [];

    // public $timestamps = false;

    public function socialNetwork()
    {
        return $this->hasOne(SocialNetwork::class);
    }
}
