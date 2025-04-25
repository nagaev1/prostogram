<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Profile model class
 *
 * @property string $bio
 * @property string $avatar
 */
class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    protected $fillable = ['bio', 'avatar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
