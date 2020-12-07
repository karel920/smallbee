<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerDevices extends Model
{
    use HasFactory;

    protected $table = 'computer_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'computer_id', 'device_id'
    ];


    public function rComputer() {
        return $this->belongsTo(Computer::class, 'id');
    }

    public function rDevice() {
        return $this->belongsTo(Device::class, 'deivce_id');
    }
}
