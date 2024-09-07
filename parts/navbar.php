<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <h3>DineshMotors</h3>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <form class="d-flex justify-content-center align-items-center" role="search">
      <?php
      session_start();
      if (isset($_SESSION['user_id'])) {
      ?>
        <p class="ms-2 mt-auto mb-auto">Welcome , <strong><?= $_SESSION['name'] ?></strong></p>
        <a href="lib/actions.php?query=logoutUser" class="btn btn-outline-danger ms-2">Logout</a>
      <?php
      } else {
      ?>
        <a class="btn btn-outline-primary ms-2" href="user_login.php" type="submit">Login</a>
      <?php
      }
      ?>

    </form>
  </div>
  </div>
</nav>