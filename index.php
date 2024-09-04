<?php 
require_once './dynoTables.php';
$records = [];
$otherRecords = [];
for($i=0; $i<100;$i++)
{
    $records[] = array(
        'id' => $i, 
        'item_number' => uniqid('',true),
        'date' => date('H:i:s A'),
    );
    $otherRecords[] = array(
        'id' => $i,    
        'name' => 'DT-'.($i*$i*1000),
        'item_number' => uniqid('IN-',true).($i*$i),
    );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?= build_dynotable($records); ?>   
            <hr>
            <?= build_dynotable($otherRecords); ?>
        </div>
    </div>
</div>

</body>
</html>

