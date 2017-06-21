<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\PageGenerated;

class page extends Model
{

    protected $fillable = ['title', 'usermenu_id'];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'page';

    /** =============================================================================
     *  RELATIONSHIPS
     *  ============================================================================= */

    /**
     * Define Eloquent Relationship
     * One-to-One
     *
     * @return mixed
     */
    public function menu() {
        return $this->belongsTo('App\usermenu');
    }

    /**
     * Define Eloquent Relationship
     * Many-to-Many
     *
     * @return mixed
     */
    public function nodes() {
        return $this->belongsToMany('App\node');
    }

    /** =============================================================================
     *  STATIC METHODS
     *  ============================================================================= */

    /**
     * Generate a new Page and fires off an Event to declare it!
     *
     * @param $attributes
     * @return mixed
     *
     * @event PageGenerated
     */
    public static function generate($attributes = [])
    {

        $page = static::create($attributes);

        event(new PageGenerated($page));

        return $page;
    }

}
