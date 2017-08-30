<?php

namespace Inspirium\FileManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class File
 * @package Inspirium\FileManagement\Models
 *
 * @property $id
 * @property $title
 * @property $location
 * @property $link
 * @property $type
 * @property $owner_id
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
