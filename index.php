<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload and Use Pictures front the server as background animation with jQuery/AJAX and PHP</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#"><b>Paulos Ab</b><i>Prototype</i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Page</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Explore</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  
  <main role="main" class="container">
  
    <div class="starter-template">
      <h1>Upload and Use Pictures from the server as background animation with jQuery/AJAX and PHP</h1>
      <hr class="border-danger">
      <h1>Bootstrap starter template</h1>
      <p class="lead">Use this document as a way to quickly start any new project.<br> 
        All you get is this text and a mostly barebones HTML document.</p>

        <form class="upload_form">
          <div class="col-lg-6">
            <img src="images/blank.jpg" alt="img preview" class="col-lg-12 img-prev">
          </div>
          <div class="form-group">
            <label for="pic">Upload a Picture to Use as Animation</label>
            <input type="file" name="picture" onchange="picture_prev(this)" id="pic" class="form-control upload-input">
          </div>
          <input type="hidden" name="submit_pic">
          <button class="btn btn-primary btn-md upload_btn" type="button">Upload Picture</button>
          <input type="reset" class="reset_form" style="display: none;">
        </form>

        <div class="row">
            <?php $connection = mysqli_connect("localhost","root","","prototype");
            $fetch_sql = "SELECT * FROM bgAnimatnPics ORDER BY id DESC LIMIT 8";
            $query = mysqli_query($connection, $fetch_sql);
            while ($pictures  = mysqli_fetch_assoc($query)) { ?>
                <div class="col-lg-3">
                    <img src="uploads/<?php echo $pictures["picture_name"] ?>" alt="" class="col-lg-12">
                </div>
            <?php } ?>
        </div>
    </div>
  
  </main><!-- /.container -->

  <div class="footer bg-dark p-4 container-fluid">
    <div class="row">
      <div class="col-lg-12 text-center text-white">
        Paulos Ab - Upload and Use Pictures front the server as background animation with jQuery/AJAX and PHP
      </div>
    </div>
  </div>

  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="db_request.js"></script>
</body>
</html>

