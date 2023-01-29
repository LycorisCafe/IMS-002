<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://preview.colorlib.com/theme/bootstrap/website-menu-03/fonts/icomoon/style.css">
  <link rel="stylesheet" href="https://preview.colorlib.com/theme/bootstrap/website-menu-03/css/owl.carousel.min.css">

  <link rel="stylesheet" href="https://preview.colorlib.com/theme/bootstrap/website-menu-03/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://preview.colorlib.com/theme/bootstrap/website-menu-03/css/style.css">
  <title>Lycoris Cafe</title>
  <script nonce="37d26168-d0dd-4088-b7fc-821540922fa2">
    (function(w, d) {
      ! function(f, g, h, i) {
        f[h] = f[h] || {};
        f[h].executed = [];
        f.zaraz = {
          deferred: [],
          listeners: []
        };
        f.zaraz.q = [];
        f.zaraz._f = function(j) {
          return function() {
            var k = Array.prototype.slice.call(arguments);
            f.zaraz.q.push({
              m: j,
              a: k
            })
          }
        };
        for (const l of ["track", "set", "debug"]) f.zaraz[l] = f.zaraz._f(l);
        f.zaraz.init = () => {
          var m = g.getElementsByTagName(i)[0],
            n = g.createElement(i),
            o = g.getElementsByTagName("title")[0];
          o && (f[h].t = g.getElementsByTagName("title")[0].text);
          f[h].x = Math.random();
          f[h].w = f.screen.width;
          f[h].h = f.screen.height;
          f[h].j = f.innerHeight;
          f[h].e = f.innerWidth;
          f[h].l = f.location.href;
          f[h].r = g.referrer;
          f[h].k = f.screen.colorDepth;
          f[h].n = g.characterSet;
          f[h].o = (new Date).getTimezoneOffset();
          if (f.dataLayer)
            for (const s of Object.entries(Object.entries(dataLayer).reduce(((t, u) => ({
                ...t[1],
                ...u[1]
              }))))) zaraz.set(s[0], s[1], {
              scope: "page"
            });
          f[h].q = [];
          for (; f.zaraz.q.length;) {
            const v = f.zaraz.q.shift();
            f[h].q.push(v)
          }
          n.defer = !0;
          for (const w of [localStorage, sessionStorage]) Object.keys(w || {}).filter((y => y.startsWith("_zaraz_"))).forEach((x => {
            try {
              f[h]["z_" + x.slice(7)] = JSON.parse(w.getItem(x))
            } catch {
              f[h]["z_" + x.slice(7)] = w.getItem(x)
            }
          }));
          n.referrerPolicy = "origin";
          n.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(f[h])));
          m.parentNode.insertBefore(n, m)
        };
        ["complete", "interactive"].includes(g.readyState) ? zaraz.init() : f.addEventListener("DOMContentLoaded", zaraz.init)
      }(w, d, "zarazData", "script");
    })(window, document);
  </script>
</head>

<body>
  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="js-menu-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
          </svg>
        </span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>
  <header class="site-navbar" role="banner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-11 col-xl-2">
          <h1 class="mb-0 site-logo"><a href="index.php" class="text-white mb-0">Lycoris Cafe</a></h1>
        </div>
        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
              <li class="active"><a href="index.php"><span>Home</span></a></li>
              <li><a href="aboutUs.php"><span>About</span></a></li>
              <li><a href="login.php"><span>Login</span></a></li>
            </ul>
          </nav>
        </div>
        <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg></a>
        </div>
      </div>
    </div>
    </div>
  </header>
  <div class="hero text-center" style="background-image: url('Media/images/bg3.png');">
    <br><br><br><br><br><br><br><br><br><br><br>
    <h1>Welcome!</h1>
  </div>
  <?php include 'req/footer.php'; ?>
  <script src="https://preview.colorlib.com/theme/bootstrap/website-menu-03/js/jquery-3.3.1.min.js"></script>
  <script src="https://preview.colorlib.com/theme/bootstrap/website-menu-03/js/popper.min.js"></script>
  <script src="https://preview.colorlib.com/theme/bootstrap/website-menu-03/js/bootstrap.min.js"></script>
  <script src="https://preview.colorlib.com/theme/bootstrap/website-menu-03/js/jquery.sticky.js"></script>
  <script src="https://preview.colorlib.com/theme/bootstrap/website-menu-03/js/main.js"></script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"790351ce2864a138","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.11.3","si":100}' crossorigin="anonymous"></script>
</body>

</html>