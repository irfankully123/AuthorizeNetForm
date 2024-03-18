<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class PaymentInfo extends Model
{
    use HasFactory;

    protected $fillable=[
        'card_number',
        'expiration_date',
        'card_code',
        'first_name',
        'last_name',
        'company',
        'country',
        'city',
        'state',
        'zip',
        'email'
    ];
}
