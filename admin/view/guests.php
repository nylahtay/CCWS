<?php

//get the location id ('loc=') from the url
$loc_id = filter_input(INPUT_GET, 'loc');

//if id is not null, then load the location up
if (!is_null($loc_id))  $location = $conn->getLocationFull($loc_id) ;

//set the operating date
$op_date = $location->getOpDate();

$guests = $conn->getGuests();
?>

<div id="top"></div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Guests</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='?action=newguest&loc=<?php echo $location->getId(); ?>'">New Guest</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Settings</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
        </button>
    </div>
</div>




<form id="guestSearch" class="row g-2">
    <div class="input-group">
        <input id="guestlistInput" class="form-control col-auto" list="guestlistOptions" placeholder="Search Guests..." autocomplete="off" disabled>
        <datalist id="guestlistOptions">
            <?php foreach ($guests as $guest) : ?>
            <option value="<?php echo $name = $guest->getFirstName() . ' ' . $guest->getLastName(); ?>" name="<?php echo $name; ?>" data-id="<?php echo $guest->getId();?>">Birthdate: <?php echo $guest->getBirthdate();?></option>
            <?php endforeach; ?>
        </datalist>
        <div class="input-group-text"><button class="btn " type="submit" disabled>Search</button></div>
    </div>    
</form>





<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Birthdate</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($guests as $guest) :
            $fname = $guest->getFirstName();
            $lname = $guest->getLastName();
            $bdate = $guest->getBirthdate();
            $guest_id = $guest->getId();
        ?>
        <tr data-id="<?php echo $guest_id; ?>">
            <th scope="row"><input class="form-check-input" type="checkbox" value="" id="checkbox-<?php echo $guest_id; ?>"></th>
            <td><?php echo $fname; ?></td>
            <td><?php echo $lname; ?></td>
            <td><?php echo $bdate; ?></td>
            <td><button class="btn btn-sm btn-primary" data-cmd="edit" data-id="<?php echo $guest_id; ?>" onclick="editGuest(this)">Edit Guest</button></td>
        </tr>
        <?php endforeach; ?>
  </tbody>
</table>




<script>
function editGuest(btn){
    selectedId = btn.getAttribute('data-id');
    window.location.href='?action=editguest&guestId='+selectedId;
}


</script>