<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Database model for API clients.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    December 2015
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\OAuthClient
 *
 * @property string $id
 * @property string $secret
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClient whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClient whereSecret($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClient whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClient whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OAuthClient extends Model
{
    use CamelCaseAttrs;

    /**
     * Table name.
     */
    protected $table = 'oauth_clients';

    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = [
        'id',
        'secret',
        'name'
    ];
}
