<?php
session_start();
require_once "./../Controller/PostController.php";
require_once "./../Controller/TagController.php";
require_once "./../Controller/PostTagController.php";

$id = '';
$title = '';
$text = '';
$btnValue = 'Cadastrar';
$btnName = 'btn_insert';
$tags = TagController::getAll();
$postTags = [];

if (isset($_GET['id'])) {
  $post = PostController::getOne($_GET['id']);
  $id = $post->getId();
  $title = $post->getTitle();
  $text = $post->getText();

  $postTags = $post->getTags();

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
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./assets/css/post.css">

  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <!-- biblioteca necessarias pro summernote(jQuery, bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- summernote -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <title>Blog | Cadastrar Post</title>
</head>

<body>
  <div class="menu">
    <a href="?redirect=home">Voltar</a>
  </div>

  <form method="post" action="post.php">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <div class="row pt-3" style="width: 50vw;margin-left:auto;margin-right:auto">
      <div class="col-md-12" style="margin-bottom: 20px">
        <input type="text" class="form-control required" name="title" placeholder="Titulo da publicação" value="<?php echo $title ?>" onkeypress="verifyField()">
      </div>
      <div class="col-md-12">
        <textarea id="summernote" name="text"><?php echo $text ?></textarea>
      </div>
      <div class="col-md-12" style="padding: 0px;margin-bottom: 20px">
        <div class="row">
          <div class="col-md-6">
            <div class="show_tags" id="show_tags">
              <?php
              foreach ($postTags as $i => $tag) {
              ?>
                <span class="tag"><?php echo $tag->getName() ?></span>
              <?php
              }
              ?>
            </div>
            <div class="hidden" id="container_tags"></div>
          </div>
          <div class="col-md-6">
            <select class="form-control" id="tag" style="margin-bottom: 20px">
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
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-block" name="<?php echo $btnName ?>" id="btn">
          <?php echo $btnValue ?>
        </button>
      </div>
    </div>
  </form>

  <script>
    function handleAddTag() {

      const tags = document.querySelectorAll('.tag_hidden');
      let textOption = $("#tag option:selected").text();
      let tagId = $('#tag').val();

      if ($('#tag').val() == 0) {
        return;
      }

      let isExists = false;

      tags.forEach(tag => {
        if (tag.value == tagId) {
          isExists = true;
        }
      })

      if (isExists) {
        alert("Tag já adicionada!");
        return;
      }

      //adicionando as tags
      $('#container_tags').append(`
        <input type="hidden" name="tags[]" value="${tagId}" class="tag_hidden"/>
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
        height: 400,
        lang: 'pt-BR'
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
  <script>
    $('#btn').attr('disabled', 'disabled');
    function verifyField() {
      let isEmpty = '';

      document.querySelectorAll('.required').forEach(e => {
        if (e.value == '') {
          e.style.border = "1px solid red";
          isEmpty = true
        } else {
          e.style.border = "1px solid green";
        }
      });

      if (isEmpty) {
        $('#btn').attr('disabled', 'disabled');
      } else {
        $('#btn').removeAttr('disabled');
      }
    }
  </script>
</body>

</html>