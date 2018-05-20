<?php
   require_once('../classes/farm.class.php');
	$response = array();
	$farm = new Farm();
   if(isset($_POST['search_query'])){
      $search_query = trim(strip_tags($_POST['search_query']));
    
      if($search_query != ''){
         if ($farm->farms_search($search_query) != 0){
            $farmers_search_results ="";
            foreach($farm->farms_search($search_query) as $farmFetched){
				$id = $farmFetched['id'];
				$farm_name = $farmFetched['farm_name'];
				$crop = $farmFetched['crop'];
				$location = $farmFetched['region']." / ".$farmFetched['town'];
											
				
				$farmers_search_results .= "
					<li id='search_list'><a href='editfarm&id=$id'>$farm_name</a> <i class='fa fa-angle-right'></i> $crop ($location)</li>
				";
			}
            $response['results_found'] =$farmers_search_results;
         }else
            $response['results'] = "No search results found for '$search_query'";
      }
   }
   echo json_encode($response);
?>