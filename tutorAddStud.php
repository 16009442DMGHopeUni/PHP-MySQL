<?php
    include ("Header.php");
    include ("LeftNav.php");
    include ("tutorCheck.php");
?>
<div class="col c8">
<?php
if (!isset($_POST['courseID']) AND !isset($_POST['studentID']))
{
    if (!isset($_POST['forename']))
    {
        showForm();
    }
    else
    {
        addUserToDatabase();
        $studentID = getStudentID();
        $resource = getCourses();
        showcourses($resource, $studentID);
    }
}
else
{
    enrolStudent();
}
?>
</div>
<?php
    include ("RightNav.php");
    include ("Footer.php");
function showForm()
{
echo ("
    <form name= 'register' method='post' action='tutorAddStud.php'>
    Forename        <input type='text' name='forename' />   <br />
    Surname         <input type='text' name='surname' />    <br />
    Email Address   <input type='text' name='email' />      <br />
                    <input type='submit' onclick='submit' />
    </form>
    ");
}
function addUserToDatabase()
{
    $fn = $_POST['forename'];
    $sn = $_POST['surname'];
    $em = $_POST['email'];
 
    $sql = "INSERT INTO user (userForename, userSurname, userEmail, userPassword, userType, userActive)
    VALUES ('$fn', '$sn', '$em', '$em', 'student', 1)";
    doSQL($sql);
}
function getStudentID()
{
    $em = $_POST['email'];
    $sql = "SELECT userID FROM user WHERE userEmail = '$em' ";
    $record = mysqli_fetch_array(doSQL($sql));
    $studentID = $record['userID'];
    return $studentID;
}
function getCourses()
{
    $tutorID = $_SESSION['userID'];
    $sql = "SELECT * FROM course WHERE courseOwner = $tutorID";
    $resource = dosql($sql);
    return $resource;
}
function showCourses($resource,$studentID)
{
    echo ("<form name='showCourses' method='post' action='tutorAddStud.php' >");
    while ($currentLine = mysqli_fetch_array($resource))
    {
        echo ("<input type='checkbox' name='courseID[]' value='$currentLine[courseID]' />");
        echo ($currentLine['courseName'] . '<br />');
    }
    echo ("<br />
            <input type='hidden' name='studentID' value='$studentID' />
            <input type='submit' onclick='submit' />
            </form>");
}
function enrolStudent()
{
    $course = $_POST['courseID'];
    $studentID = $_POST['studentID'];
    $today = date("Ymd");
 
    foreach ($course as $currentCourse)
    {
        $sql = "INSERT INTO studentTaking (courseID, userID, dateRegistered, authorised)
        VALUES ('$currentCourse', '$studentID', '$today', 1)";
        doSQL($sql);
    }
}
function doSQL($sql)
{
$conn = mysqli_connect('localhost','root','root','aceTraining');
    echo ("<p>SQL QUERY: <pre>" . $sql . "</pre></p>");
 
    if ($resource = mysqli_query($conn,$sql))
        {
            echo ("<p style='color:green'>SUCCESS</p>");
            return $resource;
        }
    else
        {
            echo ("<p style='color:red'>FAIL: ");
            echo (mysqli_error($conn) . "</p>");
            return false;
        }
}
?>