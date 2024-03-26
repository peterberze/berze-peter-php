<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Vehicle
 *
 * @property string uuid
 * @property string rendszam
 * @property string tulajdonos
 * @property string forgalmi_ervenyes
 * @property array adatok
 * @method static findOrFail(string $id)
 * @method static count()
 */
class Vehicle extends Model
{
    use HasUuids;
    protected $casts = [
        'forgalmi_ervenyes' => 'datetime',
        'adatok' => 'array',
    ];
    protected $table = 'Jarmuvek';
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'rendszam',
        'tulajdonos',
        'forgalmi_ervenyes',
        'adatok'
    ];
    protected $hidden = [
        'createdAt',
        'updatedAt',
    ];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
}
