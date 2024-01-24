<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactEventType
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEventType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEventType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEventType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEventType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEventType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEventType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactEventType extends Model
{
    use HasFactory;
}
