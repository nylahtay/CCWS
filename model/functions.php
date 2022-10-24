<?php 

//this function will return the layout with the correct view
// $layout = this is the layout file that we are using.
// $view = this is the view that we are using. (must use filename.php)
// $data (optional) = this is data we can pass to the view
// $head (optional) = this is an array for the page head info (title, ) for the metadata
// $extra (optional) = this is an array that if exists allows us to pass extra info like CSS and JS that are customizable per page.
function getLayout($layout, $view, $data = NULL, $head = NULL, $extra = NULL){
    $title = (isset($head['title'])) ? $head['title'] : '[Co]Video Store';
    $description = (isset($head['description'])) ? $head['description'] : NULL;
    $author = (isset($head['author'])) ? $head['author'] : 'NylahTay';

    $css = (isset($extra["css"])) ? $extra["css"] : NULL;
    $js = (isset($extra["js"])) ? $extra["js"] : NULL;

    $content = $view;
    include "view/layout/". $layout . ".php";
}

?>