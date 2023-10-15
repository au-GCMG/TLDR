<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="JIAJIE TANG" />
    <meta name="description" content="TLDR cbta_detail" />
    <title>CBT_assessment</title>
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
              echo "<th><a href = assessment.php?studentL=",base64_encode($licence),"&unitid=",$row['id'],">",$row['unitNO'],"</a></th>";
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
                echo "<th><a href = assessment.php?studentL=",base64_encode($licence),"&unitid=",$row['unitid'],"&taskid=",$row['id'],">",$row['taskNO'],"</a></th>";
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
<?php
$allCompleted = true; //set for showing <div id="signOffArea">

?>

    <div id="assessmentItemarea">
    <?php

    if (isset($_GET['taskid'])) {
        $sql = "SELECT * FROM taskAssessmentItem WHERE Taskid = '" . $_GET['taskid'] . "'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
          echo "<h3>TASK " . $_GET['taskid'] . " Assessment Records</h3>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Assessment Item ID</th>";
            echo "<th>Item Description</th>";
            echo "<th>Option Text</th>";
            echo "<th>Assessment Records</th>";
            echo "<th></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>", $row['AssessmentItemID'], "</td>";
              echo "<td>", $row['ItemDescription'], "</td>";
          
              $completionSql = "SELECT SignCompletion, SignCount FROM ItemCompletion WHERE AssessmentItemID = '" . $row['AssessmentItemID'] . "'";
              $completionResult = mysqli_query($conn, $completionSql);
              $isCompleted = false;
              $signCountFromCompletion = 0;
          
              if ($completionRow = mysqli_fetch_assoc($completionResult)) {
                  $isCompleted = $completionRow['SignCompletion'] == 1;
                  $signCountFromCompletion = $completionRow['SignCount'];
                if (!$isCompleted) {
                    $allCompleted = false; // 任一没完成 = 项目没有完成 $allCompleted 为 false
                }
            } else {
                $allCompleted = false; // 其他情况 = 项目没有完成
            }
              
            
              if ($isCompleted) {
                  echo "<td></td>";  // 不显示OptionText
                  echo "<td>", $signCountFromCompletion, "</td>";  // 显示SignCount
                  echo "<td></td>";  // 不显示+ -
                  echo "<td>ItemCompleted</td>";
              } else {
                  // 显示 OptionText
                  if (!is_null($row['ItemAdditionalInfo'])) {
                      echo "<td>";
                      $optionSql = "SELECT OptionText FROM ItemAdditionalInfoOptions WHERE AssessmentItemID = '" . $row['AssessmentItemID'] . "'";
                      $optionResult = mysqli_query($conn, $optionSql);
                      
                      echo "<select name='optionTextDropdown' onchange='showOptionText(this, \"" . $row['AssessmentItemID'] . "\")'>";
                      echo "<option value=''>-- Select an option --</option>";
                      while ($optionRow = mysqli_fetch_assoc($optionResult)) {
                          echo "<option value='", $optionRow['OptionText'], "'>", $optionRow['OptionText'], "</option>";
                      }
                      echo "</select>";
                      echo "</td>";
                  } else {
                      echo "<td></td>"; // 如果为 NULL不显示下拉菜单
                  }
          
                  // 显示按钮和SignCount
                  echo "<td>";
                  echo "<button class='increase-button' data-itemid='" . $row['AssessmentItemID'] . "' data-assessmentid='" . $row['AssessmentID'] . "' data-requiredcount='" . $row['RequiredSignCount'] . "'>+</button>";
                  echo "<button class='decrease-button' data-itemid='" . $row['AssessmentItemID'] . "' data-assessmentid='" . $row['AssessmentID'] . "'>-</button>";
                  echo "<span class='signcount' id='count_" . $row['AssessmentItemID'] . "_" . $row['AssessmentID'] . "'>0</span>"; // 初始值为0
                  echo "</td>";
                  echo "<td>";
                  echo "<button class='sign-button' 
                      data-itemid='" . $row['AssessmentItemID'] . "' 
                      data-assessmentid='" . $row['AssessmentID'] . "' 
                      data-licence='" . $licence . "' 
                      data-signcount='" . $row['RequiredSignCount'] . "' 
                      data-mdi='" . $mdi . "'>Sign</button>";
                  echo "</td>";
              }
          
              echo "</tr>";
          }
            
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "";
        }

        mysqli_free_result($result);
      }
     

  ?>
</div>

