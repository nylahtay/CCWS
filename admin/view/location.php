<?php
$conn = new Mysql();

//get the location id ('loc=') from the url
$id = filter_input(INPUT_GET, 'loc');
//if id is not null, then load the location up
if (!is_null($id))  $location = $conn->getLocationById($id) ;
var_dump($location);
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
          <td><a href="?action=status&loc=<?php echo $location->getId(); ?>">34</a></td>
        </tr>
        <tr>
          <th scope="row">Available Beds</th>
          <td><a href="#">6</a></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6 px-3">
    <h3>Staff/Volunteer Check-In</h3>

    <form class="row g-2">
        <div class="input-group">
            <input class="form-control col-auto" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
            <datalist id="datalistOptions">
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
        <input class="form-control col-auto" list="datalistOptions" id="exampleDataList" placeholder="Search Guests...">
        <datalist id="datalistOptions">
            <option value="Nylah Rogers">
            <option value="Diane Love">
            <option value="Sam Matthews">
            <option value="Berry Johnson">
            <option value="Wilma Lewis">
        </datalist>
        <div class="input-group-text"><a class="btn ">Check-In</a></div>
    </div>    
    
</form>
<a href="?action=newguest&loc=<?php echo $location->getId(); ?>" class="btn btn-outline-secondary my-4"> New Guest </a>