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

 <div class="banner">

   
<div class="row">
      <div class="medium-4 column"><img src="img/logo.png" alt=""></div>
    </div>
    <div class="row nav-outer">
    <div class="medium-8 column ">
      <ul class="menu nav">
      <li>
        <a href="index.php">Home</a>
      </li>
      <li><a href="property-listing.php">For Sale</a></li>
      <li><a href="property-listing.php?sales=false">For Rent</a></li>
      <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="medium-2 column"></div>
    </div>

    <div class="middle-outer">
    <div class="row middle">
      <div class="medium-6 column search">
      <h2>Search properties</h2>
<form class="search-form" method="post" action="property-listing.php" class=>
  <div class="">
    <div class="medium-6 columns">
      <label>Location
        <input type="text" name="postcode" placeholder="Enter Location" maxlength="4">
      </label>
    </div>
    <div class="medium-6 columns">
     <label>Bedrooms
  <select name="bedrooms">
    <option value="1">1+</option>
    <option value="2">2+</option>
    <option value="3">3+</option>
    <option value="4">4+</option>
  </select>
</label>
    </div>


    <div class="medium-6 column">
        
                  <label>Min price
                    
                  <input type="text" name="minprice" placeholder="Minimum Price">
                      
                        
                    </label>
                
    </div>

        <div class="medium-6 column">
        
                  <label>Max price
                    
                     

                   <input type="text" name="maxprice" placeholder="Maximum Price">

                      
                        
                    </label>
                
    </div>


 

      <div class="medium-6 column">
     
      </div>

     


     
      <div class="medium-6 column"> <input type="submit" class="submit-button button rent" value="TO RENT"> <input type="submit" class="submit-button button buy" value="TO BUY"></div>
  </div>
</form>
      </div>
    </div>
    </div>

 </div>
    

    <div class="row" data-equalizer>
    <h1>Newest Properties</h1>
    <?php 
    $url = "http://daisylets.domus.net/site/go/api/search?items=6";
    $response_xml_data = file_get_contents($url);
    $data = simplexml_load_string($response_xml_data);
    $arr = $data->property;
    $arr2 = array();
    foreach ($arr as $obj) {
        $arr2[] = $obj;
    }

  foreach ($arr2 as $prop){ 
        
       
        $pr = (int)$prop->price;
        $url_det = "http://daisylets.domus.net/site/go/api/property?propertyID=$prop->id";
        $response_xml_data_det = file_get_contents($url_det);
          if($response_xml_data_det){
           $data_det = simplexml_load_string($response_xml_data_det);

       }
        if($prop->status != 'Withdrawn'){
        
    ?>
      <div class="medium-4 column prop" data-equalizer-watch>
      <p class="alert alert button"><?php echo $prop->status ?></p>
      <img src="http://daisylets.domus.net/photos/<?php echo $prop->photoID; ?>.jpg" alt="" >
      <p class="address" ><?php echo $prop->address->advertising; ?></p>
      <p class="alert hollow button">£<?php echo number_format($pr , 0 , '.' , ','); ?></p><br>
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
    <?php
        }
    }
    ?>
    </div>

    <div class="copy">
      Copyright <?php echo date('Y') ?> MoveIn Property Services Limited. All Rights Reserved
    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/foundation-sites/dist/js/foundation.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="js/app.js"></script>
    <script>
      $(document).ready(function() {
        $('.buy').on('click', function(){
            $('.search-form').attr('action', 'property-listing.php')
        });
         $('.rent').on('click', function(){
            $('.search-form').attr('action', 'property-listing.php?sales=false')
        })

      });
    </script>
  </body>
</html>
