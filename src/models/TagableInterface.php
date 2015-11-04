<?php

/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

namespace jlorente\tagable\models;

/**
 * Defines a class as been taged.
 * 
 * @author José Lorente <jose.lorente.martin@gmail.com>
 */
interface TagableInterface {

    /**
     * 
     * @return \jlorente\tagable\db\TagQuery
     */
    public function getTags();
    
    /**
     * 
     * @return string
     */
    public static function getTagAssociationType();
}
