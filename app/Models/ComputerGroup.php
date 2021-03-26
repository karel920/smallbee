<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerGroup extends Model
{
    use HasFactory;

    protected $table = 'computer_groups';

    protected $fillable = [
        'computer_id', 'group_id'
    ];


    public function rComputer() {
        return $this->belongsTo(Computer::class, 'computer_id');
    }

    public function rGroup() {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
