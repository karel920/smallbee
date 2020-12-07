<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComputers extends Model
{
    use HasFactory;

    protected $table = 'user_computers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'computer_id', 'user_id'
    ];


    public function rComputer() {
        return $this->belongsTo(Computer::class, 'computer_id');
    }

    public function rUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
