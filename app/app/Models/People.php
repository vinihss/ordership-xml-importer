<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'name'];
    protected $primaryKey = 'person_id';
    public $incrementing = false;

    public function phones()
    {
        return $this->hasMany(PersonPhone::class, 'person_id');
    }
}
