<?php
include '../dbConnection.php';

session_start();
$conn = getDatabaseConnection();

function getItemTypes() {
	global $conn;
	
	$sql = "SELECT * FROM `item_category` WHERE 1";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	
	$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($records as $r) {
		echo "<option> " . $r['categoryName'] . " </option>";
	}
}

function getItemGroups() {
	global $conn;
	
	$sql = "SELECT * FROM `item_ageGroup` WHERE 1";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	
	$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($records as $r) {
		echo "<option> " . $r['ageGroup'] . " </option>";	
	}
}

function displayItems() {
	global $conn;
	
	$sql = "SELECT * FROM `items` i JOIN `item_category` c JOIN `item_ageGroup` a
			ON i.item_category = c.categoryId AND i.item_ageGroup = a.ageGroupId
			WHERE 1";
	
	if(isset($_GET['go'])) {
		if(!empty($_GET['name'])) {
			$sql .= " AND i.name LIKE :itemName";
			$namedParameters[':itemName'] = "%" . $_GET['name'] . "%";
		}
		
		if(!empty($_GET['category'])) {
			$sql .= " AND c.categoryName = :itemCat";
			$namedParameters[':itemCat'] = $_GET['category'];
		}
		
		if(!empty($_GET['agegroup'])) {
			$sql .= " AND a.ageGroup = :age";
			$namedParameters[':age'] = $_GET['agegroup'];
		}
		
		if($_GET['price'] == "low") {
			$sql .= " ORDER BY i.price";
		}
		
		if($_GET['price'] == "high") {
			$sql .= " ORDER BY i.price DESC";
		}
	}
	
	if(!isset($_GET['price'])) {
		$sql .= " ORDER BY i.name";
	}
	
	$stmt = $conn->prepare($sql);
	$stmt->execute($namedParameters);
	
	$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<table class='table table-hover'>
			<tr>
				<th>Item Name</th>
				<th>Price</th>
				<th>Category</th>
				<th>Age Group</th>
			</tr>";
			
	foreach($records as $r) {
		echo "<tr>";
        echo "<td><a target='itemInfo' href='itemInfo.php?itemId=".$r['itemId']."'>".$r['name']."</a></td>";
        echo "<td> $" .$r['price']. "</td>";
        echo "<td>" .$r['categoryName']. "</td>";
        echo "<td>" .$r['ageGroup']. "</td>";
        echo "<form action='addToCart.php' method='GET'>";
        echo "<td> <button type='submit' name='addCart' value=".$r['itemId'] .">Add to Cart</button></td>";
        echo "</form>";
        echo "</tr>";
	}
	
	echo "</table>";
}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Shopping Bonanza</title>
        <link  href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	</head>

	<body>
		<div >
			<div id="main" class="jumbotron text-center" >
				<h1><span class="blink">Shopping Bonanza</span></h1>
				<form action="cart.php">
					<input type="submit" class="btn" name="cart" value="My Cart"/>
				</form>
			</div>
	
			<div class="container">
				<div id="fillform" class="row">
					
					<div id="col-1" class="col-sm-4">
						<div class="form-group">
						<form>
							<table>
								<tr>
									<td><label for="inputsm">Search: </label></td>
									<td><input type="text" class="form-control input-sm" id="inputsm" name="name"/></td>
									<td><input type="submit" class="btn" name="go" value="Search"/></td>
								</tr>
								
								<tr>				
									<td><label for="inputsm">Category:</label></td>
									<td>
										<select name="category" class="form-control">
											<option value="">Select One</option>
											<?=getItemTypes()?>
										</select>
									</td>
								</tr>
								<br>
								<tr>
									<td><label for="inputsm">Age Group:</label></td>
									<td>
										<select name="agegroup" class="form-control">
											<option value="">Select One</option>
											<?=getItemGroups()?>
										</select>
									</td>
								</tr>
								
								<tr>
									<td><label for="inputsm">By Price:</label></td>
									<td><input type="radio" name="price" value="low" id="lowToHigh"><label for="lowToHigh" class="radio-inline">Lowest First</label></td>
									<td><input type="radio" name="price" value="high" id="highToLow"><label for="highToLow" class="radio-inline">Highest First</label></td>
								</tr>
							</table>
						</form>
						</div>
					</div>
						
					<div id="col-2" class="col-sm-4">
							
						<?=displayItems()?>	
						
					</div>
					
					<div id="col-3" class="col-sm-4">
						<h2>Item Info</h2>
				        <iframe name="itemInfo" width=450 height=400></iframe>
					</div>
					
				</div>
				
			</div>
		</div>
		
	</body>
</html>
