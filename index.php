<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Lycoris Cafe</title>
  <link rel="stylesheet" href="css/fonts.css" />
  <link rel="icon" type="image/x-icon" href="Media/favicon.png" />
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/temp.css" />
  <link rel="manifest" href="manifest.json" />
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .img-home {
      background-image: url('Media/images/bg3.png');
      height: 100vh;
      width: 100%;
      background-size: cover;
      background-position: cover;
    }

    .cnt {
      transform: translate(0%, 300%);
    }

    @media(max-height: 800px) {
      .cnt {
        transform: translate(0%, 200%);
      }
    }

    @media(max-height: 700px) {
      .cnt {
        transform: translate(0%, 180%);
      }
    }

    @media(max-height: 530px) {
      .cnt {
        transform: translate(0%, 150%);
      }
    }
  </style>
  <script src="fontawesome.com.js" crossorigin="anonymous"></script>
</head>

<body>


  <!-- <section class="section main-banner" id="top">
    <video autoplay muted loop id="bg-video">
      <source src="/Media/images/bg2_1.jpg" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
      <div class="caption">
        <h6>Test Sub Text</h6>
        <h2><em>Lycoris </em>Cafe</h2>
        <div class="main-button">
          <a class="scroll-to-section" href="login.php">Login</a>
        </div>
      </div>
    </div>
  </section> -->
  <div class="img-home">
    <header class="main-header clearfix" role="header">
      <div class="logo">
        <a href="index.php"><em>Lycoris</em> Cafe</a>
      </div>
      <a href="" class="menu-link"><i class="fa fa-bars"></i></a>
      <nav id="menu" class="main-nav" role="navigation">
        <ul class="main-menu">
          <li><a href="index.php">Home</a></li>

          <li><a href="aboutUs.php">About Us</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>
    </header>

    <div class="container cnt">
      <h1 class="display-2 text-center" style="color: #000; font-weight: 700;">Welcome to Lycoris Cafe</h1>
      <div class="text-center d-grid gap-2 col-6 mx-auto"><br/><br/>
        <a class="btn btn-success btn-lg" href="login.php">Login</a>
      </div>
    </div>

  </div>



  <script src="js/isotope.min.js"></script>
  <script src="js/sftthaksalawacustom.js"></script>

  <div class="text-center mt-auto py-3 bg-dark">
    <br />
    <h5 style="color: #fff">
      &copy; COPYRIGHT LYCORIS CAFE | DESIGN BY LYCORIS CAFE
    </h5>
    <br />
  </div>
</body>

</html>