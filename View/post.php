<?php
session_start();
require_once "./../Controller/PostController.php";
require_once "./../Controller/TagController.php";

$id = '';
$title = '';
$text = '';
$btnValue = 'Cadastrar';
$btnName = 'btn_insert';
$tags = TagController::getAll();

if (isset($_GET['id'])) {
  $post = PostController::getOne($_GET['id']);
  $id = $post->getId();
  $title = $post->getTitle();
  $text = $post->getText();

  $btnValue = 'Editar';
  $btnName = 'btn_update';
}

if (isset($_POST["btn_insert"])) {
  PostController::insert([
    'title' => $_POST['title'],
    'text' => $_POST['text'],
    'author_id' => $_SESSION['user']['id'],
    'tags' => $_POST['tags']
  ]);
}

if (isset($_POST["btn_update"])) {
  PostController::update([
    'id' => $_POST['id'],
    'title' => $_POST['title'],
    'text' => $_POST['text'],
    'tags' => $_POST['tags']
  ]);
}

if (isset($_GET["redirect"])) {
  $redirect = $_GET["redirect"];
  header("Location: $redirect.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>

  <link rel="stylesheet" href="./assets/css/post.css">

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

  <a href="?redirect=home">Voltar</a>

  <form method="post" action="post.php">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <div class="row mr-auto ml-auto pt-3" style="width: 50vw">
      <div class="col-md-12 mb-3">
        <input type="text" class="form-control" name="title" placeholder="Titulo da publicação" value="<?php echo $title ?>">
      </div>
      <div class="col-md-12 mb-3">
        <textarea id="summernote" name="text"><?php echo $text ?></textarea>
      </div>
      <div class="col-md-12 mb-3" style="padding: 0px">
        <div class="row">
          <div class="col-md-6">
            <div class="show_tags" id="show_tags"></div>
            <div class="hidden" id="container_tags"></div>
          </div>
          <div class="col-md-6">
            <select class="form-control mb-3" id="tag">
              <option value="">Selecione</option>
              <?php
              foreach ($tags as $i => $tag) {
              ?>
                <option value="<?php echo $tag->getId() ?>"><?php echo $tag->getName() ?></option>
              <?php
              }
              ?>
            </select>
            <button type="button" class="btn btn-primary btn-block" onclick="handleAddTag()">Adicionar Tag</button>
          </div>
        </div>
      </div>
      <div class="col-md-12 mb-3">
        <button type="submit" class="btn btn-primary btn-block" name="<?php echo $btnName ?>">
          <?php echo $btnValue ?>
        </button>
      </div>
    </div>
  </form>

  <script>
    const tags = [];

    function handleAddTag() {

      let textOption = $("#tag option:selected").text();
      let tagId = $('#tag').val();

      if ($('#tag').val() == 0) {
        return;
      }

      const isExists = tags.map(tag => {
        if (tag == tagId) {
          return true;
        }
      })

      if(isExists.length > 0){
        alert("Tag já adicionada!");
        return;
      }

      tags.push(tagId);

      //adicionando as tags
      $('#container_tags').append(`
        <input type="hidden" name="tags[]" value="${tagId}" />
      `);

      //colocando as tags no container
      $('#show_tags').append(`
        <span class="tag">${textOption}</span>
      `);

    }
  </script>

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