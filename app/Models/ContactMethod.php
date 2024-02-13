<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactMethod
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactEvent> $contactEvents
 * @property-read int|null $contact_events_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function contactEvents()
    {
        return $this->hasMany(ContactEvent::class);
    }
}
