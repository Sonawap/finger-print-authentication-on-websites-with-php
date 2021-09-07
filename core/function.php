<?php

require_once "user.php"; 
$state_id = $_REQUEST['state_id'];

$states = $user->getLGA($state_id);

while($row = $states->fetch_assoc()):?>
    <option><?php echo $row['name'] ?></option>
<?php endwhile ?>
