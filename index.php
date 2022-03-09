<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tree = [
    "val" => 1,
    "children" => [
        [
            "val" => 2,
            "children" => [
                [
                    "val" => 7,
                    "children" => [
                        ["val" => 2],
                        ["val" => 18],
                        ["val" => 12]
                    ]
                ]
            ]
        ],
        [
            "val" => 4,
            "children" => [
                ["val" => 5],
                [
                    "val" => 6,
                    "children" => [
                        ["val" => 12],
                        ["val" => 11],
                        ["val" => 10],
                        ["val" => 9],
                    ]
                ],
                ["val" => 13]
            ]
        ],
        [
            "val" => 3,
            "children" => [
                ["val" => 15]
            ]
        ],
        [
            "val" => 17,
            "children" => [
                ["val" => 16],
                [
                    "val" => 2,
                    "children" => [
                        ["val" => 14],
                        ["val" => 11],
                        [
                            "val" => 18,
                            "children" => [
                                ["val" => 4],
                                ["val" => 11],
                                ["val" => 7]
                            ]
                        ],
                        ["val" => 27],
                        ["val" => 18],
                        ["val" => 29],
                    ]
                ]
            ]
        ]
    ]
];



function prioritize_nodes(&$tree, $targetVal) {

    $store = [];
    foreach ($tree as $key => &$value){
        if (is_array($value)) {
            $valueLength = count($value);
            for($i=0; $i<$valueLength; $i++) {
                $prioResponse = prioritize_nodes($value[$i], $targetVal);
                if ($prioResponse === true) {
                    $store[] = $i;
                }
            }

            $countStore = count($store);
            if ($countStore > 0 && $valueLength > 1) {
                for($j=0; $j<$countStore; $j++) {
                    $value = moveElement($value, $store[$j], $j);
                }
            }

        } else {
            if ($value === $targetVal) {
                return true;
            }
        }
    }

    return count($store) > 0;
}

function moveElement(&$array, $a, $b) {
    $p1 = array_splice($array, $a, 1);
    $p2 = array_splice($array, 0, $b);
    return array_merge($p2,$p1,$array);
}

prioritize_nodes($tree, 18);
print("<pre>".print_r($tree,true)."</pre>");




