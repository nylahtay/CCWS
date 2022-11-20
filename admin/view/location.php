<?php
$conn = new Mysql();

//todo - get the orginization date from the url
$org_id = 1;

//get the location id ('loc=') from the url
$loc_id = filter_input(INPUT_GET, 'loc');
//if id is not null, then load the location up

//set the operating date
$op_date = '2022-11-15';

if (!is_null($loc_id))  $location = $conn->getLocationFull($loc_id,$op_date) ;
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
        <div class="input-group-text"><button class="btn " type="submit">Check-In</button></div>
    </div>    
</form>

<a href="?action=newguest&loc=<?php echo $location->getId(); ?>" class="btn btn-outline-secondary my-4"> New Guest </a>
<div id="resultID" class="resultID"></div>



<script> 
//postAjax from https://plainjs.com/javascript/ajax/send-ajax-get-and-post-requests-47/
function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}

</script>


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
    guestInfo = ['<?php echo $org_id; ?>', '<?php echo $loc_id; ?>', selectedId,'<?php echo $op_date;?>']

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
    }, function(data){ alert(data) });

  }
</script>