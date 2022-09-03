<?php

namespace App\Entities;

use ReflectionClass;
use ReflectionProperty;

class BaseEntity
{
    public function load(array $payload = []): static
    {
        foreach ($payload as $key => $value) {
            if (property_exists($this, $key) && $value != null) {
                $this->$key = $value;
            }
        }
        return $this;
    }

    public function getPublicData(): array
    {
        $reflect = new ReflectionClass($this);

        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

        $data = [];
        foreach ($properties as $property) {
            $data[$property->name] = $this->{$property->name};
        }

        return $data;
    }

    public function getAllData(): array
    {
        $reflect = new ReflectionClass($this);

        $properties = $reflect->getProperties();

        $data = [];
        foreach ($properties as $property) {
            $data[$property->name] = $this->{$property->name};
        }

        return $data;
    }
}