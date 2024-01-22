<?php

namespace App\Models;

use App\Models\File as ContactFile;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
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
 *
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
 *
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
 *
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
 *
 * @property int $company_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactEvent> $contactEvents
 * @property-read int|null $contact_events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactFile> $files
 * @property-read int|null $files_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompanyId($value)
 *
 * @property string|null $slug
 * @property string|null $title
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTitle($value)
 *
 * @property-read ContactMethod|null $preferredContactMethod
 * @property int $frequency
 * @property \Illuminate\Support\Carbon|null $follow_up_date
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFollowUpDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFrequency($value)
 *
 * @property int|null $preferred_contact_method_id
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $birthday
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePreferredContactMethodId($value)
 *
 * @property int $no_follow_up
 * @property-read \App\Models\Company|null $company
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereNoFollowUp($value)
 *
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory, Notifiable;

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
        'preferred_contact_method_id',
        'general_notes',
        'company_id',
        'frequency',
        'follow_up_date',
        'photo',
        'birthday',
        'no_follow_up',
    ];

    protected $casts = [
        'google_metadata' => 'array',
        'follow_up_date' => 'date',
        'birthday' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contact) {
            $slugBase = Str::slug($contact->first_name.'-'.$contact->middle_name.'-'.$contact->last_name);
            $slug = $slugBase;
            $count = 1;

            // Check if the slug already exists and increment the suffix until a unique slug is found
            while (static::where('slug', $slug)->exists()) {
                $slug = $slugBase.'-'.$count;
                $count++;
            }

            $contact->slug = $slug;
        });

        static::creating(function ($contact) {
            if ($contact->follow_up_date === null) {
                $contact->follow_up_date = now()->addDays($contact->frequency);
            }
        });

        static::creating(function ($contact) {
            if ($contact->preferred_contact_method_id === null) {
                $contact->preferred_contact_method_id = ContactMethod::where('name', 'Email')->first()->id;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contactEvents()
    {
        return $this->hasMany(ContactEvent::class);
    }

    public function files()
    {
        return $this->hasMany(ContactFile::class);
    }

    public function preferredContactMethod()
    {
        return $this->hasOne(ContactMethod::class, 'id', 'preferred_contact_method_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // public function followUp(): Attribute
    // {
    //     return Attribute::make(function () {
    //         if ($this->follow_up_date) {
    //             return $this->follow_up_date->format('Y-m-d');
    //         } elseif ($this->contactEvents()->exists()) {
    //             return $this->contactEvents()->orderBy('date', 'desc')->first()?->date->addDays($this->frequency)->format('Y-m-d');
    //         } else {
    //             return now()->format('Y-m-d');
    //         }
    //     });
    // }
}
