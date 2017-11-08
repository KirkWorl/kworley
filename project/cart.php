<?php
include '../dbConnection.php';

session_start();

function displayItems(){
    $totalPrice = 0;
    $conn = getDatabaseConnection();
    
    if(isset($_SESSION['currentCart'])){
         echo "<table class='table table-hover' border = '1'>
        			<tr>
        				<th>Item Name</th>
        				<th>Price</th>
        			</tr>";

    foreach($_SESSION['currentCart'] as $elements){
        $namedParameters = array(":id" => $elements);
        
        $sql = "SELECT * FROM `items` i JOIN `item_category` c JOIN `item_ageGroup` a
        		ON i.item_category = c.categoryId AND i.item_ageGroup = a.ageGroupId
        		WHERE i.itemId = :id";
        		
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($records as $r) {
        	echo "<tr>";
            echo "<td>" .$r['name']. "</td>";
            echo "<td> $" .$r['price']. "</td>";
            $totalPrice += $r['price'];
            echo "</tr>";
        }
    }
    echo "</table>";
     
    echo "<table class='table table-hover' border = '2'>";
    echo "<tr>";
    echo "<td>Total Price</td>";
    echo "<td> $". $totalPrice. "</td>";
    echo "</tr>";
    echo "</table>"; 
    } 
    else {
        echo "<h2 id='cartTittle'>Cart is Empty </h2>";
    }
}

function clearData(){
    session_unset();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Checkout Page </title>
        <link  href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
    </head>
    <body>
        <div id = "Cart" class="jumbotron text-center">
            <h1>Checkout Items</h1>
        </div>
        <div class="container">
            <div id="" class="">
                
                <div id ="" row1class="col-sm-4">
                    
                    <?=displayItems()?>
                    
                </div>
                
                <div class="col-sm-4">
                   <tr>
                       <td>
                           <form action = "clearCart.php">
                           <button type="submit" class="btn">Clear Cart</button>
                           </form>
                       </td>
                       <br>
                       <td>
                           <form action = "index.php">
                               <input type = "submit" class="btn" value = "Continue Shopping">
                           </form>
                       </td>
                   </tr>
                </div>
            </div>
       </div>

    </body>
</html>