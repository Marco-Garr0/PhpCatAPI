<!DOCTYPE html>
<html>
  <head>
    <title>Cat Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  </head>
  <?php
    include_once "CatDAO.php";
    $message = "";
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){
      $id = $_GET["id"];
      $cat = CatDAO::ReadById($id);
      if($cat == null){
        echo "<img src='./assets/NOGATTO.png' alt='SARDINIAN NURAGHE'min->";
      }
      else{
        echo"
            <div class='containter'> 
              <h1>
                CAT DETAIL
              </h1>
              <form method='POST'>  
                <label>
                  Id:
                </label>
                  <input value='".$cat->getId()."' type='text' name='inputId' readonly></input>
                <br>
                <br>
                <label>
                  Nome:
                </label>
                  <input value='".$cat->getName()."' type='text' name='inputName'></input>
                <br>
                <br>
                <label>
                  Age:
                </label>
                <input value='".$cat->getAge()."' type='number' min=1 max=100 name='inputAge'></input>
                <br>
                <br>
                <input type='submit' value='save' name='btnSave' class='btn btn-primary btn-left'></input>
                <input type='submit' value='delete' name='btnDelete' class='btn btn-danger btn-left'></input>
              </form>
            </div>
        ";
      }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["btnSave"])){
        $id = $_POST["inputId"];
        $name = $_POST["inputName"];
        
        $age = (int)filter_var($_POST["inputAge"], FILTER_SANITIZE_NUMBER_INT);

        $cat = new Cat($id, $name, $age);
        $result = CatDAO::update($cat);
        if($result){
          $message = "failed while updating the cat";
        }
        else{
          header("Location: index.php");
        }
      }
      else{
        $id = $_POST["inputId"];
        $name = $_POST["inputName"];
        $age = $_POST["inputAge"];
        $cat = new Cat($id, $name, $age);
        $result = CatDAO::delete($cat);
        if($result){
          $message = "failed while updating the cat";
        }
        else{
          header("Location: index.php");
        }
      }
    }
    echo "<h2>".$message."</h2>";
  ?>
</html>
;
