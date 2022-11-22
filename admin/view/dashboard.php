<?php
//get the location id ('loc=') from the url
$id = filter_input(INPUT_GET, 'loc');
//if id is not null, then load the location up
$date = '2022-11-15';
$locations = $conn->getLocationsFull( $date);
$guests = $conn->getGuests();

?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">New Location</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Settings</button>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
      <span data-feather="calendar" class="align-text-bottom"></span>
      This week
    </button>
  </div>
</div>


<div class="row">
  <?php foreach ($locations as $location) :
      $name = $location->getName();
      $id = $location->getId();
      $capacity = $location->getCapacity();
      $status = $location->getStatusString();
      $avail = $location->getAvailability();
      $occupancy = $capacity - $avail;
  ?>  

  <div class="col-sm-6 p-3">
    <h1 class="h4"><a class="text-decoration-none" href="?action=location&loc=<?php echo $id; ?>"><?php echo $name; ?></a> <span class="status status-<?php echo $status; ?>"><?php echo $status; ?></span></h1>
    <div class="list-group">
      <a href="#" class="text-decoration-none list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        Checked in Staff/Volunteers
        <span class="badge rounded-pill text-bg-secondary">0</span>
      </a>
      <a href="?action=status&loc=<?php echo $id; ?>" class="text-decoration-none list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        Checked in Guests
        <span class="badge rounded-pill text-bg-secondary"><?php echo $occupancy; ?></span>
      </a>
      <a href="?action=status&loc=<?php echo $id; ?>" class="text-decoration-none list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        Available Beds
        <span class="badge rounded-pill text-bg-secondary"><?php echo $avail; ?></span>
      </a>
    </div>
  </div>

  <?php endforeach; ?>
  
</div>



