<?php

class EmployeeRoster {
    private $roster = [];
    private $rosterSize;

    public function __construct($rosterSize) {
        $this->rosterSize = $rosterSize;
        $this->roster = array_fill(0, $this->rosterSize, null);
    }

    public function add(Employee $employee) {
        for($i = 0; $i < $this->rosterSize; $i++) {
            if ($this->roster[$i] === null) {
                $this->roster[$i] = $employee;
                break;
            }
        }
    }

    public function remove($employee_id) {
        if($employee_id < 0 || $employee_id >= $this->rosterSize || $this->roster[$employee_id] == null) return false;
        
        $this->roster[$employee_id] = null;
        return true;
    }

    public function count() {
        $count = 0;
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null) {
                $count++;
            }
        }

        return $count;
    }

    public function countCE() {
        $count = 0;
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null && $this->roster[$i]->getType() == "Commissioned Employee") {
                $count++;
            }
        }

        return $count;
    }

    public function countHE() {
        $count = 0;
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null  && $this->roster[$i]->getType() == "Hourly Employee") {
                $count++;
            }
        }

        return $count;
    }
    
    public function countPE() {
        $count = 0;
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null  && $this->roster[$i]->getType() == "Piece Worker") {
                $count++;
            }
        }

        return $count;
    }

    public function display() {
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null) {
                $employee = $this->roster[$i];
                echo "Employee #" . $i + 1;
                echo "\nName: " . $employee->getName();
                echo "\nAddress: " . $employee->getAddress();
                echo "\nAge: " . $employee->getAge();
                echo "\nCompany: " . $employee->getCompany();
                echo "\nType: " . $employee->getType();
                echo "\n\n";
            }
        }
    }

    public function displayCE() {
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null && $this->roster[$i]->getType() == "Commissioned Employee") {
                $employee = $this->roster[$i];
                echo "Employee #" . $i + 1;
                echo "\nName: " . $employee->getName();
                echo "\nAddress: " . $employee->getAddress();
                echo "\nAge: " . $employee->getAge();
                echo "\nCompany: " . $employee->getCompany();
                echo "\nType: " . $employee->getType();
                echo "\n\n";
            }
        }
    }

    public function displayHE() {
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null && $this->roster[$i]->getType() == "Hourly Employee") {
                $employee = $this->roster[$i];
                echo "Employee #" . $i + 1;
                echo "\nName: " . $employee->getName();
                echo "\nAddress: " . $employee->getAddress();
                echo "\nAge: " . $employee->getAge();
                echo "\nCompany: " . $employee->getCompany();
                echo "\nType: " . $employee->getType();
                echo "\n\n";
            }
        }
    }

    public function displayPE() {
        $count = 0;
        for($i = 0; $i < $this->rosterSize; $i++) {
            $count++;
            if($this->roster[$i] !== null && $this->roster[$i]->getType() == "Piece Worker") {
                $employee = $this->roster[$i];
                echo "Employee #" . $count;
                echo "\nName: " . $employee->getName();
                echo "\nAddress: " . $employee->getAddress();
                echo "\nAge: " . $employee->getAge();
                echo "\nCompany: " . $employee->getCompany();
                echo "\nType: " . $employee->getType();
                echo "\n\n";
            }
        }
    }
    
    public function payroll() {
        for($i = 0; $i < $this->rosterSize; $i++) {
            if($this->roster[$i] !== null) {
                $employee = $this->roster[$i];
                echo "Employee #" . $i + 1;
                echo "\nName: " . $employee->getName();
                echo "\nAddress: " . $employee->getAddress();
                echo "\nAge: " . $employee->getAge();
                echo "\nCompany: " . $employee->getCompany();
                echo "\nType: " . $employee->getType();

                if($employee->getType() == "Commissioned Employee") {
                    echo "\nRegular Salary: " . $employee->getRegularSalary();
                    echo "\nItems Sold: " . $employee->getItemsSold();
                    echo "\nCommission Rate: " . $employee->getCommissionRate();
                }

                if($employee->getType() == "Hourly Employee") {
                    echo "\nHours Worked: " . $employee->getHoursWorked();
                    echo "\nRate: " . $employee->getHourlyRate();
                }

                if($employee->getType() == "Piece Worker") {
                    echo "\n# of Items: " . $employee->getItemsProduced();
                    echo "\nWage Per Item: " . $employee->getWagePerItem();
                }

                echo "\nEarnings: " . $employee->earnings();
                echo "\n\n";
            }
        }
    }
}
?>
