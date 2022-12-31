<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Event
 *
 * @property int $id
 * @property string $name
 * @property string $information
 * @property int $max_people
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property bool $is_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Reservation[] $reservations
 *
 * @package App\Models
 */
class Event extends Model
{
    protected $table = 'events';

    protected $casts = [
        'max_people' => 'int',
        'is_visible' => 'bool'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $fillable = [
        'name',
        'information',
        'max_people',
        'start_date',
        'end_date',
        'is_visible'
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
