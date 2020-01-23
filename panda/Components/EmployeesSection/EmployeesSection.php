<?php

use Components\EmployeeQuery\EmployeeQueryFactory;

$Employees = EmployeeQueryFactory::create();

dump($Employees);
?>

<?php if ($Employees->hasPosts()) { ?>
    <div class="container">
        <div class="row">
            <?php $Employees->thePosts(); ?>
        </div>
    </div>
<?php } ?>