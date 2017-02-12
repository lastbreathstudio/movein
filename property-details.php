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


      $propID = $_GET['propertyID'];

      $url_det = "http://daisylets.domus.net/site/go/api/property?propertyID=$propID";

        $response_xml_data_det = file_get_contents($url_det);
          if($response_xml_data_det){
           $data_det = simplexml_load_string($response_xml_data_det);

       }
       $pr = (int)$data_det->price;
       // $array =  (array) $data_det->features->feature;
       // foreach ($array as $value){ 

       // }    
?>
<div class="slider">
<div class="row">

<div class="large-12 column">
        <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
        <ul class="orbit-container">
          <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
          <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
          <?php 
            foreach ($data_det->photos->photo as $photo){ 
          ?>
          <li class="orbit-slide" style="background-image:url(<?php echo $photo->url; ?>);background-size:cover;background-position:50%;"></li>

          <?php 
            }
          ?>
        
        </ul>
        
        </div>
</div>

</div>
</div>

  <div class="prop-details">
    <div class="row">
      <div class="large-8 column">
      <h1><?php echo $data_det->address->street; ?>, <?php echo substr($data_det->address->postcode, 0, -3); ?>  - £<?php echo number_format($pr , 0 , '.' , ','); ?></h1>
      <h2><?php echo $data_det->bedrooms; ?> Bedroom(s), <?php echo $data_det->type; ?></h2>
       <p class=""><?php echo $data_det->description; ?></p>
      </div>
      <div class="large-4 column">
                <h2 class="">Property Features</h2>
          <ul>
            <?php
              foreach ($data_det->features->feature as $value){      
            ?>
            <li><?php echo $value; ?></li>
  
            <?php
              }
            ?>
            
          </ul>
      </div>
    </div>
  </div>

  <div class="row  hide-for-small-only">
      <div class="">
        <h2>image gallery</h2>
      
      
        <div class="medium-8 column">
          <div class="column">
              <img src="<?php echo $data_det->photos->photo[0]->url; ?>" class="thumbnail" id="big" alt="">
            </div>
        </div>
            <div class="medium-4 column gallery">
              <div class="row small-up-1 medium-up-3 large-up-3">
                <?php 
                  foreach ($data_det->photos->photo as $photo){ 
                ?>
                <div class="column">
                    <img src="<?php echo $photo->url; ?>" class="thumbnail" alt="">
                  </div>
              
                <?php 
                }
                ?>
              </div>
            </div>

      </div>
    </div>

  <ul class="tabs" data-tabs id="example-tabsdet" >
         <li class="tabs-title is-active" id="tab1" ><a href="#panel1d" aria-selected="true">Map</a></li>
         <li class="tabs-title" id="tab2"><a href="#panel2d" >Floor Plans</a></li>
         <li class="tabs-title" id="tab3"><a href="#panel3d" >EPC</a></li>
      </ul>




    <div class="tabs-content" data-tabs-content="example-tabsdet">

        <div class="tabs-panel is-active" id="panel1d">

        <?php $adr = $data_det->address->advertising ; ?>
        <iframe
          width="100%"
          height="450"
          frameborder="0" style="border:0"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCUcnUiob32AQIjDosN5alwpq44aIUU9IQ
            &q=<?php echo $adr ;?>" allowfullscreen>
        </iframe>
          
        </div>
      
      <div class="tabs-panel" id="panel2d">
         
        <img src="<?php echo $data_det->floorplans->floorplan->url; ?>" alt="">
          


       </div>

        <div class="tabs-panel" id="panel3d">
         
          <img src="<?php echo $data_det->epcgraph; ?>" alt="">
          


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
