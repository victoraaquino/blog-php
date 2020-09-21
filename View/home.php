<?php
session_start();

require_once "./../Controller/PostController.php";

$posts = PostController::getAllByAuthor($_SESSION['user']['id']);

if (isset($_GET["redirect"])) {
  $redirect = $_GET["redirect"];
  $params = isset($_GET["id"]) ? '?id=' . $_GET["id"] : '';

  header("Location: $redirect.php$params");
}

if (isset($_GET["delete"])) {
  PostController::remove($_GET["delete"]);
}

if (isset($_GET["logout"])) {
  unset($_SESSION["user"]);
  header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='./assets/css/home.css' type='text/css'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
  <title>Blog | Dashboard</title>
</head>

<body>
  <div class="menu">
    <a href="?redirect=post">Cadastrar posts</a>
    <a href="?logout=true">Sair</a>
  </div>

  <!-- Listagem dos posts cadastrados pelo usuario -->
  <?php
  foreach ($posts as $i => $post) {
  ?>
    <div class="card">
      <div class="card-body"style="height: 300px;">
        <a href="?redirect=post&id=<?php echo $post->getId() ?>">Editar</a>
        <a href="" onclick="deletePost(<?php echo $post->getId() ?>)">Excluir</a>
        <h1><?php echo $post->getTitle() ?></h1>
        <div style="height: 120px;overflow:auto"><?php echo $post->getText() ?></div>
        <p>Tags:
          <?php
          foreach ($post->getTags() as $i => $tag) {
            echo "<span class='tag' >".$tag->getName()."</span>";
          }
          ?>
        </p>
      </div>
    </div>

  <?php
  }
  ?>

  <script>
    function deletePost(postId) {
      $confirm = confirm("Deseja realmente excluir esse post?");
      if ($confirm) {
        window.location.href = window.location.href + `?delete=${postId}`;
      }
    }
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