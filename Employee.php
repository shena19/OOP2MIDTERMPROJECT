<?php

abstract class Employee extends Person {
    private $companyName;
    protected $type;

    public function __construct($name, $address, $age, $companyName) {
        parent::__construct($name, $address, $age);
        $this->companyName = $companyName;
    }

    abstract public function earnings();

    public function getName() {
        return $this->name;
    }
    public function getAddress() {
        return $this->address;
    }

    public function getAge() {
        return $this->age;
    }

    public function getCompany() {
        return $this->companyName;
    }

    public function getType() {
        return $this->type;
    }
}
