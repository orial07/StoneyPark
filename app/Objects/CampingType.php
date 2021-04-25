<?php

namespace App\Objects;

class CampingType
{
    // displayable name
    public $name;
    // recurring charge
    public $price;
    // one time fee / initial fee
    public $price2;
    // descriptive text
    public $description;
    // quantity shown in review table
    public $quantity;

    public function __construct($name, $price, $price2, $description, $quantity = 1)
    {
        $this->name = $name;
        $this->price = $price;
        $this->price2 = $price2;
        $this->description = $description;
        $this->quantity = $quantity;
    }
}
