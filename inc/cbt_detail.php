<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR cbt_detail" />
    <title>CBT</title>
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
              echo "<th><a href = cbt.php?studentL=",base64_encode($licence),"&unitid=",$row['id'],">",$row['unitNO'],"</a></th>";
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
              echo "<table id = 'task'>";
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
                echo "<th><a href = cbt.php?studentL=",base64_encode($licence),"&unitid=",$row['unitid'],"&taskid=",$row['id'],">",$row['taskNO'],"</a></th>";
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
                  echo "<th>SubTask</th>";
                  echo "<th>Description</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";  
              while($row = mysqli_fetch_assoc($result))
              {
                echo "<tr>";
                echo "<th><a href = cbt.php?studentL=",base64_encode($licence),"&unitid=",$_GET['unitid'],"&taskid=",$_GET['taskid'],"&subtaskid=",$row['id'],">",$row['subtaskNO'],"</a></th>";
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
                  echo "<th>item</th>";
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
                    echo "<th></th>";
                    echo "<th></th>";   
                    break;
                  case 1:
                    echo "<th>Y</th>";
                    echo "<th></th>";
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
                    echo "<th>item</th>";
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
                      echo "<th></th>";
                      echo "<th></th>";
                      break;
                    case 1:
                      echo "<th>Y</th>";
                      echo "<th></th>";
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
        //mysqli_close($conn);
      ?>
    </div>




  </body>
</html>