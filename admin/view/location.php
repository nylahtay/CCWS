<?php
$guests = $conn->getGuests();
?>


<div class="row">
  <div class="col-sm-6">
    <div class="list-group">
      <a href="#" class="text-decoration-none list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        Checked in Staff/Volunteers
        <span class="badge rounded-pill text-bg-secondary">0</span>
      </a>
      <a href="?action=status&loc=<?php echo $loc_id; ?>" class="text-decoration-none list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        Checked in Guests
        <span class="badge rounded-pill text-bg-secondary"><?php echo $location->getCapacity()-$location->getAvailability(); ?></span>
      </a>
      <a href="?action=status&loc=<?php echo $loc_id; ?>" class="text-decoration-none list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        Available Beds
        <span class="badge rounded-pill text-bg-primary"><?php echo $location->getAvailability(); ?></span>
      </a>
    </div>
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



<div class="m-4"></div>



<h3>Guest Check-In</h3>
<form id="guestCheckIn" class="row g-2">
    <div class="input-group">
        <input id="guestlistInput" class="form-control col-auto" list="guestlistOptions" placeholder="Search Guests..." autocomplete="off">
        <datalist id="guestlistOptions">
            <?php foreach ($guests as $guest) : ?>
            <option value="<?php echo $name = $guest->getFirstName() . ' ' . $guest->getLastName(); ?>" name="<?php echo $name; ?>" data-id="<?php echo $guest->getId();?>">Birthdate: <?php echo $guest->getBirthdate();?></option>
            <?php endforeach; ?>
        </datalist>
        <div class="input-group-text"><button class="btn " type="submit" <?php echo ($location->getStatus()) ? '' : 'disabled' ?>>Check-In</button></div>
    </div>    
</form>

<a href="?action=newguest&loc=<?php echo $location->getId(); ?>" class="btn btn-outline-secondary my-4"> New Guest </a>
<div id="resultID" class="resultID"></div>


<!-- Checkin Fields Modal -->
<!-- this gets called by the javascript guestCheckin() function -->
<div class="modal fade" id="modal-checkin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-checkinLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-checkinLabel">Check In</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate>
          <div class="col-md-6">
            <label for="guestLastName" class="form-label"># of Pets</label>
            <input type="number" class="form-control" id="guestLastName" autocomplete="off" value="0" required>
            <div class="invalid-feedback">
              Please provide a valid name.
            </div>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="model-checkin-submit" class="btn btn-primary">Continue Check-In</button>
      </div>
    </div>
  </div>
</div>
<!-- END Checkin Fields Modal -->


<script>
  //get the guestCheckIn form
  var form = document.getElementById('guestCheckIn');
  //on Submit run the guestCheckin 
  form.addEventListener('submit', guestCheckin);            

  function guestCheckin()
  {
    //prevent the default submiting of the form
    event.preventDefault();

    //get the guestCheckin field input
    let inputField = document.getElementById('guestlistInput');

    //if the input is blank, do nothing
    //todo - if the input doesn't match a guest, use a new model to alert and allow them to go to the add guest page.
    if (inputField.value == ""){
      //do nothing
    }
    else {
      //check to see if we need the model
      let activeModal = true; //todo - this should check the location settings to see if there are additional fields required. 

      if (activeModal)
      {
        //create the Modal for additional checkin fields
        var myModal = new bootstrap.Modal(document.getElementById('modal-checkin'));
        //show the model
        myModal.show();

        let button = document.getElementById("model-checkin-submit");
        //onclick hide the modal and run the checkin
        button.addEventListener("click", function () {myModal.hide(); validateform();});
      }
      else {
        //go ahead and run the checkin
        validateform();
      }
    }
  }



  //this function will grab the selected item from the datalist
  //from https://jsfiddle.net/nylahtay/4g9sykLe/20/
  function validateform() {

    
    var selectedOption = guestlistOptions.options.namedItem(guestlistInput.value);
    if (selectedOption) {
        var selectedId = selectedOption.getAttribute('data-id');
        var result = "Guest ID: " + selectedId;
        console.log({selectedId});
    } else {
        var result = "No ID available for value: " + guestlistInput.value;
    }
    
    


    document.getElementById('resultID').textContent = result; 
    // Can also use : 
    // inputElement = document.getElementById("guestlistInput");
    // listElement = document.getElementById("guestlistOptions");

    //create the guest info array
    //org_id, loc_id, user_id, operating_date 
    guestInfo = ['<?php echo $org_id; ?>', '<?php echo $loc_id; ?>', selectedId,'<?php echo $op_date;?>'];

    //ajax call for user checkin.
    let jsonPath = "../js/json/checkinGuest.php";

    //call the Ajax to get the results
    //example postAjax('http://foo.bar/', { p1: 1, p2: 'Hello World' }, function(data){ someFunction(data); });
    
    /*postAjax(jsonPath, { 
      'api_key': 'todo- create api key',
      'org_id': '<?php echo $org_id; ?>', 
      'loc_id': '<?php echo $loc_id; ?>', 
      'usr_id': selectedId, 
      'op_date': '<?php echo $op_date; ?>' 
    }, function(data){ ajaxResponse(data); });
    */

    //funtion to handle the response back from the postAjax
    function ajaxResponse(data)
    {
      //for now, alert
      alert(data);

      //todo: update the checked in Guests, and Available beds on the page.
      //for now we can simply reload
      location.reload();
    }
  }



  

  
  //this function will create an alert.
  //message is the message of the alert
  //elementId is the location where the alert will be put into
  //type is the type of alert
  function createAlert(message, elementId, type)
  {
    let classType = "alert-" + type;
    let div = document.createElement("div");
    div.innerHTML = message;
    div.classList.add("alert",classType);
    let id = document.getElementById(elementId);
    id.prepend(div);
  }

</script>