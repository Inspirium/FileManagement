<?php

namespace Inspirium\FileManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Inspirium\FileManagement\Models\Document
 *
 * @property-read \Inspirium\HumanResources\Models\Employee $owner
 * @mixin \Eloquent
 */
class Document extends File {
	public $type = 'document';
}
