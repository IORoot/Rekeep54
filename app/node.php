<?php

namespace App;

use App\Usermenu;
use App\Page;

use Illuminate\Database\Eloquent\Model;

use App\Events\NodeGenerated; 

class node extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'nodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'node_type',
        'title',
        'url',
        'description',
        'notes',
        'favicon_url',
        'image_filename',
        'image_filter',
        'image_crop',
        'image_animated',
        'image_width',
        'image_height',
        'node_width',
        'node_height',
        'node_position',
        'colour_1_hex',
        'colour_2_hex',
        'colour_3_hex',
        'colour_4_hex',
        'colour_5_hex',
        'twitter_link',
        'facebook_link',
        'youtube_link',
        'instagram_link'
    ];

    /** =============================================================================
     *  RELATIONSHIPS
     *  ============================================================================= */

    /**
     * Define Eloquent Relationship
     * One-to-Many
     *
     * @return mixed
     */
    public function page()
    {
        return $this->belongsToMany('App\Page');
    }

    /**
     * Define Eloquent Relationship
     * One-to-One
     *
     * @return mixed
     */
    public function feed()
    {
        return $this->hasOne('App\rssfeed');
    }

    /**
     * Define Eloquent Relationship
     * Many-to-Many
     *
     * @return mixed
     */
    public function tags()
    {
        return $this->belongsToMany('App\tags');
    }

    /** =============================================================================
     *  STATIC METHODS
     *  ============================================================================= */

    /**
     * Generate a new Node and fire off an Event to declare it!
     *
     * @param $attributes
     * @return mixed
     *
     * @event NodeGenerated
     */
    public static function generate($attributes = [])
    {

        $node = static::create($attributes);

        event(new NodeGenerated($node));

        return $node;
    }


    /**
     * Attach a node to a page.
     *
     * If there is no page attached, get the first usermenu of the user and attach it to that instead.
     *
     * @param \App\Page $page
     * @param User $user
     */
    public function connectsTo(Page $page = null, User $user)
    {

        if (! $page) {
            $page = Page::find( Usermenu::firstUsermenu($user)->page->id );
        }

        $this->page()->attach($page);
    }
}