<?php
    
    include 'inc/header.php';
    
    
?>

<script>
    $(document).ready( function() {
        $(".nameLink").on("click", function() {
            
            $('#petInfoModal').modal("show");   
            $("#petInfo").html("<img src='img/loading.gif'>");
            
            $.ajax({
                type: "GET",
                url: "api/getPetInfo.php",
                dataType: "json",
                data: {"id": $(this).attr('id')},
                success: function(data,status) {
                    $("#petInfo").html("Age: " + data.age + "<br>" +
                                        " <img src='img/" + data.pictureURL + "'><br>" +
                                        data.description)
                                        
                    
                    $('#petNameModalLabel').html(data.name);
                
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

<!-- Modal -->
<div class="modal fade" id="petInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="petNameModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div id="petInfo"></div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="petInfo"></div>

<?php
    include 'inc/footer.php';
?>