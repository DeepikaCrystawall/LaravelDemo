<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable=['title','description','status','attachment','user_id','status_changed_by_id',];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function StatusChangedBy()
    {
        return $this->belongsTo(User::class,'status_changed_by_id');

    }
}
