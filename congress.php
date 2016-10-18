<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$apiKey ="9d713eee2bda4febb053035ef76e5f4c";
?>

<html>
	
	<head>
		<meta charset="utf-8"/>
	</head>
	
	<!--     API Key: 9d713eee2bda4febb053035ef76e5f4c 

	-->
		<script>
		function selectChange() {
			var keySelect = document.getElementById("keyword-title");
			var opt = document.getElementById("con-select").value;
			console.log(opt);
			var keyTitle = document.getElementById("secret").value;
			switch(opt) {
			    case "Legislators":
					keySelect.innerHTML = "State/Representative*";
			        break;
			    case "Committees":
					keySelect.innerHTML = "Committee ID*";
			        break;
			    case "Bills":
					keySelect.innerHTML = "Bill ID*";
			        break;
			    case "Amendments":
					keySelect.innerHTML = "Amendments ID*";
			        break;   
			}
			document.getElementById("secret").value = keySelect.innerHTML;
			
		}
		function clearClicked() {
			
			var keySelect = document.getElementById("keyword-title");
			var keyInput = document.getElementById("keyword-input");
			var infoTable = document.getElementById("infoTable");
			var detailTable = document.getElementById("details-show");
			var select = document.getElementById("con-select");
			select.value="default";
			if(infoTable) {
				infoTable.innerHTML = "";

			}
			if(detailTable) {
			detailTable.innerHTML = "";
			}
			keySelect.innerHTML = "Keyword*";
			keyInput.value = "";

/*
			document.getElementById("senateRadio").checked = "true";
			document.getElementById("houseRadio").checked = "false";
*/
			var ele = document.getElementById("myForm");
		    tags = ele.getElementsByTagName('input');
		    for(i = 0; i < tags.length; i++) {
		        switch(tags[i].type) {
		            case 'password':
		            case 'text':
		                tags[i].value = '';
		                break;
		            case 'checkbox':
		            case 'radio':
		                tags[i].checked = false;
		                break;
		        }
		    }
		    			document.getElementById("senateRadio").checked = "true";
		}
		
		function searchClicked() {
			var table = document.getElementById("infoTable");
			var opt = document.getElementById("con-select");

			var keyInput = document.getElementById("keyword-input").value;
			
// 			table.innerHTML = "";
			if(opt.value=="default" || !keyInput) {
				var text = "Please enter the following missing information: ";
				if(opt.value=="default" ) {
					text+= "Congress database";
				}
				if(opt.value=="default" && !keyInput) {
					text+=", ";
				}
				if(!keyInput) {
					text+="keyword";
				}
				alert(text);
			}
			
		}
	</script>
	<body>
		<div id="fcontainer" style="margin: 0px auto; width: 500px; text-align: center">
			<h2>Congresss Information Search</h2>
			<div id="form-block">
				<form id="myForm" action="" method="post">
					<div id="congress-selection">
						<div style="display: inline-block;" id="congress-title">Congress Database</div>
						<select id="con-select" style="" name="selectOption" onchange="selectChange()">
							<option value="default" selected=selected disabled>Select your option</option>
							<option value="Legislators">Legislators</option>
							<option value="Committees">Committees</option>
							<option value="Bills">Bills</option>
							<option value="Amendments">Amendments</option>
						</select>
					</div>
					<div id="chamber-selection">
						<div style="display: inline-block;" id="chamber-title">Chamber</div>
						<div id="sen_house-radios" style="display: inline-block">
							<input type="radio" id="senateRadio" name="Senate_House" value = "Senate" <?php if(isset($_POST['Senate_House'])&&$_POST['Senate_House']=="Senate") echo "checked='checked'"; if (!isset($_POST['Senate_House'])) echo "checked='checked'"?> > Senate
							<input type="radio" id="houseRadio" name="Senate_House" value = "House" <?php if(isset($_POST['Senate_House'])&&$_POST['Senate_House']=="House") echo "checked='checked'"; ?>  >House <br>
						</div>
					</div>
					<div id="keyword-selection">
						<input style="display: none"  id="secret" name="keyword-title" value="">
						<div style="display: inline-block;"  id="keyword-title">Keyword*</div>
						<input type="text" id="keyword-input"  name="keyword" style="width: 130px;"></br>
					</div>
					<div id="search-clear" style="width: 100%;">
						<input type="submit" form="myForm" value="Search" onclick="searchClicked()" name="formSubmit" >
										
						<input form="myForm" type="button" value="Clear" onclick="clearClicked()">			
					</div>
					<div>
						<a href="http://sunlightfoundation.com/" target="_blank">Powered by Sunlight Foundation</a>
					</div>
				</form> 
			</div>
		</div>	
		<div id="info"></div>
	</body>
			
	<style>
		[id$=selection] {
			text-align: center;
		}
		
		#form-block {
			display: inline-block;
			border: 1px solid black;
		}
		
		#fcontainer div {
			padding: 5px;
		}
		
		#fcontainer {
			padding-bottom: 30px;
		}
		
		table {
			border-collapse: collapse;
		}
		
		#infoTable td {
			padding: 0px 50px;
		}
		
		.detail {
			text-align: center;
			width: 900px;
			margin: 0 auto;
			padding: 20px;
			border: 1px solid;
		}
		
		.detail td {
			min-width: 200px;
		}
		
		.bill td {
			padding: 0px 50px;
		}
		
		#details-show {
			text-align: center;
		}
		
	</style>
	
	

	
		
	
