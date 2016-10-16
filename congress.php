<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
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
		
		
		<div>
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
				if(isset($_POST['formSubmit']) && $_POST['keyword-title'] && $_POST['keyword']) {
					$url = "https://congress.api.sunlightfoundation.com/votes?fields=roll_id,result,breakdown.total&apikey=9d713eee2bda4febb053035ef76e5f4c";
					$fields ="";
					echo request($url, $fields);
				}
				
				
				
				
				
				function request($url, $fields) {
					//url-ify the data for the POST
		/*
					foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
					rtrim($fields_string, '&');
					
		*/
					//open connection
					$ch = curl_init();
					
					//set the url, number of POST vars, POST data
					curl_setopt($ch,CURLOPT_URL, $url);
		// 			curl_setopt($ch,CURLOPT_POST, count($fields));
		// 			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
					
					//execute post
					$result = curl_exec($ch);
					
					//close connection
					curl_close($ch);
					return $result;
	
				}
																	
				
				foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
			?>
		</div>
		
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
		
		
	</style>
	
	

	
		
	
</html>
