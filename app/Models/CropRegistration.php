<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropRegistration extends Model
{
    use HasFactory;

    protected $table = 'crop_registrations';

    protected $fillable = [
        'user_id',
        'crop_name',
        'price',
        'image_base64'
    ];
}