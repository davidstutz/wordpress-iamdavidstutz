<?php
/*  
Template Name: Redirect
*/ 

$url = get_field('url');
if (!empty($url)) {
    header('Location: ' . $url);
}
else {
    header('Location: https://davidstutz.de');
}

exit();

?>