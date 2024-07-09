<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Application
 * @package App\Models
 * @property int $service_id
 * @property int $status
 * @property int $created_by
 * @property int $confirmed_by
 * @property string $description
 * @property ApplicationSos applicationSos
 * @method static paginate(mixed $perpage)
 */
class Application extends Model
{
    use HasFactory, SoftDeletes;

    public const APPLICATION_STATUSSES = [
        "NEW" => 1,
        "CANCELLED_BY_CLIENT" => 3,
        "IN_PROGRESS" => 4,
    ];

    public const APPLICATION_TYPES = [
        "WAITER_CALL" => 1,
        "CHEQUE_CALL" => 2,
        "SHISHA_CALL" => 3,
    ];

    protected $fillable = [
        'service_id',
        'status',
        'created_by',
        'application_type',
        'confirmed_by',
        'description'
    ];

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by',
            'id',
        );
    }

    /**
     * @return BelongsTo
     */
    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'confirmed_by',
            'id'
        );
    }

    // /**
    //  * @return HasOne
    //  */
    // public function applicationSos(): HasOne
    // {
    //     return $this->hasOne(ApplicationSos::class);
    // }

    // /**
    //  * @return HasOne
    //  */
    // public function applicationCarService(): HasOne
    // {
    //     return $this->hasOne(ApplicationCarService::class);
    // }

    // /**
    //  * @return HasOne
    //  */
    // public function applicationOther(): HasOne
    // {
    //     return $this->hasOne(ApplicationOther::class);
    // }
}
