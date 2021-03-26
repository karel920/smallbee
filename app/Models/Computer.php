<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $table = 'computers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_number', 'ip_address'
    ];

    public function rComputerDevices() {
        return $this->hasMany(ComputerDevices::class, 'computer_id');
    }

    public function rComputerGroups() {
        return $this->hasMany(ComputerGroup::class, 'computer_id');
    }
}
