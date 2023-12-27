<?php

namespace App\Models;

use App\Models\File as ContactFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $display_name
 * @property string $email
 * @property array|null $google_metadata
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereGoogleMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 * @property int $is_discarded
 * @property string|null $middle_name
 * @property string|null $phone
 * @property string|null $linkedin
 * @property string|null $twitter
 * @property string|null $threads
 * @property string|null $youtube
 * @property string|null $website
 * @property string|null $preferred_contact_method
 * @property string|null $general_notes
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereGeneralNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereIsDiscarded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePreferredContactMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereThreads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereYoutube($value)
 * @property int $company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactEvent> $contactEvents
 * @property-read int|null $contact_events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactFile> $files
 * @property-read int|null $files_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompanyId($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'google_metadata',
        'display_name',
        'is_discarded',
        'user_id',
        'phone',
        'linkedin',
        'twitter',
        'threads',
        'youtube',
        'website',
        'preferred_contact_method',
        'general_notes',

    ];

    protected $casts = [
        'google_metadata' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($person) {
            $slugBase = Str::slug($person->first_name . '-' . $person->middle_name . '-' . $person->last_name);
            $slug = $slugBase;
            $count = 1;

            // Check if the slug already exists and increment the suffix until a unique slug is found
            while (static::where('slug', $slug)->exists()) {
                $slug = $slugBase . '-' . $count;
                $count++;
            }

            $person->slug = $slug;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contactEvents()
    {
        return $this->belongsToMany(ContactEvent::class, 'contact_contactevent');
    }

    public function files()
    {
        return $this->hasMany(ContactFile::class);
    }
}
