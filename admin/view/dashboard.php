<?php
$conn = new Mysql();

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
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
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
    <h1 class="h4"><?php echo $name; ?> <span class="status <?php echo $status; ?>"><?php echo $status; ?></span></h1>
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">Checked in Staff/Volunteers</th>
          <td><a href="#">4</a></td>
        </tr>
        <tr>
          <th scope="row">Checked in Guests</th>
          <td><a href="?action=status&loc=<?php echo $id; ?>"><?php echo $occupancy; ?></a></td>
        </tr>
        <tr>
          <th scope="row">Available Beds</th>
          <td><a href="#"><?php echo $avail; ?></a></td>
        </tr>
      </tbody>
    </table>
  </div>

  <?php endforeach; ?>
  
</div>



