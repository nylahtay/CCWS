<?php
$guests = $conn->getGuests();

$guestStatus = $conn->getGuestStatus($loc_id,$op_date);

//todo - need to add this to the location class.
//see if location uses additional fields
$useAdditionalFields = $location.getUseAdditionalFields();
?>

<h2>Guest Status</h2>


<?php
    if(empty($guestStatus)):?>
        <p>No Guests Checked In</p>
<?php else:   ?>
<div class="table-responsive">
<table class="table table-striped table-hover table-sm">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col">Name</th>
        <th scope="col">Check-In Time</th>
        <th scope="col">Check-Out Time</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    
    <?php
    foreach ($guestStatus as $status) :
        $name = $status[0];
        $checkin = $status[1];
        $checkout = $status[2];
        $usr_id = $status[3];
        $usr_pet = $status[4];
        if ($useAdditionalFields){
            $usr_pet = $status[4];
        }
    ?>
    <tr>
        <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
        <td><?php echo $name ?></td>
        <?php echo ($useAdditionalFields)? '<td>'.$usr_pet.'</td>':''; ?>
        <td><?php echo $checkin ?></td>
        <td><?php echo $checkout ?></td>
        <td><?php echo (is_null($checkout)) ? '<button class="btn btn-sm btn-primary" data-cmd="checkout" data-id="' . $usr_id . '" onclick="checkoutGuest(this)">Check Out</button>' : ' ' ; ?></td>
    </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>
</div>




<script src="../js/json/postAjax.js"></script>

<script>
    function checkoutGuest(btn)
    {
	    selectedId = btn.getAttribute('data-id');

        alert(selectedId);

        //create the guest info array
        //org_id, loc_id, user_id, operating_date 
        guestInfo = ['<?php echo $org_id; ?>', '<?php echo $loc_id; ?>', selectedId,'<?php echo $op_date;?>'];

        //ajax call for user checkin.
        let jsonPath = "../js/json/checkoutGuest.php";

        //call the Ajax to get the results
        //example postAjax('http://foo.bar/', { p1: 1, p2: 'Hello World' }, function(data){ someFunction(data); });
        postAjax(jsonPath, { 
        'api_key': 'todo- create api key',
        'org_id': '<?php echo $org_id; ?>', 
        'loc_id': '<?php echo $loc_id; ?>', 
        'usr_id': selectedId, 
        'op_date': '<?php echo $op_date; ?>' 
        }, function(data){ ajaxResponse(data); });


        //funtion to handle the response back from the postAjax
        function ajaxResponse(data)
        {
        //for now, alert
        alert(data);

        //todo: update the checked in Guests
        //for now reload
        location.reload();
        }
    }
</script>