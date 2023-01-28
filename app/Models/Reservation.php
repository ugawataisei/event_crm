<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Reservation
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property int $number_of_people
 * @property Carbon $canceled_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Event $event
 * @property User $user
 *
 * @package App\Models
 */
class Reservation extends Model
{
    protected $table = 'reservations';

    protected $casts = [
        'user_id' => 'int',
        'event_id' => 'int',
        'number_of_people' => 'int'
    ];

    protected $dates = [
        'canceled_date'
    ];

    protected $fillable = [
        'user_id',
        'event_id',
        'number_of_people',
        'canceled_date'
    ];

    /**
     * Relations
     */

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor
     */

    public function getUserIdAttribute($value)
    {
        /** @var User $user */
        $user = User::query()->where('id', $value)->first();

        return $user->name;
    }
}
