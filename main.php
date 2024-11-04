<?php

class EmployeeRoster {

    private EmployeeRoster $roster;
    private $size;
    private $repeat;

    public function start() {
        $this->clear();
        $this->repeat = true;

        $this->size = readline("Enter the size of the roster: ");

        if ($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            readline("Press \"Enter\" key to continue...");
            $this->start();
        }

    }

    public function entrance() {
        $choice = 0;

        while ($this->repeat) {
            $this->clear();
            $this->menu();

            switch ($choice) {
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 0:
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
                    $this->entrance();
                    break;
            }
        }
        echo "Process terminated.\n";
        exit;
    }

    public function menu() {
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";
    }

    public function addMenu() {
    }

    public function empType($name, $address, $age, $cName) {
        $this->clear();
        echo "---Employee Details \n";
        echo "Enter name: $name\n";
        echo "Enter address: $address\n";
        echo "Enter company name: $cName\n";
        echo "Enter age: $age\n";
        echo "[1] Commission Employee       [2] Hourly Employee       [3] Piece Worker";
        $type = readline("Type of Employee: ");

        switch ($type) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->empType($name, $address, $age, $cName);
                break;
        }
    }

    public function addOnsCE($name, $address, $age, $cName) {
        $this->repeat();
    }

    public function addOnsHE($name, $address, $age, $cName) {
        $this->repeat();
    }

    public function addOnsPE($name, $address, $age, $cName) {
        $this->repeat();
    }

    public function deleteMenu() {
        $this->clear();

        echo "***List of Employees on the current Roster***\n";

        echo "\n[0] Return\n";

        readline("\nPress \"Enter\" key to continue...");
        $this->deleteMenu();
    }

    public function otherMenu() {
        $this->clear();
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[3] Payroll\n";
        echo "[0] Return\n";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 0:
                break;

            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
                break;
        }
    }

    public function displayMenu() {
        $this->clear();
        echo "[1] Display All Employee\n";
        echo "[2] Display Commission Employee\n";
        echo "[3] Display Hourly Employee\n";
        echo "[4] Display Piece Worker\n";
        echo "[0] Return\n";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 0:
                break;
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;

            default:
                echo "Invalid Input!";
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->displayMenu();
    }

    public function countMenu() {
        $this->clear();
        echo "[1] Count All Employee\n";
        echo "[2] Count Commission Employee\n";
        echo "[3] Count Hourly Employee\n";
        echo "[4] Count Piece Worker\n";
        echo "[0] Return\n";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 0:
                break;

            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;

            default:
                echo "Invalid Input!";
                break;
        }


        readline("\nPress \"Enter\" key to continue...");
        $this->countMenu();
    }

    public function clear() {
        system('clear');
    }

    public function repeat() {
        echo "Employee Added!\n";
        if ($this->roster->count() < $this->size) {
            $c = readline("Add more ? (y to continue): ");
            if (strtolower($c) == 'y')
                $this->addMenu();
            else
                $this->entrance();

        } else {
            echo "Roster is Full\n";
            readline("Press \"Enter\" key to continue...");
            $this->entrance();
        }
    }

class Person {
    protected $name;
    protected $address;

    public function __construct($name, $address) {
        $this->name = $name;
        $this->address = $address;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }
}
require_once 'Person.php';

abstract class Employee extends Person {
    protected $id;

    public function __construct($name, $address, $id) {
        parent::__construct($name, $address);
        $this->id = $id;
    }

    abstract public function earnings();

    public function getId() {
        return $this->id;
    }
}
require_once 'Employee.php';

class CommissionEmployee extends Employee {
    private $sales;
    private $commissionRate;

    public function __construct($name, $address, $id, $sales, $commissionRate) {
        parent::__construct($name, $address, $id);
        $this->sales = $sales;
        $this->commissionRate = $commissionRate;
    }

    public function earnings() {
        return $this->sales * $this->commissionRate;
    }
}
require_once 'Employee.php';

class HourlyEmployee extends Employee {
    private $hoursWorked;
    private $hourlyRate;

    public function __construct($name, $address, $id, $hoursWorked, $hourlyRate) {
        parent::__construct($name, $address, $id);
        $this->hoursWorked = $hoursWorked;
        $this->hourlyRate = $hourlyRate;
    }

    public function earnings() {
        return $this->hoursWorked * $this->hourlyRate;
    }
}
require_once 'Employee.php';

class PieceWorker extends Employee {
    private $piecesProduced;
    private $ratePerPiece;

    public function __construct($name, $address, $id, $piecesProduced, $ratePerPiece) {
        parent::__construct($name, $address, $id);
        $this->piecesProduced = $piecesProduced;
        $this->ratePerPiece = $ratePerPiece;
    }

    public function earnings() {
        return $this->piecesProduced * $this->ratePerPiece;
    }
}

class EmployeeRoster {
    private $employees = [];

    public function addEmployee(Employee $employee) {
        $this->employees[] = $employee;
    }

    public function getTotalEarnings() {
        $total = 0;
        foreach ($this->employees as $employee) {
            $total += $employee->earnings();
        }
        return $total;
    }

    public function listEmployees() {
        foreach ($this->employees as $employee) {
            echo "ID: " . $employee->getId() . ", Name: " . $employee->getName() . ", Earnings: " . $employee->earnings() . "\n";
        }
    }
}


?>
