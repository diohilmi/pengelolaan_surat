<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming_letters extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'email',
        'letter_no',
        'letter_date',
        'letter_content',
        'letter_subject',
        'date_received',
        'regarding',
        'sender',
        'users_id'
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'users_id','id');
    }

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class);
    }
}
