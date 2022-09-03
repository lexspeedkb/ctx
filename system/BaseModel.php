<?php

namespace system;

class BaseModel
{
    public db $db;

    public string $table;
    public string $primary = 'id';
    public string $entity;

    public function __construct()
    {
        global $env;

        $this->db = new db($env['database.host'], $env['database.user'], $env['database.pass'], $env['database.name']);
    }

//    public function getAll(): array
//    {
//        return $this->db->query("SELECT * FROM $this->table")
//            ->fetchAll() ?? [];
//    }
//
//    public function getByPrimary(int|string $primary): array
//    {
//        return $this->db->query("SELECT * FROM $this->table WHERE `$this->primary`='$primary'")->fetchArray();
//    }
}