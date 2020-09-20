<?php
session_start();

if (isset($_POST["btn_cadastrar"])) {
  require_once "./../Controller/PostController.php";

  PostController::insert([
    'title' => $_POST['title'],
    'text' => $_POST['text'],
    'author_id' => $_SESSION['user']['id']
  ]);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>

  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <!-- biblioteca necessarias pro summernote(jQuery, bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- summernote -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <title>Blog | Cadastrar Post</title>
</head>

<body>

  <form method="post" action="post.php">
    <div class="row mr-auto ml-auto pt-3" style="width: 50vw">
      <div class="col-md-12 mb-3">
        <input type="text" class="form-control" name="title" placeholder="Titulo da publicação">
      </div>
      <div class="col-md-12 mb-3">
        <textarea id="summernote" name="text"></textarea>
      </div>
      <div class="col-md-12 mb-3">
        <button type="submit" class="btn btn-primary btn-block" name="btn_cadastrar">
          Cadastrar
        </button>
      </div>
    </div>
  </form>

  <script>
    $(document).ready(function() {
      $('#summernote').summernote({
        placeholder: 'Corpo da publicação',
        height: 400
      });
    });
  </script>
  <?php
    if (isset($_GET["error"])) {
        echo "
        <script>
          alert('Ocorreu um erro no cadastro do Post');
        </script>
      ";
    }
    ?>

</body>

</html>