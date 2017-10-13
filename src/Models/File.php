<?php

namespace Inspirium\FileManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Inspirium\FileManagement\Models\File
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $location
 * @property string|null $link
 * @property string|null $type
 * @property int|null $owner_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Inspirium\HumanResources\Models\Employee|null $owner
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Inspirium\FileManagement\Models\File onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\FileManagement\Models\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Inspirium\FileManagement\Models\File withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Inspirium\FileManagement\Models\File withoutTrashed()
 * @mixin \Eloquent
 */
class File extends Model {

    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['owner'];

    public function owner() {
        return $this->belongsTo('Inspirium\HumanResources\Models\Employee');
    }

    public function propositions() {
		return $this->morphedByMany('Inspirium\BookProposition\Models\BookProposition', 'fileable')->withPivot('type');
    }
}
