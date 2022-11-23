<?php

//make a connection to the DB
$conn = new Mysql();

//todo - get the orginization id from the url
$org_id = 1;
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $description ?>">
        <meta name="author" content="<?php echo $author ?>">
        <title><?php echo $title ?></title>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


        <?php
        //if css is passed in the getLayout function spit it out here
        if ( isset($css )) {
            echo '<!-- Custom styles for this template -->';
            if(gettype($css)=="array")
            {
                foreach ($css as $link){
                    echo '<link href="'. $link .'" rel="stylesheet">
                    ';
                }
            }
            else {
                echo '<link href="'. $css .'" rel="stylesheet">';
            }
        }
            
        ?>

    </head>
    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <?php include 'view/partials/header.php' ?>
        </header>

        <div class="container-fluid">
            <div class="row">
            <?php include 'view/partials/sidebar.php' ?>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div id="top"></div>
            
            <?php 
            //get the location id ('loc=') from the url
            $loc_id = filter_input(INPUT_GET, 'loc');

            //if id is not null, then load the location up

            if (!is_null($loc_id))  $location = $conn->getLocationFull($loc_id) ;
            else die;
            //set the operating date
            $op_date = $location->getOpDate();
            
            ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><a class="text-decoration-none" href="?action=location&loc=<?php echo $loc_id; ?>"><?php echo $location->getName(); ?></a></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="toolbar-text me-2"><?php echo (isset($op_date)) ? '<p>Operating Date: ' . date("m/d/Y", strtotime($op_date)) : ''; ?></p></div>
                        
                        <div class="btn-group me-2">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="badge border border-dark rounded-pill status-<?php echo $location->getStatusString(); ?>">&nbsp;</span> 
                            <?php echo ($location->getStatus()) ? 'Open' : 'Closed' ; ?>
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="<?php echo ($location->getStatus()) ? 'closeLocation()' : 'openLocation()' ; ?>"><?php echo ($location->getStatus()) ? 'Close Location' : 'Open Location' ; ?></a></li>
                            <li><a class="dropdown-item" href="#">Change Operating Date</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='?action=location_settings&loc=<?php echo $location->getId(); ?>'">Settings</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='?action=location_edit&loc=<?php echo $location->getId(); ?>'">Edit Location</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            This week
                        </button>
                    </div>
                </div>

                <?php include 'view/' . $content ; ?>
            </main>
        
            </div>
        </div>

        <script src="../js/json/postAjax.js"></script>
        <script>
            function openLocation()
                {
                    //create modal for date question.

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

                    //todo - replace confirm with https://getbootstrap.com/docs/5.2/components/modal/#static-backdrop

                    //confirm that they want to take the option
                    var response = confirm("Are you sure you want to continue?\nThis will check out any remaining guests.");
                    if (response == true) {
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
                    
                }

                function closeLocationResult(data){
                    alert(data);
                    location.reload();
                }
        </script>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>

        <?php
            //if js is passed in the getLayout function spit it out here
            if ( isset($js) ) {
                if(gettype($js)=="array")
                {
                    foreach ($js as $link){
                        echo '<script src="'. $link .'"></script>
                        ';
                    }
                }
                else {
                    echo '<script src="'. $js .'"></script>';
                }
            }
        ?>
    </body>
</html>