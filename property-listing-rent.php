<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundation for Sites</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  </head>
  <body>
  <header>
    <div class="row">
        <div class="medium-4 column"><img src="img/logo.png" alt=""></div>
            <div class="medium-8 column ">
              <ul class="menu nav">
              <li>
                <a href="#">Home</a>
              </li>
              <li><a href="#">For Sale</a></li>
              <li><a href="#">For Rent</a></li>
               <li><a href="#">Landlords</a></li>
              <li><a href="#">Careers</a></li>
               <li><a href="#">Blog</a></li>
              <li><a href="#">IContact Us</a></li>
              </ul>
            </div>
    </div>
  </header>
<?php


$url = "http://daisylets.domus.net/site/go/api/search??sales=false";

$str = '';


 if( !empty($_POST['bedrooms']))
 {
   $bedrooms = $_POST['bedrooms'];
     $str .= '&beds=' . $bedrooms;
 }

  if( !empty($_GET['bedrooms']))
 {
   $bedrooms = $_GET['bedrooms'];
     $str .= '&beds=' . $bedrooms;
 }


if( !empty($_POST['postcode']))
 {
     $postcode = $_POST['postcode'];
      $str .= '&location=' . $postcode;
 }

 if( !empty($_GET['location']))
 {
     $postcode = $_GET['location'];
      $str .= '&location=' . $postcode;
 }




if( !empty($_POST['minprice']))
 {
     $minprice = $_POST['minprice'];
      $str .= '&min=' . $minprice;
 }

 if( !empty($_POST['maxprice']))
 {
     $maxprice = $_POST['maxprice'];
      $str .= '&max=' . $maxprice;
 }







//  if( !empty($_POST['beds']))
//  {
//    $beds = $_POST['beds'];
//    $str .= 'beds=' . $beds;
//  }



// if( !empty($_POST['postcode']))
//  {
//     $postcode = $_POST['postcode'];
//     $str .= '&location=' . $postcode;
//  }



if( !empty($_POST['sales']))
{
  $sales = $_POST['sales'];
  $str .= '&sales=' . $sales;
}



// if( !empty($_POST['min']))
//  {
//      $minprice = $_POST['min'];
//      $str .= '&min=' . $minprice;
//  }

//  if( !empty($_POST['max']))
//  {
//      $maxprice = $_POST['max'];
//       $str .= '&max=' . $maxprice;
//  }

//   if( !empty($_POST['up']))
//  {

//   $up = $_POST['up'];
//    $str .= '&up=' . $up;
  
//  }

//  if( !empty($_GET['up']))
//  {
//      $up = $_GET['up'];
//       $str .= '&up=' . $up;
//  }

$url .= $str;

$response_xml_data = file_get_contents($url);
$data = simplexml_load_string($response_xml_data);
$arr = $data->property;
$arr2 = array();
foreach ($arr as $obj) {
  $arr2[] = $obj;
}

$total = $data->totalItems;
$page = (int)$data->page;
$shownext = $data->showNext;
$nextpage = $data->nextPage;
$previouspage = $data->previousPage;
?>

<div class="pagi">
  <div class="row">
          <div class="medium-4 small-12 column">
    <div class="res-oi">
    <?php

      if($total > 0){

    ?>

    <ul class="pagination" role="navigation" aria-label="Pagination">
    
    <?php

    if($page == 1){
              
    ?>

    <li class="pagination-previous disabled">Previous</li>
          
          <?php

          }else{
            
        ?>  
          <li class="pagination-previous"><a href="property-listing.php?page=<?php echo $previouspage ?>&<?php echo $data->searchString?>">Prev </a></li>
          <li class=""><a href="property-listing.php?page=<?php echo $previouspage ?>&<?php echo $data->searchString?>"><?php echo $previouspage ?></a></li>
          
        <?php

          }

        ?>  
        <li class="current"><a href="property-listing.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
      
      <?php if($shownext == 'true'){

      ?>  

      <li><a href="property-listing.php?page=<?php echo $nextpage ?>&<?php echo $data->searchString?>"><?php echo $nextpage ?></a></li>

    <?php

      }

    ?>



      <?php
        
        }

       ?>
      </ul>
      </div>
    </div>
  </div>
</div>

