<?php namespace App\Rekeep\Transformers;

class UsermenuTransformer extends Transformer {
    
    /**
     * Transform a Usermenu
     *
     * This will filter the Usermenu collection API output so that the selected fields are
     * the only ones output.
     *
     * @param $usermenu
     * @return array
     */
    public function transform($usermenu) {

        $children = $this->transformCollection( $usermenu['children'] );

        return [
            'title' => $usermenu['title'],
            'id' => $usermenu['id'],
            'icon_name' => $usermenu['icon_name'],
            'icon_hex' => $usermenu['icon_hex'],
            'state' => $usermenu['state'],
            'children' => $children
        ];

    }


}