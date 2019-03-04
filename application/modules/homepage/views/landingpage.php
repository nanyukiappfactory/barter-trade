<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Signika" rel="stylesheet">
  <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery-3.3.1.slim.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-top:10px;">
    <a class="navbar-brand" href="#">
      <img src="<?php echo base_url();?>assets/images/icons8-bebo-filled-480.png" width="50" height="50" class="d-inline-block align-top" alt="">
      <span style="font-family: 'Signika', sans-serif;font-size:35px;">arter tade</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact us</a>
        </li>
      </ul>
    </div>
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </nav>
  <div class="d-flex justify-content-center justify-content-sm-around border-bottom" style="margin-top:2.5%;">
    <div class="p-2 bd-highlight"><h4>So secure</h4></div>
    <div class="p-2 bd-highlight border-left"></div>
    <div class="p-2 bd-highlight"><h4>Convenient</h4></div>
    <div class="p-2 bd-highlight border-right"></div>
    <div class="p-2 bd-highlight"><h4> Fast Exchange</h4></div>
  </div>

    <!-- image goes here -->
  <div class="container">
    <div class="bd-example">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?php echo base_url();?>assets/images/barterimage1.jpeg" class="d-block w-100 h-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>What is barter trade?</h5>
              <p>Exchange goods for goods</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?php echo base_url();?>assets/images/barterimage4.jpg" class="d-block w-100 h-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Want to sell an item?</h5>
              <p>Sign up and join us to sell your properties at the comfort of your house</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?php echo base_url();?>assets/images/barterimage2.jpeg" class="d-block w-100 h-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <br><br>

  <!-- start of latest offers -->
  <div class="container" style="margin-bottom:2.5%;">
  <div class="d-flex align-items-start border-right border-left"><h1>Latest offers</h1></div>
    <div class="bd-example">
      <div id="carouselExampleCaptions2" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators" style="background-color:#56D2AC;"> <br>
          <li data-target="#carouselExampleCaptions2" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions2" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <!-- start of first carousel item -->
            <div class="d-flex flex-wrap justify-content-center">
              <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url();?>assets/images/product1.jpg" class="card-img-top" alt="..." style="height:200px;width:100%;">
                <div class="card-body">
                  <p class="card-text" style="text-align:center;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p style="color:black;text-align:center;font-weight:bold;">Ksh.234</p>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url();?>assets/images/product1.jpg" class="card-img-top" alt="..." style="height:200px;width:100%;">
                <div class="card-body">
                  <p class="card-text" style="text-align:center;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p style="color:black;text-align:center;font-weight:bold;">Ksh.234</p>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url();?>assets/images/product1.jpg" class="card-img-top" alt="..." style="height:200px;width:100%;">
                <div class="card-body">
                  <p class="card-text" style="text-align:center;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p style="color:black;text-align:center;font-weight:bold;">Ksh.234</p>
                </div>
              </div>
            </div>
            <!-- end of carousel item -->
          </div>
          
          <div class="carousel-item" >
            <!-- start of second item -->
            <div class="d-flex flex-wrap justify-content-center">
              <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url();?>assets/images/product2.jpg" class="card-img-top" alt="..." style="height:200px;width:100%;">
                <div class="card-body">
                  <p class="card-text" style="text-align:center;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p style="color:black;text-align:center;font-weight:bold;">Ksh.234</p>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url();?>assets/images/product3.jpg" class="card-img-top" alt="..." style="height:200px;width:100%;">
                <div class="card-body">
                  <p class="card-text" style="text-align:center;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p style="color:black;text-align:center;font-weight:bold;">Ksh.234</p>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url();?>assets/images/product3.jpg" class="card-img-top" alt="..." style="height:200px;width:100%;">
                <div class="card-body">
                  <p class="card-text" style="text-align:center;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p style="color:black;text-align:center;font-weight:bold;">Ksh.234</p>
                </div>
              </div>
            </div>
            <!-- end of second item -->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- end of latest offers -->

  <!-- start of major categories -->
    <div class="container" style="background-color:#f2f2f2">
      <div class="d-flex justify-content-center border-left"><h1>Major categories</h1></div>
    </div>
  <!-- end of major categories -->
</body>
</html>