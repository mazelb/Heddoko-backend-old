<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Database model for API client endpoints.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    February 2016
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\OAuthClientEndpoint
 *
 * @property integer $id
 * @property string $client_id
 * @property string $redirect_uri
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClientEndpoint whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClientEndpoint whereClientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClientEndpoint whereRedirectUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClientEndpoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OAuthClientEndpoint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OAuthClientEndpoint extends Model
{
    use CamelCaseAttrs;

    /**
     * Table name.
     */
    protected $table = 'oauth_client_endpoints';

    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = [
        'client_id',
        'redirect_uri',
    ];
}
