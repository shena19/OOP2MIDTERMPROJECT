<?php

class Main {
    private EmployeeRoster $roster;
    private $size;

    public function start() {
        $this->clear();
        $this->size = (int) readline("Enter the size of the roster: ");

        if($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            readline("Press \"Enter\" key to continue...");
            $this->start();
        }

        $this->roster = new EmployeeRoster($this->size);

        $this->menu();
    }

    public function menu() {
        $this->clear();
        $count = $this->roster->count();

        echo "Available Space on the roster:" . ($this->size - $count) . "\n" ;
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";

        $choice = readline("Pick from the menu: ");

        switch ($choice) {
            case 1:
                if($this->roster->count() >= $this->size) {
                    echo "Roster is Full\n";
                    readline("Press \"Enter\" key to continue...");
                    $this->menu();
                    break;
                }

                $this->addMenu();
                break;
            case 2:
                $this->deleteMenu();
                break;
            case 3:
                $this->otherMenu();
                break;
            case 0:
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->menu();
                break;
        }

        echo "Process terminated.\n";
        exit;
    }

    public function addMenu() {
        $this->clear();

        echo "Add Employee\n";
        echo "---Employee Details \n";

        $name = readline("Enter name: ");
        $address = readline("Enter address: ");
        $cName = readline("Enter company name: ");
        $age = (int) readline("Enter age: ");

        $this->empType($name, $address, $age, $cName);
    }

    public function empType($name, $address, $age, $cName) {
        $this->clear();

        echo "---Employee Details \n";
        echo "Enter name: $name\n";
        echo "Enter address: $address\n";
        echo "Enter company name: $cName\n";
        echo "Enter age: $age\n";

        echo "[1] Commission Employee       [2] Hourly Employee       [3] Piece Worker\n";
        $type = readline("Type of Employee: ");

        switch ($type) {
            case 1:
                $this->addOnsCE($name, $address, $age, $cName);
                break;
            case 2:
                $this->addOnsHE($name, $address, $age, $cName);
                break;
            case 3:
                $this->addOnsPE($name, $address, $age, $cName);
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->empType($name, $address, $age, $cName);
                break;
        }

    }

    public function addOnsCE($name, $address, $age, $cName) {
        $regularSalary = (int) readline("Enter Regular Salary: ");
        $numberOfItems = (int) readline("Enter # of Items: ");
        $commission = (int) readline("Enter commission (%): ");

        $ce = new CommissionEmployee($regularSalary,  $numberOfItems, $commission, $name, $address, $age, $cName);
        $this->roster->add($ce);
        $this->repeat();
    }

    public function addOnsHE($name, $address, $age, $cName) {
        $hoursWorked = (int) readline("Enter hours worked: ");
        $rate = (int) readline("Enter rate: ");

        $he = new HourlyEmployee($hoursWorked, $rate, $name, $address, $age, $cName);
        $this->roster->add($he);
        $this->repeat();
    }

    public function addOnsPE($name, $address, $age, $cName) {
        $items = (int) readline("Enter # of items: ");
        $wage = (int) readline("Enter wage per item: ");

        $pe = new PieceWorker($items, $wage, $name, $address, $age, $cName);
        $this->roster->add($pe);
        $this->repeat();
    }

    public function deleteMenu() {
        $this->clear();

        echo "***List of Employees on the current Roster***\n";

        $this->roster->display();

        echo "\n[0] Return\n";

        $index = (int) readline("Select Employee to Remove (use the assigned #): ");

        if($index == 0) {
            $this->menu();
            return;
        } 

        if($index < 0 || $index > $this->size) {
            echo "Invalid employee number\n";
        } else {
            if($this->roster->remove($index - 1)) {
                echo "Employee was successfuly removed!";
            } else {
                echo "Slot is empty";
            }
        }

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
                $this->displayMenu();
                break;
            case 2:
                $this->countMenu();
                break;
            case 3:
                $this->payroll();
                break;
            case 0:
                $this->menu();
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
                $this->otherMenu();
                break;
            case 1:
                $this->roster->display();
                break;
            case 2:
                $this->roster->displayCE();
                break;
            case 3:
                $this->roster->displayHE();
                break;
            case 4:
                $this->roster->displayPE();
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
                $this->otherMenu();
                break;
            case 1:
                echo "Total Employee on the Roster: " . $this->roster->count();
                break;
            case 2:
                echo "Total Commissioned Employee on the Roster: " . $this->roster->countCE();
                break;
            case 3:
                echo "Total Hourly Employee on the Roster: " . $this->roster->countHE();
                break;
            case 4:
                echo "Total Piece Worker on the Roster: " . $this->roster->countPE();
                break;

            default:
                echo "Invalid Input!";
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->countMenu();
    }

    public function payroll() {
        $this->clear();
        $this->roster->payroll();

        readline("\nPress \"Enter\" key to continue...");
        $this->otherMenu();
    }

    public function clear() {
        echo "\033[2J\033[H";
    }

    public function repeat() {
        echo "Employee Added!\n";
        if ($this->roster->count() < $this->size) {
            $c = readline("Add more ? (y to continue): ");
            if (strtolower($c) == 'y')
                $this->addMenu();
            else
                $this->menu();

        } else {
            echo "Roster is Full\n";
            readline("Press \"Enter\" key to continue...");
            $this->menu();
        }
    }
}
?> 
