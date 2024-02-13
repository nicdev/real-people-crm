<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Introduction
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $first_contact_id
 * @property int $second_contact_id
 * @property int $user_id
 * @property string $content
 * @property-read \App\Models\Contact $firstContact
 * @property-read \App\Models\Contact $secondContact
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction whereFirstContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction whereSecondContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Introduction whereUserId($value)
 *
 * @mixin \Eloquent
 */
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
            $title = $introduction->firstContact->first_name.' '.$introduction->firstContact->last_name.' introduced to '.$introduction->secondContact->first_name.' '.$introduction->secondContact->last_name;

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
