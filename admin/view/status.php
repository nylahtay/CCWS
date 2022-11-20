<?php
$conn = new Mysql();

//todo - get the orginization id from the url
$org_id = 1;


//get the location id ('loc=') from the url
$loc_id = filter_input(INPUT_GET, 'loc');
//if id is not null, then load the location up
if (!is_null($loc_id))  $location = $conn->getLocationById($loc_id) ;

//set the operating date
$op_date = $location->getOpDate();

$guests = $conn->getGuests();

$guestStatus = $conn->getGuestStatus($loc_id,$op_date);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo $location->getName(); ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
        </button>
    </div>
</div>

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
    ?>
    <tr>
        <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
        <td><?php echo $name ?></td>
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