</html>

			<?php
				//data persists after form submit
				if(isset($_POST['keyword'])) {	
					?><script>
					document.getElementById("keyword-input").value = "<?php echo $_POST['keyword'];?>";</script>
					<?php
				}
				if(isset($_POST['keyword-title'])) {	

				?>
					<script>
					document.getElementById("keyword-title").innerHTML = "<?php echo $_POST['keyword-title'];?>";</script>
				<?php 
				}
				if(!isset($_POST['keyword-title']) || !$_POST['keyword-title']) {?>
					<script>
					document.getElementById("keyword-title").innerHTML = "Keyword*";</script>
					<?php
				}

/*
				if(isset($_POST['Senate_House'])) {	
					?>
					<script>
					document.getElementsByName("Senate_House").value = "<?php echo $_POST['Senate_House'];?>";</script>
					<?php
				}
*/
				if(isset($_POST['selectOption'])) {
					$select = $_POST['selectOption'];
					?>
					
					<script>
					var keySelect = document.getElementById("keyword-title");
					switch("<?php echo $select ?>") {
						
					    case "Legislators":
							keySelect.innerHTML = "State/Representative*";
					        break;
					    case "Committees":
							keySelect.innerHTML = "Committee ID*";
					        break;
					    case "Bills":
							keySelect.innerHTML = "Bill ID*";
					        break;
					    case "Amendments":
							keySelect.innerHTML = "Amendments ID*";
					        break;   
			}
	
					document.getElementById("con-select").value="<?php echo $_POST['selectOption']?>";</script>
					<?php
				}
				?>
				<script>
				
