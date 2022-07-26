<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tujuan',
        'sifat',
        'perintah',
        'isi',
        'incoming_letters_id'
    ];

    protected $table = 'disposisi';

    public function incoming_letters()
    {
        return $this->belongsTo(Incoming_letters::class, 'incoming_letters_id','id');
    }
}
