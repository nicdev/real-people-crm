<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Company
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $name
 * @property string|null $website
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string|null $country
 * @property string|null $industry
 * @property string|null $description
 * @property string|null $notes
 * @property string|null $linkedin
 * @property string|null $twitter
 * @property string|null $youtube
 * @property string|null $threads
 * @property int $user_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereThreads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereYoutube($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereZip($value)
 *
 * @property string|null $logo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLogo($value)
 *
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'industry',
        'description',
        'notes',
        'user_id',
        'linkedin',
        'twitter',
        'youtube',
        'threads',
        'logo',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($company) {
            $slugBase = Str::slug($company->name);
            $slug = $slugBase;
            $count = 1;

            // Check if the slug already exists and increment the suffix until a unique slug is found
            while (static::where('slug', $slug)->exists()) {
                $slug = $slugBase.'-'.$count;
                $count++;
            }

            $company->slug = $slug;
        });
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
