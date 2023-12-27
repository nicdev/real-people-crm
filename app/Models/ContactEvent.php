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
 * @mixin \Eloquent
 */
class ContactEvent extends Model
{
    use HasFactory;

    public function contacts()
    {
        $this->belongsToMany(Contact::class, 'contact_contactevent');
    }
}
