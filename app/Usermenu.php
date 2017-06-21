<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

use App\Page;
use App\node as rekeepNode;

use App\Http\Validators\ValidateUsermenuDepth;
use App\Events\UsermenuGenerated;

/**
* Usermenu
*/
class Usermenu extends Node
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'usermenus';

    protected $fillable = [
        'title',
        'icon_name',
        'icon_hex',
        'state',
        'user_id'
    ];

    /** =============================================================================
     *  RELATIONSHIPS
     *  ============================================================================= */

    /**
     * Define Eloquent Relationship
     * One-to-One
     *
     * @return mixed
     */
    public function page()
    {
        return $this->hasOne('App\Page');
    }

    /**
     * Define Eloquent Relationship
     * One-to-One
     *
     * @return mixed
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    /** =============================================================================
     *  STATIC METHODS
     *  ============================================================================= */

    /**
     * Returns the Menu tree hierarchy to be rendered
     *
     * @param $user
     * @return mixed
     */
    public static function hierarchy($user)
    {
        return Usermenu::byUserId($user->id)->get()->toHierarchy();
    }

    /**
     * Returns the first instance of the User's Usermenu
     *
     * @param User $user
     */
    public static function firstUsermenu(User $user)
    {
        return Usermenu::byUserId($user->id)->first();
    }

    /**
     * Returns the depth of the Usermenu on the menu structure.
     * If no ID is supplied, return 0 because you are at the root level.
     *
     * @param $id
     * @return integer
     */
    public static function depth($id = null)
    {
        if ($id){
            return Usermenu::where('id', $id)->first()->depth;
        }

        return 0;
    }


    /**
     * Generate a Usermenu and associate it with a parent if one has been supplied.
     * Also fires off an event.
     *
     * @param $attributes
     * @param null $parentID
     * @return mixed
     *
     * @event UsermenuGenerated
     */
    public static function generate($attributes = [], $parentID = null)
    {

        (new ValidateUsermenuDepth)->check( static::depth($parentID) );

        $usermenu = static::create($attributes);

        if ($parentID)
        {
            $usermenu->makeChildOf(Usermenu::find($parentID));
        }

        event(new UsermenuGenerated($usermenu));

        return $usermenu;
    }


    /** =============================================================================
     *  SCOPES
     *  ============================================================================= */


    /**
     * Scope a query to only include specific user.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

}