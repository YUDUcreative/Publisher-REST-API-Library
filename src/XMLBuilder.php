<?php

namespace Bibby\Publisher;

use DOMDocument;

/**
 * XMLBuilder
 *
 * This class assists in building up XML strings in the format
 * which is expected when making POST / PUT requests to the
 * YUDU Publisher REST API.
 *
 */
class XMLBuilder {

    /**
     * Reader
     *
     * Builds expected XML for creating/updating a reader
     *
     * @param $data
     * @param null $id
     * @return string
     */
    public static function reader($data, $id = null)
    {
        $dom = new DomDocument();

        $reader = $dom->createElementNS('http://schema.yudu.com', "reader");

        if($id){
            $reader->setAttribute("id", $id);
        }

        $dom->appendChild($reader);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->appendChild($dom->createTextNode($value));
            $reader->appendChild($element);
        }

        return $dom->saveXML();
    }

    /**
     * Permission
     *
     * Builds expected XML for creating/updating a permission
     *
     * @param $data
     * @param null $id
     * @return string
     */
    public static function permission($data)
    {
        $dom = new DomDocument();

        $permission = $dom->createElementNS('http://schema.yudu.com', "permission");
        $dom->appendChild($permission);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->setAttribute("id", $value);
            $permission->appendChild($element);
        }

        return $dom->saveXML();
    }

}


