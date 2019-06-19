<?php
require './Controller/TeaController.php';
$teaController = new TeaController();

$title = "Add a new Tea";

if(isset($_GET["update"]))
{
    $tea = $teaController->GetTeaById($_GET["update"]);
    
    $content ="<form action='' method='post'>
    <fieldset>
        <legend>Add a new Tea</legend>
        <label for='name'>Name: </label>
        <input type='text' class='inputField' name='txtName' value='$tea->name'  /><br/>

        <label for='type'>Type: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$teaController->CreateOptionValues($teaController->GetTeaTypes()).
        "</select><br/>

        <label for='price'>Price: </label>
        <input type='text' class='inputField' name='txtPrice' value='$tea->price'/><br/>

        <label for='flavour'>Flavour: </label>
        <input type='text' class='inputField' name='txtFlavour' value='$tea->flavour' /><br/>

        <label for='country'>Country: </label>
        <input type='text' class='inputField' name='txtCountry' value='$tea->country' /><br/>

        <label for='image'>Image: </label>
        <select class='inputField' name='ddlImage'>"
        .$teaController->GetImages().
        "</select></br>

        <label for='review'>Review: </label>
        <textarea cols='70' rows='12' name='txtReview'>$tea->review</textarea></br>

        <input type='submit' value='Submit'>
    </fieldset>
</form>";
}
 else 
{
    $content ="<form action='' method='post'>
    <fieldset>
        <legend>Add a new Tea</legend>
        <label for='name'>Name: </label>
        <input type='text' class='inputField' name='txtName' /><br/>

        <label for='type'>Type: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$teaController->CreateOptionValues($teaController->GetTeaTypes()).
        "</select><br/>

        <label for='price'>Price: </label>
        <input type='text' class='inputField' name='txtPrice' /><br/>

        <label for='flavour'>Flavour: </label>
        <input type='text' class='inputField' name='txtFlavour' /><br/>

        <label for='country'>Country: </label>
        <input type='text' class='inputField' name='txtCountry' /><br/>

        <label for='image'>Image: </label>
        <select class='inputField' name='ddlImage'>"
        .$teaController->GetImages().
        "</select></br>

        <label for='review'>Review: </label>
        <textarea cols='70' rows='12' name='txtReview'></textarea></br>

        <input type='submit' value='Submit'>
    </fieldset>
</form>";
}


if(isset($_GET["update"]))
{
    if(isset($_POST["txtName"]))
    {
        $teaController->UpdateTea($_GET["update"]);
    }
}
else
{
    if(isset($_POST["txtName"]))
    {
        $teaController->InsertTea();
    }
}

include './Template.php';
?>
