
<?php 
require_once './dynoTables.php';
$records = [];
$otherRecords = [];
for($i=0; $i<100;$i++)
{
    $records[] = array(
        'id' => $i, 
        'item_number' => uniqid('',true),
        'date' => date('Y-m-d H:i:s')
    );
    $otherRecords[] = array(
        'id' => $i,    
        'date' => date('Y-m-d H:i:sa')
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

