<?php

namespace Stratedge\Regulator\Parsers\LimitFields;

use Illuminate\Database\Eloquent\Collection;
use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Node extends Parser
{
    public function parse(Regulation $regulation)
    {
        $fields = [];

        if ($regulation->request()->has("fields")) {
            $fields = explode(",", $regulation->request()->fields);
        }

        if ($regulation->request()->has("with")) {
            $fields = array_merge(
                $fields,
                explode(",", $regulation->request()->with)
            );
        }

        sort($fields);

        $source = $regulation->source();
        $this->addVisible($source, $fields);

        return $regulation;
    }


    protected function addVisible(&$obj, $fields)
    {
        $final = [];
        $all = false;
        $relations = [];

        foreach ($fields as $field) {
            if ($field === "*") {
                $all = true;
                continue;
            }

            //Check if this property is for this model, if so save it and
            //continue
            if (strpos($field, ".") === false) {
                $final[] = $field;
                continue;
            }

            //Resolve the relation name from the property name and remove it
            //from the front of the property name
            $field = explode(".", $field);
            $relation = array_shift($field);
            $field = implode(".", $field);

            $relations[$relation][] = $field;
        }

        //Loop through any given relationships and set their visible properties
        foreach ($relations as $relation => $fields) {
            if ($obj->relationLoaded($relation)) {
                if ($obj->{$relation} instanceof Collection) {
                    //Relationship is a collection - update each child
                    foreach ($obj->{$relation} as &$child) {
                        $this->addVisible($child, $fields);
                    }
                } else {
                    //Relations is a source - update the source
                    $this->addVisible($obj->{$relation}, $fields);
                }
            }
        }

        if (!$all) {
            $obj->setVisible($final);
        } else {
            $obj->setVisible([]);
        }
    }
}
