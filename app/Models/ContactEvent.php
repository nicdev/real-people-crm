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

    public function contact()
    {
        $this->belongsTo(Contact::class);
    }

    public function contactMethod()
    {
        $this->belongsTo(ContactMethod::class);
    }
}
