<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const ARRIVED_BY_SELECT = [
        'plane' => 'plane',
        'bus'   => 'bus',
        'ferry' => 'ferry',
        'train' => 'train',
    ];

    public const STATUS_SELECT = [
        'planning'  => 'planning',
        'upcoming'  => 'upcoming',
        'completed' => 'completed',
        'cancelled' => 'cancelled',
    ];

    public const PURPOSE_SELECT = [
        'work'       => 'work',
        'vacation'   => 'vacation',
        'workcation' => 'workcation (digital nomad)',
        'other'      => 'other',
        'family'     => 'family occassion',
    ];

    public $table = 'trips';

    protected $dates = [
        'starts_at',
        'ends_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status',
        'city_id',
        'starts_at',
        'ends_at',
        'arrived_by',
        'purpose',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tripExpenses()
    {
        return $this->hasMany(Expense::class, 'trip_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getStartsAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartsAtAttribute($value)
    {
        $this->attributes['starts_at'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndsAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndsAtAttribute($value)
    {
        $this->attributes['ends_at'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
