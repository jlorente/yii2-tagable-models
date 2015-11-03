<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\models;

/**
 * Defines a class as tagable.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
interface TagableFormInterface extends TagableInterface {

    /**
     * 
     * @return int[]
     */
    public function getTagIds();

    /**
     * 
     * @param int[] $ids
     */
    public function setTagIds(array $ids);
}
