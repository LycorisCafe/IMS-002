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

        <div class="d-grid gap-2 col-3 mx-auto">
            <button class="btn btn-primary" type="button">Logout</button>
        </div>
        <br><br>

        <script src="../bootstrap/js/bootstrap.bundle.min.js></script>
  </body>
</html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>