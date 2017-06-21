<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rssfeed extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'rssfeeds';

    /**
     * Define Eloquent Relationship
     * One-to-One
     *
     * @return mixed
     */
    public function node() {
        return $this->belongsTo('App\node');
    }
}
