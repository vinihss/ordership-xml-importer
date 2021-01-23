<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'person_id', 'name', 'address', 'city', 'country'];
    protected $primaryKey = 'order_id';
    public $incrementing = false;

    public function items()
    {
        return $this->hasMany(Item::class, 'order_id');
    }

}
