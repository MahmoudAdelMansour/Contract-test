<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'start_date', 'end_date', 'split', 'room_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
