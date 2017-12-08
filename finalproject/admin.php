<?php
include '../dbConnection.php';
session_start();

$conn = getDatabaseConnection();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}

function adminLayout() {
    global $conn;
    
    $sql = "SELECT * FROM  `sr_runs` NATURAL JOIN `sr_games` NATURAL JOIN `sr_category` WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $allruns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($allruns as $r) {
        echo "<tr>";
        echo "<td>" . $r['runner'] . "</td>";
        echo "<td>" . $r['country'] . "</td>";
        echo "<td class='gametitle'>" . $r['gameName'] . "</td>";
        echo "<td class='smaller'>" . $r['runtime'] . "</td>";
        echo "<td>" . $r['categoryName'] . ", " . $r['completion'] . "</td>";
        echo "<td class='smaller'><a href='editRun.php?runId=" . $r['runId'] . "'>Edit</a></td>";
        echo "<td class='smaller'><form action='deleteRun.php' onsubmit='return confirmDelete(\"".$r['runner']."\")'><input type='hidden' name='runId' value='".$r['runId']."'><input type='submit' value='Delete'></form></td>";
        echo "</tr>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Speedrun Admin Portal</title>
        <meta charset="utf-8">
        <meta name="author" value="Kirk Worley">
        <link href="img/ico.png" rel="icon">
        <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto|Vollkorn+SC" rel="stylesheet">
        <!-- Lobster = 'cursive', Roboto = 'san-serif', Vollkorn SC = 'serif' -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        
        <style>
            @import url("css/style.css");
            
            #addRun, #logout, #reports {
                margin: 12px 5px;
                padding: 8px 17px;
            }
            
            h1, h3 {
                font-family: "Vollkorn SC", serif;
            }
            
            h3 {
                margin-top: 6px;
                margin-bottom: -2px;
            }
            
            h1 {
                margin-top: 10px;
            }
            
            body {
                text-align: center;
            }
            
            a {
                color: gold;
            }
            
            a:hover {
                color: red;
            }
            
            .tbl-content {
                height: 550px;
            }
            
            .smallerh {
                padding: 20px 15px;
                width: 175px;
            }
            
            .smaller {
                padding: 15px;
                width: 160px;
            }
            
            h3, #minr, #maxr {
                color: white;
            }
            
            #minr, #maxr {
                font-family: "Roboto", sans-serif;
            }
            
            #runReports td {
                font-size: 14px;
                padding: 7px;
            }
            
            #runReports th {
                font-size: 19px;
                padding: 9px;
            }
        </style>
        <script>
            $(document).ready( function() {
                $("#reports").click( function() {
                    $('#reportModal').modal("show");   
                    
                    $.ajax({
                        type: "GET",
                        url: "api/speedruns.php",
                        dataType: "text",
                        data: {"func": '3'},
                        success: function(data, status) {
                            var parsed = JSON.parse(data);
                            
                            $("#runReports").empty();
                            $("#reportTitle").html("<span class='fancytext'>Speedrun Reports</span>")
                            
                            var toApp = "<h3>Number of runs: " + parsed.single['a'] + "</h2>"
                            toApp += "<table id='runRep'><tr><th>Category</th><th>Runs</th></tr>";
                            
                            for(var i = 0; i < parsed.categories.length; i++) {
                                toApp += "<tr><td>" + parsed.categories[i]['categoryName'] + "</td>";
                                toApp += "<td>" + parsed.categories[i]['counts'] + "</td></tr>";
                            }
                            toApp += "</table>";
                            $("#runReports").append(toApp);
                            
                            toApp5 = "<table id='runRep2'><tr><th>Category</th><th>Runs</th></tr>";
                            for(var i = 0; i < parsed.gamecount.length; i++) {
                                toApp5 += "<td>" + parsed.gamecount[i]['gameName'] + "</td>";
                                toApp5 += "<td>" + parsed.gamecount[i]['gct'] + "</td></tr>";
                            }
                            toApp5 += "</table>";
                            $("#runReports").append(toApp5);
                            
                            toApp2 = "<h3>Fastest Run:</h3><span id='minr'>" + parsed.min['runtime'] + 
                                    " by: " + parsed.min['runner'] + ", playing " + parsed.min['gameName'] + ".</span>";
                            $("#runReports").append(toApp2);
                            
                            toApp3 = "<h3>Longest Run:</h3><span id='maxr'>" + parsed.max['runtime'] + 
                                    " by: " + parsed.max['runner'] + ", playing " + parsed.max['gameName'] + ".</span>";
                            $("#runReports").append(toApp3);
                        }
                    });
                });
            });
            
            function confirmDelete(runnerName) {
                return confirm("Are you sure you want to delete " + runnerName + "'s run?");
            }
        </script>
    </head>
    
    <body id="content">
        <!-- Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportAdminModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reportTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="background-color: black;">
                   <div id="runReports"></div> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
        <h1>Admin: Run Details</h1>
        <center>
            <button id="addRun" class="fancytext" onclick="location.href='addRun.php'; return false;">Add Run</button>
            &nbsp;
            <button id="logout" class="fancytext" onclick="location.href='login.php?logout=True'; return false;">Logout</button>
            &nbsp;
            <button id="reports" class="fancytext">Reports</button>
            
            <div id="rundata">
                <div class="tbl-header">
                    <table id="runhead" cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Runner Name <i class="fa fa-user-circle-o" aria-hidden="true"></i></th>
                            <th>Country <i class="fa fa-flag" aria-hidden="true"></i></th>
                            <th>Game Name <i class="fa fa-gamepad" aria-hidden="true"></i></th>
                            <th class="smallerh">Run Time <i class="fa fa-clock-o" aria-hidden="true"></i></th>
                            <th style="padding-left: 30px;"> Category <i class="fa fa-table" aria-hidden="true"></i></th>
                            <th class="smallerh">Edit Run <i class="fa fa-pencil" aria-hidden="true"></i></th>
                            <th class="smallerh">Delete Run <i class="fa fa-times" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    </table>
                </div>
                <div class="tbl-content">
                    <table id="runs" cellpadding="0" cellspacing="0" border="0">
                        <?=adminLayout()?>
                    </table>
                </div>
            </div>
        </center>
    </body>
</html>