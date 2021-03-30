<?php

abstract class Gateway
{
    protected Connection $con;
    public function __construct(string $dsn, string $username, string $password){
        $this->con = new Connection($dsn, $username, $password);
    }
}