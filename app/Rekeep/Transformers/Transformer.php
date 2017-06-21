<?php namespace App\Rekeep\Transformers;

abstract class Transformer {


    /**
     * Transform a collection for API Output.
     *
     *
     * @param array $items
     * @param string $collectionName
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }


    /**
     * 'transform' method must be implemented in any child class.
     * Must also accept an $item value to transform.
     *
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}