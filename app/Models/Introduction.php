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

    protected static function boot(): void
    {
        parent::boot();
        
        static::created(function ($introduction) {
            $title = $introduction->firstContact->first_name . ' ' . $introduction->firstContact->last_name . ' introduced to ' . $introduction->secondContact->first_name . ' ' . $introduction->secondContact->last_name;

            $introduction->firstContact->contactEvents()->create([
                'title' => $title,
                'contact_method_id' => ContactMethod::where('name', 'Email')->first()->id,
                'recap' => strip_tags($introduction->content),
                'date' => now(),
            ]);
            
            $introduction->secondContact->contactEvents()->create([
                'title' => $title,
                'contact_method_id' => ContactMethod::where('name', 'Email')->first()->id,
                'recap' => strip_tags($introduction->content),
                'date' => now(),
            ]);
        });
    }

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
