<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model;
/**
 * Vehicle
 *
 * @property string uuid
 * @property string rendszam
 * @property string tulajdonos
 * @property string forgalmi_ervenyes
 * @property array adatok
 */
class Vehicle extends Model
{
    protected $connection = 'mongodb';

    protected $primaryKey = 'uuid';
    protected $hidden = [
        'updated_at',
        'created_at',
        '_id',
    ];
}
