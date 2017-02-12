<div class="pagi">
  <div class="row">
          <div class="medium-4 small-12 column">
    <div class="res-oi">
    <?php

      if($total > 0){

    ?>

    <ul class="pagination" role="navigation" aria-label="Pagination">
     <li>Total items: <?php echo $data->totalItems; ?></li>
    <?php

    if($page == 1){
              
    ?>
   
    <li class="pagination-previous disabled">Previous</li>
          
          <?php

          }else{
            
        ?>  
          <li class="pagination-previous"><a href="property-listing.php?page=<?php echo $previouspage ?>&<?php echo $data->searchString?>">Previous </a>
          </li>
          <li class=""><a href="property-listing.php?page=<?php echo $previouspage ?>&<?php echo $data->searchString?>"><?php echo $previouspage ?></a></li>
          
        <?php

          }

        ?>  
        <li class="current"><a href="property-listing.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
      
      <?php if($shownext == 'true'){

      ?>  
     
      <li><a href="property-listing.php?page=<?php echo $nextpage ?>&<?php echo $data->searchString?>"><?php echo $nextpage ?></a></li>
       <li class="pagination-next"><a href="property-listing.php?page=<?php echo $nextpage ?>&<?php echo $data->searchString?>">Next</a>
      </li>
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