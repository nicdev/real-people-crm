<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactEvent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent query()
 *
 * @property int $id
 * @property int $contact_method_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $contact_id
 * @property string $title
 * @property string|null $description
 * @property string $date
 * @property string|null $time
 * @property string|null $location
 * @property string|null $recap
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereContactMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereRecap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEvent whereUpdatedAt($value)
 *
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\ContactMethod $contactMethod
 *
 * @mixin \Eloquent
 */
class ContactEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'contact_id',
        'contact_method_id',
        'recap',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($contactEvent) {
            if ($contactEvent->date >= $contactEvent->contact->follow_up_date) {
                $contactEvent->contact->update([
                    'follow_up_date' => $contactEvent->date->addDays($contactEvent->contact->frequency),
                ]);
            }
        });
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function contactMethod()
    {
        return $this->belongsTo(ContactMethod::class);
    }
}
