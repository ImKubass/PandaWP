<?php

use Components\EmployeesQuery\EmployeesQueryFactory;

$Employees = EmployeesQueryFactory::create();
?>

<?php if ($Employees->hasPosts()) { ?>
    <div class="container">
        <div class="row">
            <?php $Employees->thePosts(); ?>
        </div>
    </div>
<?php } ?>