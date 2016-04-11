<?php
/**
 * @brief   Database model for images.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @property integer $id
 * @property integer $belongs_to_id
 * @property string $belongs_to_type
 * @property string $mime_type
 * @property string $data_uri
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $parent
 * @property-read mixed $src
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereBelongsToId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereBelongsToType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereDataUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = ['data_uri', 'mime_type'];

    /**
     * Attributes which should be appended to the model's array form.
     */
    protected $appends = ['src'];

    /**
     * Attributes which should be hidden from the models' array form.
     */
    protected $hidden = ['id', 'belongs_to_id', 'belongs_to_type'];

    /**
     * Group or profile this image belongs to.
     */
	public function parent()
	{
		return $this->morphTo();
	}

    /**
     * Accessor for $this->src.
     *
     * @param string $src
     * @return string
     */
    public function getSrcAttribute($src = '') {
        return 'data:'. $this->mime_type .';base64,'. $this->data_uri;
    }
}
