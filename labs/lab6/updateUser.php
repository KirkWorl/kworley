<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: index.php");
}

include("../../dbConnection.php");
$conn = getDatabaseConnection();

function getDepartmentInfo() {
    global $conn;        
    $sql = "SELECT deptName, departmentId 
            FROM `tc_department` 
            ORDER BY deptName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    return $records;
}

function getUserInfo($userId) {
    global $conn;    
    $sql = "SELECT * FROM `tc_user` WHERE userId = $userId";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch();
    
    // Debugging
    // print_r($record);
    
    return $record;
}

if(isset($_GET['updateUserForm'])) {
    $sql = "UPDATE tc_user
            SET firstName = :fName,
                lastName = :lName,
                universityId = :uniId,
                phone = :phone,
                gender = :gender,
                role = :role,
                deptId = :departmentId
			WHERE userId = :userId";
	$namedParameters = array();
	$namedParameters[":fName"] = $_GET['firstName'];
	$namedParameters[":lName"] = $_GET['lastName'];
	$namedParameters[":userId"] = $_GET['userId'];
	$namedParameters[":uniId"] = $_GET['universityId'];
	$namedParameters[":phone"] = $_GET['phone'];
	$namedParameters[":gender"] = $_GET['gender'];
	$namedParameters[":role"] = $_GET['role'];
	$namedParameters[":departmentId"] = $_GET['deptId'];
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
}

if(isset($_GET['userId'])) {
    $userInfo = getUserInfo($_GET['userId']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin: Updating User </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    </head>
    
    <body>
        <h1> Admin Section </h1>
        <h2> Updating User Info </h2>
    
        <fieldset>
            <legend> Update User </legend>
            
            <form>
                <input type="hidden" name="userId" value="<?=$userInfo['userId']?>" />
                First Name: <input type="text" name="firstName" required value="<?=$userInfo['firstName']?>" /> <br>
                Last Name: <input type="text" name="lastName" required value="<?=$userInfo['lastName']?>"/> <br>
                Email: <input type="text" name="email" value="<?=$userInfo['email']?>"/> <br>
                University Id: <input type="text" name="universityId" value="<?=$userInfo['universityId']?>"/> <br>
                Phone: <input type="text" name="phone" value="<?=$userInfo['phone']?>"/> <br>
                Gender: <input type="radio" name="gender" value="F" id="genderF" <?=(ucfirst($userInfo['gender'])=='F') ? "checked":"" ?> required/> 
                        <label for="genderF">Female</label>
                        <input type="radio" name="gender" value="M" id="genderM" <?=(ucfirst($userInfo['gender'])=='M') ? "checked":"" ?> required/> 
                        <label for="genderM">Male</label><br>
                Role:   <select name="role">
                            <option value=""> Select One </option>
                            <option <?=(lcfirst($userInfo['role']) == 'faculty') ? "selected":""?>>Faculty</option>
                            <option <?=(lcfirst($userInfo['role']) == 'student') ? "selected":""?>>Student</option>
                            <option <?=(lcfirst($userInfo['role']) == 'staff') ? "selected":""?>>Staff</option>
                        </select>
                <br/>
                Department: <select name="deptId">
                                <option value=""> Select One </option>
                                <?php
                                    $departments = getDepartmentInfo();
                                    foreach($departments as $r) {
                                        echo "<option " .(($userInfo['deptId'] == $r['departmentId']) ? 'selected':''). " value='$r[departmentId]'>$r[deptName]</option>";
                                    }
                                ?>
                            </select>
                            <br/>
                <input type="submit" name="updateUserForm" value="Update User!"/>
            </form>
        </fieldset>

    </body>
</html>