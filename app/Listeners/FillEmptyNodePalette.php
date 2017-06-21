<?php

namespace App\Listeners;

use App\Events\NodeGenerated;

use App\Rekeep\Helpers\Colours\RandomColours;

class FillEmptyNodePalette
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * Method checks if any values are null, then fills them in if they are.
     *
     * @param  NodeGenerated  $event
     * @return void
     */
    public function handle(NodeGenerated $event)
    {

        if ($event->node->colour_1_hex == '------' ||  $event->node->colour_1_hex == '')
        {
            $event->node->colour_1_hex = RandomColours::randomHEXColour();
        }
        if ($event->node->colour_2_hex == '------' ||  $event->node->colour_2_hex == '' )
        {
            $event->node->colour_2_hex = RandomColours::randomHEXColour();
        }
        if ($event->node->colour_3_hex == '------' ||  $event->node->colour_3_hex == '')
        {
            $event->node->colour_3_hex = RandomColours::randomHEXColour();
        }
        if ($event->node->colour_4_hex == '------' ||  $event->node->colour_4_hex == '')
        {
            $event->node->colour_4_hex = RandomColours::randomHEXColour();
        }
        if ($event->node->colour_5_hex == '------' ||  $event->node->colour_5_hex == '')
        {
            $event->node->colour_5_hex = RandomColours::randomHEXColour();
        }

        $event->node->save();

    }
}
