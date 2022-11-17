<?php
$conn = new Mysql();

//get the location id ('loc=') from the url
$id = filter_input(INPUT_GET, 'loc');
//if id is not null, then load the location up

//set the processing date
$date = '2022-11-15';

if (!is_null($id))  $location = $conn->getLocationFull($id,$date) ;
var_dump($location);
$guests = $conn->getGuests();
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo $location->getName(); ?><span class="status <?php echo $location->getStatusString(); ?>"><?php echo $location->getStatusString(); ?><span></h1>
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
  <div class="col-sm-6">
    <table class="table">
      <!-- <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">First</th>
        </tr>
      </thead> -->
      <tbody>
        <tr>
          <th scope="row">Checked in Staff/Volunteers</th>
          <td><a href="#">4</a></td>
        </tr>
        <tr>
          <th scope="row">Checked in Guests</th>
          <td><a href="?action=status&loc=<?php echo $id; ?>"><?php echo $location->getCapacity()-$location->getAvailability(); ?></a></td>
        </tr>
        <tr>
          <th scope="row">Available Beds</th>
          <td><a href="#"><?php echo $location->getAvailability(); ?></a></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6 px-3">
    <h3>Staff/Volunteer Check-In</h3>

    <form class="row g-2">
        <div class="input-group">
            <input class="form-control col-auto" list="stafflistOptions" id="exampleDataList" placeholder="Type to search...">
            <datalist id="stafflistOptions">
                <option value="Nylah Rogers">
                <option value="Diane Love">
                <option value="Sam Matthews">
                <option value="Berry Johnson">
                <option value="Wilma Lewis">
            </datalist>
            <div class="input-group-text"><a class="btn ">Check-In</a></div>
        </div>    
        
    </form>
  </div>
</div>







<h1>Guest Check-In</h1>

<form class="row g-2">
    <div class="input-group">
        <input class="form-control col-auto" list="guestlistOptions" id="exampleDataList" placeholder="Search Guests...">
        <datalist id="guestlistOptions">
            <?php foreach ($guests as $guest) : ?>
            <option value="<?php echo $guest->getFirstName() . ' ' . $guest->getLastName();?>">
            <?php endforeach; ?>
        </datalist>
        <div class="input-group-text"><a class="btn ">Check-In</a></div>
    </div>    
    
</form>
<a href="?action=newguest&loc=<?php echo $location->getId(); ?>" class="btn btn-outline-secondary my-4"> New Guest </a>