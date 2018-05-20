<?php
   require_once('../classes/user.class.php');
   require_once('../classes/farm.class.php');
   require_once('../classes/user_farm.class.php');
	$response = array();
	$user = new User();
	$farm = new Farm();
	$user_farm = new User_Farm();
   if(isset($_POST['search_query'])){
      $search_query = trim(strip_tags($_POST['search_query']));
    
      if($search_query != ''){
         if ($user->farmers_search($search_query) != 0){
            $farmers_search_results ="";
            foreach($user->farmers_search($search_query) as $userFetched){
				$id = $userFetched['id'];
				$uid = $userFetched['uid'];
				$first_name = $userFetched['firstname'];
				$last_name = $userFetched['lastname'];
				$other_names = $userFetched['othernames'];
				$location = $userFetched['region']." / ".$userFetched['town'];
											
				foreach($user_farm->getUserFarmsId($uid) as $user_farm_details){
					$farm_id = $user_farm_details['farm_id'];
					foreach($farm->getUserFarms($farm_id) as $farmFetched){
						$farm_name = $farmFetched['farm_name'];
						$farm_location  = $farmFetched['region']." / ".$farmFetched['town'];
					}
				}
											
				if(empty($other_names))
					$name = $first_name." ".$last_name;
				else
					$name = $first_name." ".$other_names.". ".$last_name;
				
				$farmers_search_results .= "
					<li id='search_list'><a href='edituser&id=$id'>$name</a> <i class='fa fa-angle-right'></i> $farm_name ($farm_location)</li>
				";
			}
            $response['results_found'] =$farmers_search_results;
         }else
            $response['results'] = "No search results found for '$search_query'";
      }
   }
   echo json_encode($response);
?>