<!--Titre-->
  <h3 align="center">Register and make your own To Do List!</h3><br>

<!--Forulaire inscription-->
  <section class="add-form container-fluid row">
    <div class="col-md-4"></div>

    <form class="form-zone col-md-4" action="" method="POST">

      <div class="form-group">
        <label for="pseudo">Nickname</label>
        <input class="form-control" type="text" name="pseudo" id="pseudo">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" id="email">
      </div>

      <div class="form-group">
        <label for="email2">Confirm your email</label>
        <input class="form-control" type="email" name="email2" id="email2">
      </div>

      <div class="form-group">
        <label for="mdp">Choose a password</label>
        <input class="form-control" type="password" name="mdp" id="mdp">
      </div>

      <div class="form-group">
        <label for="mdp2">Confirm your password</label>
        <input class="form-control" type="password" name="mdp2" id="mdp2">
      </div>

      <div class="form-group">
        <button class="btn btn-dark" type="submit" name="submit">Register</button>
        <a href="../index/signin.php" role="button" class="btn btn-outline-secondary">Already member? Sign in</a>
      </div>
    </form>

    <div class="col-md-4"></div>
  </section>
<!--Message d'erreur en cas de mauvaise entrée-->
  <h6 align="center" style="color: darkred">
    <?php
      if (isset($_GET['message'])) {
      echo $_GET['message'];
      }
    ?>
  </h6>

<!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
  <script src=“https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js”></script>

</body>
</html>
