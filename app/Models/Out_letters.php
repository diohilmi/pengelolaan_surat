<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Out_letters extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'letter_no',
        'letter_date',
        'tujuan',
        'regarding',
        'file',
        'status',
        'keterangan',
        'users_id'
    ];
}
