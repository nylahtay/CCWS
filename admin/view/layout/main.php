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
                <?php include 'view/' . $content ; ?>
            </main>
        
            </div>
        </div>



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