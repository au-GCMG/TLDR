<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="JIAJIE TANG" />
    <meta name="description" content="TLDR student/MyAssessment" />
    <link rel = "stylesheet", type="text/css", href="styles/student.css">
    <script src="scripts/studentMenu.js" defer></script>
    <title>MyAssessment</title>
  </head>
  <body>
    <?php
    define("DB_HOST1", "localhost");
    define("DB_NAME1", "tldr");
    define("DB_USER1", "dbadmin");
    define("DB_PASS1", "");    
    function Iscompleted($itemid, $studentl)
    {
      $numberofcompleted = 0;
      $conn1 = @mysqli_connect(DB_HOST1, DB_USER1, DB_PASS1, DB_NAME1);
      $sql = "SELECT * FROM homeworkcompletion WHERE itemid = '".$itemid."' and licence = '".$studentl."'";
      $resultCheck = mysqli_query($conn1, $sql);
      if($resultCheck)
      {
        if(mysqli_num_rows($resultCheck) > 0)
        {
          $row = mysqli_fetch_assoc($resultCheck);
          if($row['studentsign1'] == 1)
          {
            $numberofcompleted++;
          }
          if($row['studentsign2'] == 1)
          {
            $numberofcompleted++;
          }
        }
      }
      mysqli_free_result($resultCheck);
      mysqli_close($conn1);
      return $numberofcompleted;
    }
    ?>
    
    
    <?php
        session_start();
        $email = $_SESSION['email'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        $licence = "";
        $firstname = "";
        $surname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $licence = $row['licence'];
            $firstname = $row['firstname']; 
            $surname = $row['surname'];
            echo "<h2>Welcome $firstname ($licence)</h2>";          
            require_once "inc/menu.inc.php";
          }
        }
        mysqli_free_result($result);       
    ?>
   <div id = "unitArea">
      <?php
         $sql = "SELECT * FROM sys_unit";
         $result = mysqli_query($conn, $sql);
         if($result)
         {
          if(mysqli_num_rows($result) > 0)
          {
            echo "<table id = 'Task unit'>";
            echo "<thead>";
              echo "<tr>";
                echo "<th>Unit</th>";
                echo "<th>Description</th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";              
            while ($row = mysqli_fetch_assoc($result))
            {
              echo "<tr>";
              echo "<th><a href = MyAssessment.php?studentL=",base64_encode($licence),"&unitid=",$row['id'],">",$row['unitNO'],"</a></th>";
              echo "<th>",$row['description'],"</th>";
              echo "</tr>";
            }
          }
          echo "</tbody>";
          echo "</table>";
         }
         mysqli_free_result($result);
         
      ?>
    </div>
    <div id = "taskArea">
      <?php
        if(isset($_GET['unitid']))
        {          
          $sql = "SELECT * FROM sys_task where unitid ='".$_GET['unitid']."'";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            if(mysqli_num_rows($result) > 0)
            {
              echo "<table id = 'Task Assessment Records'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th>Task</th>";
                  echo "<th>Description</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";  
              while($row = mysqli_fetch_assoc($result))
              {
                echo "<tr>";
                echo "<th><a href = MyAssessment.php?studentL=",base64_encode($licence),"&unitid=",$row['unitid'],"&taskid=",$row['id'],">",$row['taskNO'],"</a></th>";
                echo "<th>",$row['description'],"</th>";
                echo "</tr>";
              }
            }
            echo "</tbody>";
            echo "</table>";
          }
          mysqli_free_result($result);
        }        
      ?>
    </div>

    <div id="assessmentItemarea">
    <?php
    if (isset($_GET['taskid'])) {
        $sql = "SELECT AssessmentItemID, ItemDescription, ItemAdditionalInfo, RequiredSignCount FROM taskAssessmentItem WHERE Taskid = '" . $_GET['taskid'] . "'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h3>TASK " . $_GET['taskid'] . " Assessment Records</h3>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Assessment Item ID</th>";
            echo "<th>Item Description</th>";
            echo "<th>Option Text</th>";
            echo "<th>Required Demonstrations</th>";
            echo "<th>Instructor MDI</th>"; 
            echo "<th>Assessment Status</th>"; 
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $RequiredSignCount = $row['RequiredSignCount'];  
                $mdi = "";
                $isCompleted = false;

                $completionSql = "SELECT mdi FROM ItemCompletion WHERE AssessmentItemID = '" . $row['AssessmentItemID'] . "'";
                $completionResult = mysqli_query($conn, $completionSql);

                if ($completionRow = mysqli_fetch_assoc($completionResult)) {
                    if (isset($completionRow['mdi'])) {
                        $mdi = $completionRow['mdi'];
                        $isCompleted = true;                   
                    }
                }

                echo "<tr>";
                echo "<td>", $row['AssessmentItemID'], "</td>";
                echo "<td>", $row['ItemDescription'], "</td>";

                if (!is_null($row['ItemAdditionalInfo'])) {
                    $optionSql = "SELECT OptionText FROM ItemAdditionalInfoOptions WHERE AssessmentItemID = '" . $row['AssessmentItemID'] . "'";
                    $optionResult = mysqli_query($conn, $optionSql);
                    
                    echo "<td>";
                    echo "<select name='optionTextDropdown' onchange='showOptionText(this, \"" . $row['AssessmentItemID'] . "\")'>";
                    echo "<option value=''>-- Select an option --</option>";
                    while ($optionRow = mysqli_fetch_assoc($optionResult)) {
                        echo "<option value='", $optionRow['OptionText'], "'>", $optionRow['OptionText'], "</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                } else {
                    echo "<td></td>"; // If NULL, do not display the dropdown menu
                }

                echo "<td>", $RequiredSignCount, " times </td>"; 

                if ($isCompleted) {
                    echo "<td>", $mdi, "</td>";  // 显示 mdi 值
                    echo "<td>Completed</td>";  // 显示 Completed
                } else {
                    echo "<td></td>";  
                    echo "<td></td>";  
                }

                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        }

        mysqli_free_result($result);
    }
    ?>
