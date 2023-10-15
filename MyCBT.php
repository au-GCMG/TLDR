<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR student/MyCBT" />
    <link rel = "stylesheet", type="text/css", href="styles/student.css">
    <script src="scripts/studentMenu.js" defer></script>
    <title>MyCBT</title>
  </head>
  <body>
    <?php
    //js function that homework signed by student
    define("DB_HOST1", "localhost");
    define("DB_NAME1", "tldr");
    define("DB_USER1", "dbadmin");
    define("DB_PASS1", "");    
    function Iscompleted($itemid, $studentl)
    {
      //count the number of signature
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
    //user's information who login----Instructor
        session_start();
        $email = $_SESSION['email'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        $licence = "";
        $firstname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $licence = $row['licence'];
            $firstname = $row['firstname']; 
            echo "<h2>Welcome $firstname ($licence)</h2>";          
            require_once "inc/menu.inc.php";
          }
        }
        mysqli_free_result($result);       
    ?>
    
    <div id = "unitArea">
      <?php
      //Units of CBT
         $sql = "SELECT * FROM sys_unit";
         $result = mysqli_query($conn, $sql);
         if($result)
         {
          if(mysqli_num_rows($result) > 0)
          {
            echo "<table id = 'unit'>";
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
              //sent the unitid in the URL
              echo "<th><a href = MyCBT.php?unitid=",$row['id'],">",$row['unitNO'],"</a></th>";
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
      //Task of CBT
        if(isset($_GET['unitid']))
        {          
          //According to the variable which collect from the URL to search the task
          $sql = "SELECT * FROM sys_task where unitid ='".$_GET['unitid']."'";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            if(mysqli_num_rows($result) > 0)
            {
              echo "<table id = 'task'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th>Task(Unit",$_GET['unitid'],")</th>";
                  echo "<th>Description</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";  
              while($row = mysqli_fetch_assoc($result))
              {
                echo "<tr>";
                //send the taskid in the URL
                echo "<th><a href = MyCBT.php?unitid=",$row['unitid'],"&taskid=",$row['id'],">",$row['taskNO'],"</a></th>";
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
    <div id = "subtaskArea">
    <?php
        if(isset($_GET['taskid']))
        {          
          $sql = "SELECT * FROM sys_subtask where taskid ='".$_GET['taskid']."'";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            if(mysqli_num_rows($result) > 0)
            {
              echo "<table id = 'subtask'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th>SubTask(Task",$_GET['taskid'],")</th>";
                  echo "<th>Description</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";  
              while($row = mysqli_fetch_assoc($result))
              {
                echo "<tr>";
                //send the subtaskid in the URL if the task has subtask.
                echo "<th><a href = MyCBT.php?unitid=",$_GET['unitid'],"&taskid=",$_GET['taskid'],"&subtaskid=",$row['id'],">",$row['subtaskNO'],"</a></th>";
                echo "<th>",$row['subtaskname'],"</th>";
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


    <div id = "itemArea">
      <?php
        if(isset($_GET['subtaskid']))
        {   
          $sql = "SELECT * FROM sys_item where taskid = '".$_GET['taskid']."' and subtaskid = '".$_GET['subtaskid']."'";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            if(mysqli_num_rows($result) > 0)
            {
              echo "<table id = 'item'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th>item(subTask",$_GET['subtaskid'],")</th>";
                  echo "<th>Description</th>";               
                  echo "<th colspan='2'>Homework</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";  
              while($row = mysqli_fetch_assoc($result))
              {
                echo "<tr>";
                echo "<th>",$row['itemNO'],"</th>";
                echo "<th>",$row['description'],"</th>";
                switch (Iscompleted($row['id'], $licence))
                {
                  case 0:
                    //link to signature's homepage
                    echo "<th><a href = 'inc/homework_sign.php?unitid=".$_GET['unitid']."&taskid=".$_GET['taskid']."&subtaskid=".$_GET['subtaskid']."&itemid=".$row['id']."&sign=2&l=".base64_encode($licence)."'>Sign</a></th>";
                    echo "<th><a href = 'inc/homework_sign.php?unitid=".$_GET['unitid']."&taskid=".$_GET['taskid']."&subtaskid=".$_GET['subtaskid']."&itemid=".$row['id']."&sign=2&l=".base64_encode($licence)."'>Sign</a></th>";   
                    break;
                  case 1:
                    echo "<th>Y</th>";
                    echo "<th><a href = 'inc/homework_sign.php?unitid=".$_GET['unitid']."&taskid=".$_GET['taskid']."&subtaskid=".$_GET['subtaskid']."&itemid=".$row['id']."&sign=1&l=".base64_encode($licence)."'>Sign</a></th>";
                    break;
                  case 2:
                    echo "<th>Y</th>";
                    echo "<th>Y</th>";
                    break;
                }
                echo "</tr>";
              }
            }
            echo "</tbody>";
            echo "</table>";
          }
          mysqli_free_result($result);
        }
        else//no subtask in url
        {
          if(isset($_GET['taskid']) )
          {
            $sql = "SELECT * FROM sys_item where taskid = '".$_GET['taskid']."' and ISNULL(subtaskid)";

            $result = mysqli_query($conn, $sql);
            if($result)
            {
              if(mysqli_num_rows($result) > 0)
              {
                echo "<table id = 'item'>";
                echo "<thead>";
                  echo "<tr>";
                    echo "<th>item(Task",$_GET['taskid'],")</th>";
                    echo "<th>Description</th>";
                    echo "<th colspan='2'>Homework</th>";
                  echo "</tr>";
                echo "</thead>";
                echo "<tbody>";  
                while($row = mysqli_fetch_assoc($result))
                {
                  echo "<tr>";
                  echo "<th>",$row['itemNO'],"</th>";
                  echo "<th>",$row['description'],"</th>";
                  switch (Iscompleted($row['id'], $licence))
                  {
                    case 0:
                      echo "<th><a href = 'inc/homework_sign.php?unitid=".$_GET['unitid']."&taskid=".$_GET['taskid']."&itemid=".$row['id']."&sign=2&l=".base64_encode($licence)."'>Sign</a></th>";
                      echo "<th><a href = 'inc/homework_sign.php?unitid=".$_GET['unitid']."&taskid=".$_GET['taskid']."&itemid=".$row['id']."&sign=2&l=".base64_encode($licence)."'>Sign</a></th>";
                      break;
                    case 1:
                      echo "<th>Y</th>";
                      echo "<th><a href = 'inc/homework_sign.php?unitid=".$_GET['unitid']."&taskid=".$_GET['taskid']."&itemid=".$row['id']."&sign=1&l=".base64_encode($licence)."'>Sign</a></th>";
                      break;
                    case 2:
                      echo "<th>Y</th>";
                      echo "<th>Y</th>";
                      break;
                  }
                  echo "</tr>";
                }
              }
              echo "</tbody>";
              echo "</table>";
            }
            mysqli_free_result($result);
          }          
        }
          
        //mysqli_free_result($result);
        // }
        mysqli_close($conn);
      ?>
    </div>
  </body>
</html>