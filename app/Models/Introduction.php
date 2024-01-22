<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_contact_id',
        'second_contact_id',
        'user_id',
        'content',
    ];

    public function firstContact()
    {
        return $this->belongsTo(Contact::class, 'first_contact_id');
    }

    public function secondContact()
    {
        return $this->belongsTo(Contact::class, 'second_contact_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
