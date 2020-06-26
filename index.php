<?php
error_reporting(E_ALL);
require_once 'app\config\db.php';
require_once 'app\config\function.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Comments</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js?"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js?"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Comments</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Главная</a>
      </li>
    </ul>

    <ul class="navbar-nav mr-right">
      <li class="nav-item">
        <a class="nav-link" href="#">Вход</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Регистрация</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container" style="margin-top: 20px">
   <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $required = ['name', 'comment'];
	  $errors = [];
      
      $rules = [
          'name' => function($value) {
              return validateLength($value, 2, 128);
          },
          'comment' => function($value) {
              return validateLength($value, 2, 3000);
          }
      ];
      
      $dataInsert = filter_input_array(INPUT_GET, ['name' => FILTER_DEFAULT, 'comment' => FILTER_DEFAULT], true);
      if(!empty($dataInsert)){
      foreach ($dataInsert as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }

        if (in_array($key, $required) && empty($value)) {
            $errors[$key] = "Поле $key надо заполнить";
        }
      }
      }

    $errors = array_filter($errors);


        ?>
  <div class="row">
    <div class="col col-md-12">
      <?php
      if(!empty($_GET)){
       if (count($errors)) {
        foreach($errors as $errorItem){
          echo "
          <div class=\"alert alert-warning alert-dismissible\" role=\"alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
            </button>
            <strong>Внимание! </strong>".$errorItem."</div>";
        }
		
	} else {
         echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden=\"true\">&times;</span></button>        <strong>Успех!</strong> Ваш комментарий успешно добавлен.</div>";
          $query = "INSERT INTO coments SET name='{$_GET['name']}', comment='{$_GET['comment']}'";
		mysqli_query($link, $query) or die(mysqli_error($link));
       }
      }

}
     
?>          
    </div>
  </div>


  <div class="card my-4">
    <h5 class="card-header">Оставить комментарий:</h5>
    <div class="card-body">
      <form action="" method="GET">
        <div class="form-group">
          <label for="name">Имя</label>
          <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
          <label for="name">Сообщение</label>
          <textarea class="form-control" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
       
      </form>
    </div>
  </div>
  <?php getComments($data); ?>
</div>

</body>
</html>
