<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>
        CAT DB
    </title>
</head>
<?php
include_once "CatDAO.php";
include_once "GenericDAO.php";
GenericDAO::connect();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $cats = CatDAO::readAll();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["btnNew"])){
        $id = CatDAO::create(new Cat(0, "", 0));
        header("location: CatDetail.php?id=".$id);
    }
    if(isset($_POST["btnFilter"])){
        $minAge = $_POST["txtMinAge"];
        $maxAge = $_POST["txtMaxAge"];
        if($minAge > $maxAge){
            exec('kill -9 ' . getmypid());
        }
        $cats = CatDAO::readAllByAge($minAge, $maxAge);
        echo $cats[1];
    }
    if(isset($_POST["btnFilterClear"])){
        $cats = CatDAO::readAll();
    }
}
?>
<div class="container">
    <h2 class="mb-4 mt-4">
        MIAO DATABASE
    </h2>

    <form method="POST" class="mb-4">
        <label> Min Age</label>
        <input type="number" name="txtMinAge"></input>
        <label> Max Age </label>
        <input type="number" name="txtMaxAge"></input>
        <button name="btnFilter" class="btn btn-primary btn-right"> <i class="bi bi-funnel-fill"></i> Filter </button>
        <button name="btnFilterClear" class="btn btn-primary btn-right"> <i class="bi bi-trash"></i>Clear FIlters </button>
    </form>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th class="text-center">
                Id
            </th>
            <th class="text-center">
                Name
            </th>
            <th class="text-center">
                Age
            </th>
            <th class="text-center">
                Edit
            </th>
        </tr>
        <tr>
            <?php

            include_once "Cat.php";
            include_once "CatDAO.php";

            foreach ($cats as $cat)
                $cat->catToHTMLTable();
            ?>
        </tr>
    </table>
    <br>
    <div class="d-flex justify-content-end">
        <form method="post">
            <button name="btnNew" class="btn btn-primary btn-right"> <i class="bi bi-plus-circle"></i> Create New Cat</button>
        </form>
    </div>
</html>
