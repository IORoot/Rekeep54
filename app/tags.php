<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Define Eloquent Relationship
     * Many-to-Many
     *
     * @return mixed
     */
    public function nodes() {
        return $this->belongsToMany('App\tags');
    }
}
