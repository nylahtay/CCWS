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
         
        </div>
      </div>


<h1>Edit Guest</h1>

<form action="?" method="post" class="row g-3">
  <div class="col-md-6">
    <label for="guestFirstName" class="form-label">First</label>
    <input type="text" class="form-control" name="guest[FirstName]" id="guestFirstName">
  </div>
  <div class="col-md-6">
    <label for="guestLastName" class="form-label">Last</label>
    <input type="text" class="form-control" name="guest[LastName]" id="guestLastName">
  </div>
  <div class="col-6">
    <label for="guestBirthdate" class="form-label">Birthdate</label>
    <input type="date" class="form-control" name="guest[Birthdate]" id="guestBirthdate">
  </div>
  <div class="col-6">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="guest[Pet]" id="guestPet">
        <label class="form-check-label" for="guestPet">
            Pet
        </label>
    </div>
    <div>
        <input class="form-check-input" type="checkbox" name="guest[Family]" id="guestFamily">
        <label class="form-check-label" for="guestFamily">
            Family Group
        </label>
    </div>
  </div>
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Create Guest</button>
    <button type="submit" class="btn btn-outline-primary">Create Guest & Check In</button>
  </div>
  <input type="hidden" name="guestId" value="<?/*= $guest->getId() ;*/?>">
  <input type="hidden" name="postAction" value="update">
</form>

