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
         
        </div>
      </div>


<h1>Create New Guest</h1>

<form action="?" method="post" class="row g-3 needs-validation" novalidate>
  <div class="col-md-6">
    <label for="guestFirstName" class="form-label">First</label>
    <input type="text" class="form-control" placeholder="First Name" name="guest[FirstName]" id="guestFirstName" required>
    <div class="invalid-feedback">
      Please provide a valid name.
    </div>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6">
    <label for="guestLastName" class="form-label">Last</label>
    <input type="text" class="form-control" placeholder="Last Name" name="guest[LastName]" id="guestLastName" required>
    <div class="invalid-feedback">
      Please provide a valid name.
    </div>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-6">
    <label for="guestBirthdate" class="form-label">Birthdate</label>
    <input type="date" class="form-control" name="guest[Birthdate]" id="guestBirthdate" required>
    <div class="invalid-feedback">
      Please provide a valid birthdate.
    </div>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <!-- <div class="col-6">
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
  </div> -->
  <div class="col-12">
    <label for="guestNotes" class="form-label">Notes</label>
    <textarea class="form-control" name="guest[Notes]" placeholder="Guest notes" id="guestNotes"></textarea>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Create Guest</button>
    <button type="submit" class="btn btn-outline-primary">Create Guest & Check In</button>
  </div>
  <input type="hidden" name="postAction" value="createGuest">
</form>





<script>


// JavaScript for disabling form submissions if there are invalid fields from (https://getbootstrap.com/docs/5.0/forms/validation/#server-side)
  (function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()


  </script>
