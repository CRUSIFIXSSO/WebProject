<?php

require 'Controller/TeaController.php';
$teaController = new TeaController();

if(isset($_POST['types']))
{
    //Fill page with coffees of the selected type
    $teaTables = $teaController->CreateTeaTables($_POST['types']);
}
else 
{
    //Page is loaded for the first time, no type selected -> Fetch all types
    $teaTables = $teaController->CreateTeaTables('%');
}

//Output page data
$title = 'Tea overview';
$content = $teaController->CreateTeaDropdownList(). $teaTables;

include 'Template.php';
?>

