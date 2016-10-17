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
		https://congress.api.sunlightfoundation.com/[method]
		/legislators?apikey=[your_api_key]
		
		https://congress.api.sunlightfoundation.com/legislators?
chamber=
house
&state=
WA
&apikey=
YOUR_API_KEY_HERE
	-->
		<script>
		function selectChange() {
			var keySelect = document.getElementById("keyword-title");
			var opt = document.getElementById("con-select").value;

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
			if(infoTable) {
				infoTable.innerHTML = "";

			}
			if(detailTable) {
			detailTable.innerHTML = "";
			}
			keySelect.innerHTML = "Keyword*";
			keyInput.value = "";


		}
		
		function searchClicked() {
			var opt = document.getElementById("con-select");

			var keyInput = document.getElementById("keyword-input").value;
			

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
							<input type="radio" name="Senate_House" value="Senate"  checked="checked"> Senate
							<input type="radio" name="Senate_House" value="House"> House <br>
						</div>
					</div>
					<div id="keyword-selection">
						<input style="display: none"  id="secret" name="keyword-title" value="">
						<div style="display: inline-block;"  id="keyword-title">Keyword*</div>
						<input type="text" id="keyword-input"  name="keyword" style="width: 130px;"></br>
					</div>
					<div id="search-clear" style="width: 100%;">
						<input type="submit" form="myForm" value="Search" onclick="searchClicked()" name="formSubmit" ><br>
										
						<button form="myForm" type="reset" value="Clear" onclick="clearClicked()">Clear</button> 				
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

				if(isset($_POST['Senate_House'])) {	
					?>
					<script>
					document.getElementsByName("Senate_House").value = "<?php echo $_POST['Senate_House'];?>";</script>
					<?php
				}
				if(isset($_POST['selectOption'])) {
					$select = $_POST['selectOption'];
					?>
					
					<script>
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
				if(isset($_POST['formSubmit']) && $_POST['keyword-title'] && $_POST['keyword'] && $_POST['selectOption']!="default") {
					$senateOrHouse = strtolower($_POST['Senate_House']);	
					$state = $_POST['keyword'];
					if($_POST['selectOption']=="Legislators") {
						
						$url = "https://congress.api.sunlightfoundation.com/legislators?chamber=".$senateOrHouse."&state=".$state."&apikey=".$apiKey;
						$jsonobj = request($url);
						$json = $jsonobj["results"];
	// 					print_r( $json);
						$text = "<table id='infoTable' border='1' style='margin: auto;'><tbody><tr><th>Name</th><th>State</th><th>Chamber</th><th>Details</th></tr>";
						$details ="<div id='details-show'>";
						foreach ($json as $key => $value) {
							$name = $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"];
							$text= $text. "<tr><td>".$name."</td>";
							$text= $text. "<td>".$value["state_name"]."</td>";
							$text= $text. "<td>".$value["chamber"]."</td>";
							$text= $text. "<td><a onclick='return detailClick(\"".$value["first_name"]."_".$value["last_name"]."\")' href='".$value["bioguide_id"]."'>View Details</a></td></tr>";
							echo #$
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
							$details = $details."<img src='https://theunitedstates.io/images/congress/225x275/".$value["bioguide_id"].".jpg'>";
							$details = $details."<table style='margin: 0 auto; padding-top: 30px;'><tbody><tr><td>Full Name</td><td>".$value["title"]." ".$name."</td></tr><tr><td>Term Ends on</td><td>".$value["term_end"]."</td></tr><tr><td>Website</td><td>".$website."</td></tr><tr><td>Office</td><td>".$value["office"]."</td></tr><tr><td>Facebook</td><td>".$fb."</td></tr><tr><td>Twitter</td><td>".$twitter."</td></tr></tbody></table></div>";
							
						}
						$details = $details."</div>";
						echo $details;		
						$text= $text."</tbody></table>";
						echo $text;
						?>				
							
						
					<?php	
					}
					else if ($_POST['selectOption']=="Committees") {
						
					}
					else if ($_POST['selectOption']=="Bills") {
						
					}
					else if ($_POST['selectOption']=="Amendments") {
						
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
					$response = file_get_contents($url);
					$jsonobj=json_decode($response,true);
					return $jsonobj;
				}
																	
				
/*
				foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
*/
			?>
		
	
	
	
