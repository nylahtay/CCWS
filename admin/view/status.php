<?php
$conn = new Mysql();

//get the location id ('loc=') from the url
$id = filter_input(INPUT_GET, 'loc');
//if id is not null, then load the location up
if (!is_null($id))  $location = $conn->getLocationById($id) ;

$guests = $conn->getGuests();
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
    <?php foreach ($guests as $guest) :
        $username = $guest->getUsername();
        $fname = $guest->getFirstName();
        $lname = $guest->getLastName();
        $email = $guest->getEmail();
        $phone = $guest->getPhone();
        $id = $guest->getId();
    ?>
    <tr>
        <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
        <td><?php echo $fname ?> <?php echo $lname ?></td>
        <td> </td>
        <td> </td>
        <td><a class="btn btn-primary">Check Out</a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>