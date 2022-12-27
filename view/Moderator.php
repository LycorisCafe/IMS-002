<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moderator</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://sftthaksalawa.com" style="font-weight: 900;"><span style="color: rgb(0, 191, 161);">SFT</span> තක්සලාව</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                        <b style='color: white;'>User: <?php echo $_SESSION['fname']; ?></b>
                  </li>
                  <li class="nav-item">
                        <b style='color: white;'>Role: <?php echo $_SESSION['role']; ?></b>
                  </li>
                </ul>
                <a href='../req/logout.php' class='btn btn-danger'> Logout </a>
              </div>
            </div>
          </nav>
        <br><br>
        <div class="text-center">
            <h1 class="display-6">SFT තක්සලාව</h1>
            <h6>Moderator Panel</h6>
        </div>

        <br><br>
        <div class="container col-lg-6">
            <form>
                <div class="card text-center">
                    <div class="card-header">
                        <h4>Attendane Marking</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter Student ID!" aria-label="studentId" aria-describedby="basic-addon1">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button">Search</button>
                        </div>
                        <hr>
                        <div>
                            <img src="../Media/dummy.jpg" class="rounded border border-success" height="150" width="150" alt="studentImage">
                        </div>
                        <br>
                        <div class="rounded border border-success">
                            <p><i>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam interdum augue turpis,
                                    ut porta sapien fringilla non. Sed at arcu dapibus, egestas nisi nec, laoreet arcu.
                                    Maecenas sed tincidunt mauris. Praesent rhoncus posuere magna, nec molestie nisl dapibus
                                    ac. Curabitur sagittis commodo ligula et auctor. Maecenas sit amet eros vel nulla elementum
                                    placerat ut sit amet nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                                    per inceptos himenaeos. Aenean sed auctor orci. Nam ut est gravida, pulvinar ligula
                                    congue, suscipit sapien. In hac habitasse platea dictumst. Nunc dictum consectetur felis
                                    ut convallis.
                                </i></p>
                        </div>
                        <hr>
                        <div class="form-check text-start">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Day2Day Paper
                            </label>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button">Mark as Attend!</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br><br>
        <br><br>

        <script src="../bootstrap/js/bootstrap.bundle.min.js></script">
  </body>
</html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>