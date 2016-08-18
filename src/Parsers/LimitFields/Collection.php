<?php

namespace Stratedge\Regulator\Parsers\LimitFields;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;

class Collection extends Parser
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

        foreach ($regulation->source()->items() as &$obj) {
            $this->addVisible($obj, $fields);
        }

        return $regulation;
    }


    protected function addVisible(&$obj, $fields)
    {
        $final = [
            "fields" => [],
            "relations" => []
        ];

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
                if (method_exists($obj, $field)) {
                    $final["relations"][] = $field;
                } else {
                    $final["fields"][] = $field;
                }
                continue;
            }

            //Resolve the relation name from the property name and remove it
            //from the front of the property name
            $field = explode(".", $field);
            $relation = array_shift($field);
            $field = implode(".", $field);

            $relations[$relation][] = $field;

            $final["relations"][] = $relation;
        }

        //Loop through any given relationships and set their visible properties
        foreach ($relations as $relation => $fields) {
            if ($obj->relationLoaded($relation) && $obj->{$relation}) {
                if ($obj->{$relation} instanceof EloquentCollection) {
                    //Relationship is a collection - update each child
                    foreach ($obj->{$relation} as &$child) {
                        $this->addVisible($child, $fields);
                    }
                } else {
                    //Relationship is a source - update the source
                    $this->addVisible($obj->{$relation}, $fields);
                }
            }
        }

        if (!$all && !empty($final["fields"])) {
            $obj->setVisible(array_merge(
                $final["relations"],
                $final["fields"]
            ));
        } else {
            $obj->setVisible([]);
        }
    }
}
