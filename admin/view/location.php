<?php
$conn = new Mysql();

//todo - get the orginization id from the url
$org_id = 1;

//get the location id ('loc=') from the url
$loc_id = filter_input(INPUT_GET, 'loc');

//if id is not null, then load the location up
if (!is_null($loc_id))  $location = $conn->getLocationFull($loc_id) ;

//set the operating date
echo $op_date = $location->getOpDate();

$guests = $conn->getGuests();
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo $location->getName(); ?><span class="status <?php echo $location->getStatusString(); ?>"><?php echo $location->getStatusString(); ?><span></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary" onclick="<?php echo ($location->getStatus()) ? 'closeLocation()' : 'openLocation()' ; ?>"><?php echo ($location->getStatus()) ? 'Close Location' : 'Open Location' ; ?></button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Settings</button>
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
          <td><a href="#">0</a></td>
        </tr>
        <tr>
          <th scope="row">Checked in Guests</th>
          <td><a href="?action=status&loc=<?php echo $loc_id; ?>"><?php echo $location->getCapacity()-$location->getAvailability(); ?></a></td>
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



<script src="../js/json/postAjax.js"></script>


<script>



  



  var form = document.getElementById('guestCheckIn');
  form.addEventListener('submit', validateform);

  //this function will grab the selected item from the datalist
  //from https://jsfiddle.net/nylahtay/4g9sykLe/20/
  function validateform() {

    //prevent the default submiting of the form
    event.preventDefault();
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

      //todo: update the checked in Guests, and Available beds on the page.
      //for now we can simply reload
      location.reload();
    }
  }



  function openLocation()
  {
    <?php
      //generate the current date to be the check in date
      //YY-MM-DD HH-MM-SS
      //todo - change date and time to use location's settings for timezone
      date_default_timezone_set("America/Chicago");
      $new_op_date = date("Y-m-d");
    ?>

    //set the op_date to be the new generated op_date
    op_date = '<?php echo $new_op_date ?>';
    alert('opening location: date ' + op_date);
    //ajax call for user checkin.
    let jsonPath = "../js/json/location-open.php";

    //call the Ajax to get the results
    //example postAjax('http://foo.bar/', { p1: 1, p2: 'Hello World' }, function(data){ someFunction(data); });
    postAjax(jsonPath, { 
      'api_key': 'todo- create api key',
      'org_id': '<?php echo $org_id; ?>', 
      'loc_id': '<?php echo $loc_id; ?>', 
      'op_date': op_date 
    }, function(data){ openLocationResult(data); });
  }

  function openLocationResult(data){
    alert(data);
    location.reload();
  }



  function closeLocation()
  {
    alert('closing location');
    //ajax call for user checkin.
    let jsonPath = "../js/json/location-close.php";

    //call the Ajax to get the results
    //example postAjax('http://foo.bar/', { p1: 1, p2: 'Hello World' }, function(data){ someFunction(data); });
    postAjax(jsonPath, { 
      'api_key': 'todo- create api key',
      'org_id': '<?php echo $org_id; ?>', 
      'loc_id': '<?php echo $loc_id; ?>', 
    }, function(data){ closeLocationResult(data); });
  }

  function closeLocationResult(data){
    alert(data);
    location.reload();
  }

</script>