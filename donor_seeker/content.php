<?php
  //include("connection.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="frontpage.css">
    <title></title>
	<style>
		.navbar-light{
			  font-size: 20px;
			  font-weight: bold;
			  letter-spacing: .3px;
			}

	</style>
  </head>
  <body>
  	<!-- image part -->
    <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
         <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
         <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
         <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
         <div class="carousel-item active">
          <img src="https://scx1.b-cdn.net/csz/news/800/2019/4-blood.jpg" class="d-block w-100 img-fluid" alt="First Slide">
         </div>
         <div class="carousel-item">
          <img src="https://www.inquirer.com/resizer/w_51vbaeDuaZ3CTKLejgKYYhXlU=/1400x932/smart/arc-anglerfish-arc2-prod-pmn.s3.amazonaws.com/public/IVQKYTI7QVB7FGCS3QHSQGKLOY.jpg" class="d-block w-100 img-fluid" alt="Second Slide">
         </div>
         <div class="carousel-item">
          <img src="https://assets.newatlas.com/dims4/default/eaafe5c/2147483647/strip/true/crop/2000x1283+0+0/resize/1200x770!/quality/90/?url=http%3A%2F%2Fnewatlas-brightspot.s3.amazonaws.com%2F04%2F26%2F3ad0961041dcb660a92da268ea36%2Fdepositphotos-150904088-l-2015.jpg" class="d-block w-100 img-fluid" alt="Third Slide">
         </div>
         </div>
         <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
         </a>
   </div>
   </div>
  </body>
 </html>