/*
				document.getElementById("nodeGoto").addEventListener("click", function() {
				    gotoNode(result.name);
				}, false);
*/

				function detailClick(id) {
					document.getElementById("infoTable").innerHTML="";
					document.getElementById(id).style.display="block";
					
					return false;
					
					
				}
				
				</script>
				<?php
				
				
				//if search is clicked
				if(isset($_POST['formSubmit']) && $_POST['Senate_House'] && $_POST['keyword'] && isset($_POST['selectOption']) && $_POST['selectOption']!="default") {
					$senateOrHouse = strtolower($_POST['Senate_House']);	
					$state = trim($_POST['keyword']);
					$name = explode(" ", $state);
					$nameLength = count($name);
					$lastName="";
					
					
					//if Legislators chosen
					if($_POST['selectOption']=="Legislators") {
						
						//all states
						$states = array( 'Alabama'=>'AL', 'Alaska'=>'AK', 'Arizona'=>'AZ', 'Arkansas'=>'AR', 'California'=>'CA', 'Colorado'=>'CO', 'Connecticut'=>'CT', 'Delaware'=>'DE', 'Florida'=>'FL', 'Georgia'=>'GA', 'Hawaii'=>'HI', 'Idaho'=>'ID', 'Illinois'=>'IL', 'Indiana'=>'IN', 'Iowa'=>'IA', 'Kansas'=>'KS', 'Kentucky'=>'KY', 'Louisiana'=>'LA', 'Maine'=>'ME', 'Maryland'=>'MD', 'Massachusetts'=>'MA', 'Michigan'=>'MI', 'Minnesota'=>'MN', 'Mississippi'=>'MS', 'Missouri'=>'MO', 'Montana'=>'MT', 'Nebraska'=>'NE', 'Nevada'=>'NV', 'New Hampshire'=>'NH', 'New Jersey'=>'NJ', 'New Mexico'=>'NM', 'New York'=>'NY', 'North Carolina'=>'NC', 'North Dakota'=>'ND', 'Ohio'=>'OH', 'Oklahoma'=>'OK', 'Oregon'=>'OR', 'Pennsylvania'=>'PA', 'Rhode Island'=>'RI', 'South Carolina'=>'SC', 'South Dakota'=>'SD', 'Tennessee'=>'TN', 'Texas'=>'TX', 'Utah'=>'UT', 'Vermont'=>'VT', 'Virginia'=>'VA', 'Washington'=>'WA', 'West Virginia'=>'WV', 'Wisconsin'=>'WI', 'Wyoming'=>'WY' );
						//if searched state is full state name instead of two letter
						if (array_key_exists(ucwords(strtolower($state)), $states)) {
						    $state= $states[ucwords(strtolower($state))];
							$url = "http://congress.api.sunlightfoundation.com/legislators?chamber=".$senateOrHouse."&state=".$state."&apikey=".$apiKey;
						} 
						else if ($nameLength>1) {
							$lastName = ucfirst(strtolower($name[1]));
							if(substr($lastName, 0, 2)=="Mc") {
								$lastName[2] = strtoupper($lastName[2]);
							}
							$url = "http://congress.api.sunlightfoundation.com/legislators?chamber=".$senateOrHouse."&first_name=".ucfirst(strtolower($name[0]))."&last_name=".$lastName."&apikey=9d713eee2bda4febb053035ef76e5f4c";
						}
						else {
							$url = "http://congress.api.sunlightfoundation.com/legislators?chamber=".$senateOrHouse."&query=".$state."&apikey=".$apiKey;
						}
						$jsonobj = request($url);
						$json = $jsonobj["results"];

	// 					print_r( $json);
						$text = "<table id='infoTable' border='1' style='margin: auto;'><tbody><tr><th>Name</th><th>State</th><th>Chamber</th><th>Details</th></tr>";
						$details ="<div id='details-show'>";
						if(!$json){
							$details = $details. "The API returned zero results for the request.</div>";
							echo $details;
							return;

						}
						foreach ($json as $key => $value) {
							
							$name = $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"];
							$text= $text. "<tr><td>".$name."</td>";
							$text= $text. "<td style='text-align: center;'>".$value["state_name"]."</td>";
							$text= $text. "<td>".$value["chamber"]."</td>";
							$text= $text. "<td><a onclick='return detailClick(\"".$value["first_name"]."_".$value["last_name"]."\")' href='".$value["bioguide_id"]."'>View Details</a></td></tr>";
							$twitter ="";
							$fb = "";
							$website="";
							if(isset($value["twitter_id"])) {
								$twitter = "<a target='_blank' href='https://twitter.com/".$value["twitter_id"]."'>".$name."</a>";
							} else {	
								$twitter = "N/A";
							}
							if(isset($value["facebook_id"])) {
								$fb = "<a target = '_blank' href='https://facebook.com/".$value["facebook_id"]."'>".$name."</a>";
							} else {
								$fb = "N/A";
							}
							if(isset($value["website"])) {
								$website = "<a target = '_blank' href='".$value["website"]."'>".$value["website"]."</a>";
							} else {
								$website = "N/A";
							}
							
							$details = $details."<div class='detail' style='display: none;' id='".$value["first_name"]."_".$value["last_name"]."'>";
							$details = $details."<img style='padding-bottom: 30px;' src='https://theunitedstates.io/images/congress/225x275/".$value["bioguide_id"].".jpg'>";
							$details = $details."<table style='margin: 0 auto; padding-top: 30px;'><tbody><tr><td>Full Name</td><td>".$value["title"]." ".$name."</td></tr><tr><td>Term Ends on</td><td>".$value["term_end"]."</td></tr><tr><td>Website</td><td>".$website."</td></tr><tr><td>Office</td><td>".$value["office"]."</td></tr><tr><td>Facebook</td><td>".$fb."</td></tr><tr><td>Twitter</td><td>".$twitter."</td></tr></tbody></table></div>";
							
						}
						$details = $details."</div>";
						echo $details;		
						$text= $text."</tbody></table>";
						echo $text;
							
					}
					
					//if Committees chosen
					else if ($_POST['selectOption']=="Committees") {
						$state = strtoupper($state);
						$url = "http://congress.api.sunlightfoundation.com/committees?committee_id=".$state."&chamber=".$senateOrHouse."&apikey=".$apiKey;
						$jsonobj = request($url);
						$json = $jsonobj["results"];
						
	// 					print_r( $json);
						$text = "<table id='infoTable' border='1' style='margin: auto;'><tbody><tr><th>Committee ID</th><th>Committee Name</th><th>Chamber</th></tr>";
						$details ="<div id='details-show'>";
						if(!$json){
							$details = $details."The API returned zero results for the request.</div>";
							echo $details;
							return;
						}
						foreach ($json as $key => $value) {
							$text = $text."<tr><td>".$value["committee_id"]."</td>";
							$text = $text.    "<td>".$value["name"]."</td>";
							$text = $text.    "<td>".$value["chamber"]."</td></tr>";
						}
							
						$text= $text."</tbody></table>";
						echo $text;
						
						
					}
					
					
					//if Bills chosen
					else if ($_POST['selectOption']=="Bills") {
						$state = strtolower($state);
						$url = "http://congress.api.sunlightfoundation.com/bills?bill_id=".$state."&chamber=".$senateOrHouse."&apikey=".$apiKey;
						$jsonobj = request($url);
						$json = $jsonobj["results"];
						
	// 					print_r( $json);
						$text = "<table id='infoTable' border='1' style='margin: auto;'><tbody><tr><th>Bill ID</th><th>Short Title</th><th>Chamber</th><th>Details</th></tr>";
						$details ="<div id='details-show'>";
						if(!$json){
							$details = $details."The API returned zero results for the request.</div>";
							echo $details;
							return;
						}						
						foreach ($json as $key => $value) {
							
							$text= $text. "<tr><td>".$value["bill_id"]."</td>";
							$text= $text. "<td style='text-align: center;'>".$value["short_title"]."</td>";
							$text= $text. "<td>".$value["chamber"]."</td>";
							$text= $text. "<td><a onclick='return detailClick(\"".$value["bill_id"]."\")' href='".$value["bill_id"]."'>View Details</a></td></tr>";
							$link ="";
							
							if(isset($value["last_version"]["urls"]["pdf"])) {
								$link = "<a target='_blank' href='".$value["last_version"]["urls"]["pdf"]."'>".$value["short_title"]."</a>";
							} else {	
								$twitter = "N/A";
							}
														
							$details = $details."<div class='detail bill' style='display: none;' id='".$value["bill_id"]."'>";
							
							$details = $details."<table style='margin: 0 auto;'><tbody><tr><td>Bill ID</td><td>".$value["bill_id"]."</td></tr><tr><td>Bill Title</td><td>".$value["short_title"]."</td></tr><tr><td>Sponsor</td><td>".$value["sponsor"]["title"]." ".$value["sponsor"]["first_name"]." ".$value["sponsor"]["last_name"]."</td></tr><tr><td>Introduced On</td><td>".$value["introduced_on"]."</td></tr><tr><td>Last action with date</td><td>".$value["last_version"]["version_name"].", ".$value["last_action_at"]."</td></tr><tr><td>Bill URL</td><td>".$link."</td></tr></tbody></table></div>";
							
						}
						$details = $details."</div>";
						echo $details;		
						$text= $text."</tbody></table>";
						echo $text;
									
					}
					
					//if Amendments chosen
					else if ($_POST['selectOption']=="Amendments") {
						
						$state = strtolower($state);
						$url = "http://congress.api.sunlightfoundation.com/amendments?amendment_id=".$state."&chamber=".$senateOrHouse."&apikey=".$apiKey;
						$jsonobj = request($url);
						$json = $jsonobj["results"];
						
						
	// 					print_r( $json);
						$text = "<table id='infoTable' border='1' style='margin: auto;'><tbody><tr><th>Amendment ID</th><th>Amendment Type</th><th>Chamber</th><th>Introduced on</th></tr>";
						$details ="<div id='details-show'>";
						if(!$json){
							$details = $details."The API returned zero results for the request.</div>";
							echo $details;
							return;
						}
						foreach ($json as $key => $value) {
							$text = $text."<tr><td>".$value["amendment_id"]."</td>";
							$text = $text.    "<td>".$value["amendment_type"]."</td>";
							$text = $text.    "<td>".$value["chamber"]."</td>";
							$text = $text.    "<td>".$value["introduced_on"]."</td></tr>";
						}
							
						$text= $text."</tbody></table>";
						echo $text;
						
					}
/*
					
					https://congress.api.sunlightfoundation.com/legislators?
chamber=
house
&state=
WA
&apikey=
YOUR_API_KEY_HERE
					$url = "https://congress.api.sunlightfoundation.com/votes?fields=roll_id,result,breakdown.total&apikey=9d713eee2bda4febb053035ef76e5f4c";
*/
					
				}
				
				
				
				
				
				function request($url) {
					$response = "";
					$jsonobj="";
					try {
						$response = @file_get_contents($url);
					} catch(Exception $e){}
					$jsonobj=json_decode($response,true);

					return $jsonobj;
				}
																	
				
/*
				foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
*/
			?>
		
	
	
	
