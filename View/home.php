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
  <title>Blog | Dashboard</title>
</head>

<body>
  <a href="?redirect=post">Cadastrar posts</a>
  <a href="?logout=true">Sair</a>
  <!-- Listagem dos posts cadastrados pelo usuario -->
  <?php
  foreach ($posts as $i => $post) {
  ?>
    <div>
      <a href="?redirect=post&id=<?php echo $post->getId() ?>">Editar</a>
      <a onclick="deletePost(<?php echo $post->getId() ?>)">Excluir</a>
      <h1><?php echo $post->getTitle() ?></h1>
      <p><?php echo $post->getText() ?></p>
      <p>Tags:
        <?php
        foreach ($post->getTags() as $i => $tag) {
          echo $tag->getName() . " ";
        }
        ?>
      </p>
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