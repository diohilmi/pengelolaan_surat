<?php

namespace App\Models;

use App\Models\User;
use App\Models\Disposisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disposisi_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'disposisi_id',
        'users_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id','id');
    }

    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class, 'disposisi_id','id');
    }



    protected $table = 'disposisi_user';


}
