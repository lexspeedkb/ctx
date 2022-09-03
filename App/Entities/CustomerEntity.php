<?php

namespace App\Entities;

class CustomerEntity extends BaseEntity
{
    public int $id = 0;
    public string $name = '';
    public string $surname = '';
    public string $address = '';
    public string $email = '';
    public string $phone = '';
    public string $registration_date = '1970-01-01';
}