<?php

      if($total > 0){
      foreach ($arr2 as $prop){ 
      $pr = (int)$prop->price;
      ?>
    
<div class="" >

<div class="props-list" >
  <div class="row" >
    <div class="large-8 column" >
      <h1><?php echo $prop->address->street; ?>, <?php echo substr($prop->address->postcode, 0, -3); ?> - £<?php echo number_format($pr , 0 , '.' , ','); ?></h1>
      <p><?php echo $prop->description ?></p>
    </div>
    <div class="large-4 column">
      <img src="http://daisylets.domus.net/photos/<?php echo $prop->photoID; ?>.jpg" alt="" >
       <p class="alert hollow button"><a href="property-details.php?propertyID=<?php echo $prop->id; ?>">DETAILS</a></p><br>
       <p class="alert hollow button" data-open="view">ARRANGE VIEWING</p>
             <div class="reveal" id="view" data-reveal>
<form method="post" action="submit-viewing.php" data-abide novalidate class="view-form">
        <p>Request A Viewing</p>
        <p>Please fill the form below</p>
        <span class="val-close-view">&#10006;</span>
              <div data-abide-error class="alert callout" style="display: none;">
                <p><i class="fi-alert"></i> There are some errors in your form.</p>
              </div>
            <div class="">
                  <div class="small-12 columns">
                    <label>Your Name 
                      <input name="name" type="text" placeholder="Please Enter Your Name" aria-describedby="exampleHelpText" required>
                        <span class="form-error">
                       Please Enter Your Name
                    </span>
                    </label>
                  </div>
                      
                      <div class="small-12 columns">
                            <label>Your Phone Number 
                              <input name="phone" type="text" placeholder="Please Enter Your Phone Number" aria-describedby="exampleHelpText" required >
                              <span class="form-error">
                                Please Enter A Valid Phone Number
                              </span>
                            </label>
                            
                       </div>
                    
                    <div class="small-12 columns">
                        <label>Your Email Address 
                              <input type="email" name="email" placeholder="Please Enter Your Email Address" required>
                              <span class="form-error">
                                Your Email Address Is Invalid
                              </span>
                        </label>
                    </div>
          
                     <div class="small-12 columns">
                                  <label>Property of interest
                                    <textarea name="prop" type="text" rows="1" cols="50" aria-describedby="exampleHelpText" ><?php echo $prop->address->advertising; ?>></textarea>
                                  </label>
                      </div>

                      <div class="small-12 columns">
                        <label>
                          <textarea name="message" type="text" rows="2" cols="50"  aria-describedby="exampleHelpText" >Please Enter Your Message</textarea>
                          <span class="form-error">
                                Please Enter Your Message
                         </span>
                        </label>
                      </div>   
              
            </div>

                <button class="button vie-butt" type="submit" value="Submit">ARRANGE A VIEWING</button>
          </form>
        <button class="close-button" data-close aria-label="Close modal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>
</div> 
<?php 
  }
}else{

?>
    <h1>No Results Found</h1>
<?php
}
?>


    <div class="medium-4 small-12 column">
    <div class="res-oi">
    <?php

      if($total > 0){

    ?>

    <ul class="pagination" role="navigation" aria-label="Pagination">
    
    <?php

    if($page == 1){
              
    ?>

    <li class="pagination-previous disabled">Previous</li>
          
          <?php

          }else{
            
        ?>  
          <li class="pagination-previous"><a href="property-listing.php?page=<?php echo $previouspage ?>&<?php echo $data->searchString?>">Prev </a></li>
          <li class=""><a href="property-listing.php?page=<?php echo $previouspage ?>&<?php echo $data->searchString?>"><?php echo $previouspage ?></a></li>
          
        <?php

          }

        ?>  
        <li class="current"><a href="property-listing.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
      
      <?php if($shownext == 'true'){

      ?>  

      <li><a href="property-listing.php?page=<?php echo $nextpage ?>&<?php echo $data->searchString?>"><?php echo $nextpage ?></a></li>

    <?php

      }

    ?>



      <?php
        
        }

       ?>
      </ul>
      </div>
    </div>





    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/foundation-sites/dist/js/foundation.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="js/app.js"></script>
    <script>
          var gallery = $(".gallery .thumbnail");
            $.each(gallery, function() {
                $(this).click(function() {
                    var a = $(this).attr("src");
                    console.log(a), $("#big").attr("src", a)
                })
            });
    </script>
   
  </body>
</html>
