<?php

require_once('../zUtils/HouseLoan.php');

use Zutils\HouseLoan;

$test1 = new HouseLoan(1, 600000, 20);

echo $test1->returnPerMonth();
echo "\n";
