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

    protected $fillable = ['title', 'location', 'link', 'type', 'owner_id'];

    public function owner() {
        return $this->belongsTo('Inspirium\UserManagement\Models\User');
    }
}
