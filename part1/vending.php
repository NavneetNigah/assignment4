<?php
class products
{
    private $product;
    private $price;
    private $amount;

function __construct()
{
    $this->price = 0;
    $this->amount = 0;
}

function choiceMade($product)
{
    $this->product = $product;
    if($product == 'Chocolate') {
        $this->price = 125;
    } else if ($product == 'Pop') {
        $this->price = 150;
    } else if($product == 'Chips') {
        $this->price = 175;
    }
}

public function GetProduct()
{
    return $this->product;
}

public function GetPrice()
{
    return $this->price;
}

public function GetAmount()
{
    return $this->amount;
}

public function SetAmount($amount)
{
    $this->amount = $amount;
}
public function change($amount,$price)
{
   return  $this->$amount - $this->$price;
}
}