<?php

namespace App\Entities;

class GoodEntity extends BaseEntity
{
    public int $id = 0;
    public string $title = '';
    public string $description = '';
    public float $price = 0.00;
}