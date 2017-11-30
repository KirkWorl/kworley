<?php
    
    include 'inc/header.php';
    
    
?>

<script>
    $(document).ready( function() {
       $(".nameLink").on("click", function() {
          $.ajax({
                type: "GET",
                url: "api/getPetInfo.php",
                dataType: "json",
                data: {"id": $(this).attr('id')},
                success: function(data,status) {
                    $("#petInfo").html("Age: " + data.age + "<br>" +
                                        " <img src= '" + data.pictureURL + "'><br>" +
                                        data.description)
                
                },
                complete: function(data,status) { 
                    //alert(status);
                }
                
            });
       });
       
        
    });
</script>

<?php
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("adoptions");
    
    function getPetList() {
        global $conn;
        
        $sql = "SELECT * FROM `adoptees`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
    $pets = getPetList();
    
    foreach($pets as $pet) {
        echo "Name: <a class='nameLink' href='#' id='" . $pet['id'] . "'>" . $pet['name'] . "</a><br>";
        echo "Type: " . $pet['type'] . "<br>";
        echo "<hr><br>";
    }

?>

<div id="petInfo"></div>

<?php
    include 'inc/footer.php';
?>