</div>

<div id="signOffArea">
<?php
if (isset($_GET['taskid'])) {
    $signoffSql = "SELECT mdi, InstructorSignature, licence, AssessmentID, StudentSignature, DATE FROM tasksignoff WHERE taskid = '" . $_GET['taskid'] . "'";
    $signoffResult = mysqli_query($conn, $signoffSql);
    
    if ($signoffRow = mysqli_fetch_assoc($signoffResult)) {
        // 如果mdi不为空
        if (!empty($signoffRow['mdi'])) {
            $signoffmdi = $signoffRow['mdi'];
            $InstructorSignature = $signoffRow['InstructorSignature'];
            $assessmentID = $signoffRow['AssessmentID']; 
            
            echo "<h3>TASK " . $_GET['taskid'] . " Sign off</h3>";
            echo "<table>";
            echo "<tr><td>Driver's Name:</td><td>$firstname $surname</td></tr>";
            echo "<tr><td>Licence Number:</td><td>{$signoffRow['licence']}</td></tr>";
            
            echo "<tr>";
            echo "<td>Learner Driver's Signature:</td>";
            
            // StudentSignature 是否为空
            if (empty($signoffRow['StudentSignature'])) {
                echo "<td>";
                echo "<button class='sign-button' data-licence='{$signoffRow['licence']}' data-assessmentid='$assessmentID' data-firstname='$firstname' data-surname='$surname'>Sign</button>";
                echo "</td>";
            } else {
                echo "<td style='font-family: cursive;'>{$signoffRow['StudentSignature']}</td>";
            }
            echo "</tr>";
            
            echo "<tr><td>Authorised Examiner's Name:</td><td>$InstructorSignature</td></tr>";
            echo "<tr><td>Authorised Examiner's Signature:</td><td style='font-family: cursive;'>$InstructorSignature</td></tr>";
            echo "<tr><td>MDI No.:</td><td>$signoffmdi</td></tr>";
            
            echo "<tr><td>Date:</td>";
            // StudentSignature 是否为空
            if (empty($signoffRow['StudentSignature'])) {
                echo "<td>Awaiting Learner's Signature</td>";
            } else {
                echo "<td>{$signoffRow['DATE']}</td>";
            }
            echo "</tr>";
            
            echo "</table>";
        }
    }
    mysqli_free_result($signoffResult);
}
?>
</div>

<script> //sign button
document.addEventListener('DOMContentLoaded', function() { 
    var signButtons = document.querySelectorAll('.sign-button');

    signButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var licence = this.getAttribute('data-licence');
            var assessmentId = this.getAttribute('data-assessmentid');
            var firstname = this.getAttribute('data-firstname');
            var surname = this.getAttribute('data-surname');
            
            var formData = new FormData();
            formData.append('licence', licence);
            formData.append('AssessmentID', assessmentId);
            formData.append('firstname', firstname);
            formData.append('surname', surname);
            
            fetch('update_signoffstu.php', { 
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); 
                location.reload(); // 刷新当前页面
            });
        });
    });
});
</script>