<?php
if ($allCompleted) {
?>
    <div id="signOffArea">
        <?php
          if (isset($_GET['taskid'])) {
            $sqlAssessmentID = "SELECT AssessmentID FROM taskAssessment WHERE Taskid = '" . $_GET['taskid'] . "'";
            $resultAssessmentID = mysqli_query($conn, $sqlAssessmentID);

            if ($resultAssessmentID && mysqli_num_rows($resultAssessmentID) > 0) {
                $rowAssessmentID = mysqli_fetch_assoc($resultAssessmentID);
                $assessmentID = $rowAssessmentID['AssessmentID'];
            }

            // 查询Tasksignoff表来获取InstructorSignature、StudentSignature和DATE的值
            $query = "SELECT InstructorSignature, StudentSignature, DATE FROM Tasksignoff WHERE taskid = '" . $_GET['taskid'] . "'";
            $signoffResult = mysqli_query($conn, $query);

            $instructorSign = '';
            $studentSign = 'Awaiting Learner\'s Signature';
            $dateSign = 'Awaiting Learner\'s Signature';

            if ($signoffResult && mysqli_num_rows($signoffResult) > 0) {
                $signoffData = mysqli_fetch_assoc($signoffResult);
                $instructorSign = $signoffData['InstructorSignature'];
                if (!empty($signoffData['StudentSignature'])) {
                    $studentSign = $signoffData['StudentSignature'];
                }
                if (!empty($signoffData['DATE'])) {
                    $dateSign = $signoffData['DATE'];
                }
            }

            // 基于给定的taskid查询taskAssessmentItem表
            $sql = "SELECT * FROM taskAssessmentItem WHERE Taskid = '" . $_GET['taskid'] . "'";
            $result = mysqli_query($conn, $sql);
        
            if ($result && mysqli_num_rows($result) > 0) {
        
                echo "<h3>TASK " . $_GET['taskid'] . " Sign off</h3>";
                echo "<table>";
                echo "<tr><td>Driver's Name:</td><td>$firstname $surname</td></tr>";
                echo "<tr><td>Licence Number:</td><td>$licence</td></tr>";
                echo "<tr><td>Learner Driver's Signature:</td><td>$studentSign</td></tr>";
                echo "<tr><td>Authorised Examiner's Name:</td><td>$userfirstname $usersurname</td></tr>";
                echo "<tr><td>Authorised Examiner's Signature:</td>";
                if (empty($instructorSign)) {
                    echo "<td><button class='examinersignoff' id='examinersignoff' 
                            data-licence='$licence' 
                            data-assessmentid='$assessmentID' 
                            data-taskid='".$_GET['taskid']."'
                            data-mdi='$mdi' 
                            data-instructor='".$userfirstname." ".$usersurname."'>Sign</button></td>";
                } else {
                    echo "<td>$instructorSign</td>";
                }
                
                echo "</tr>";
                echo "<tr><td>MDI No.:</td><td>$mdi</td></tr>";
                echo "<tr><td>Date:</td><td>$dateSign</td></tr>";
                echo "</table>";

                if (!empty($signoffData['StudentSignature'])) {
                echo "<tr><td TASK " . $_GET['taskid'] . " COMPLETED! </td></tr>";
              }
            }
        }
      }
        ?>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // 对于“增加”按钮
    var increaseButtons = document.querySelectorAll('.increase-button');

    increaseButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var itemId = this.getAttribute('data-itemid');
            var assessmentId = this.getAttribute('data-assessmentid');
            var requiredCount = parseInt(this.getAttribute('data-requiredcount'), 10);
            
            var spanId = "count_" + itemId + "_" + assessmentId;
            var span = document.getElementById(spanId);
            var currentValue = parseInt(span.textContent, 10);

            // 显示减少钮
            document.querySelector('.decrease-button[data-itemid="' + itemId + '"][data-assessmentid="' + assessmentId + '"]').style.display = '';

            // 小于 requiredCount，那么增加
            if (currentValue < requiredCount) {
                currentValue += 1;
                span.textContent = currentValue;

                // 增加后的值等于 requiredCount，隐藏增加钮
                if (currentValue == requiredCount) {
                    this.style.display = 'none';
                    document.querySelector('.sign-button[data-itemid="' + itemId + '"][data-assessmentid="' + assessmentId + '"]').style.display = ''; 
                }
            }
        });
    });

    // 对于减按钮
    var decreaseButtons = document.querySelectorAll('.decrease-button');

    decreaseButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var itemId = this.getAttribute('data-itemid');
            var assessmentId = this.getAttribute('data-assessmentid');
            var requiredCount = parseInt(this.getAttribute('data-requiredcount'), 10);
            
            var spanId = "count_" + itemId + "_" + assessmentId;
            var span = document.getElementById(spanId);
            var currentValue = parseInt(span.textContent, 10);

            // 显示增加钮
            document.querySelector('.increase-button[data-itemid="' + itemId + '"][data-assessmentid="' + assessmentId + '"]').style.display = '';

            //关闭sign钮
            document.querySelector('.sign-button[data-itemid="' + itemId + '"][data-assessmentid="' + assessmentId + '"]').style.display = 'none'; 


            if (currentValue > 0) {
                currentValue -= 1;
                span.textContent = currentValue;

                // 增加后的值等于 requiredCount，隐藏增加钮
                if (currentValue == 0) {
                    this.style.display = 'none'; // 隐藏增加钮
                }

            }

        });
    });

  // 对于“Sign”按钮
  var signButtons = document.querySelectorAll('.sign-button');

signButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var itemId = this.getAttribute('data-itemid');
        var assessmentId = this.getAttribute('data-assessmentid');
        var licence = this.getAttribute('data-licence');
        var signCount = this.getAttribute('data-signcount');
        var mdi = this.getAttribute('data-mdi');

        var formData = new FormData();
        formData.append('AssessmentItemID', itemId);
        formData.append('AssessmentID', assessmentId);
        formData.append('licence', licence);
        formData.append('SignCount', signCount);
        formData.append('mdi', mdi);

        fetch('update_itemrecord.php', {  
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



// sign off

var signoffButtons = document.querySelectorAll('.examinersignoff');

signoffButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var licence = this.getAttribute('data-licence');
        var assessmentID = this.getAttribute('data-assessmentid');
        var taskid = this.getAttribute('data-taskid');
        var mdi = this.getAttribute('data-mdi');
        var instructorSignature = this.getAttribute('data-instructor');

        var formData = new FormData();
        formData.append('licence', licence);
        formData.append('AssessmentID', assessmentID);
        formData.append('taskid', taskid);
        formData.append('mdi', mdi);
        formData.append('instructorSignature', instructorSignature);

        fetch('update_signoff.php', { 
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); 
            location.reload(); 
        });
    });
});
</script>