<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\AccessToken
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $access_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class AccessToken extends Model
{
    use CamelCaseAttrs;

    protected $table = 'access_tokens';

    protected $fillable = [
        'access_token',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
