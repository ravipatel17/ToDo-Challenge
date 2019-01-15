<?php

    // ---------------------------------------------------------------
    // Set connection parameters and create connection
    // ---------------------------------------------------------------
    $host = "127.0.0.1";
    $user = "root";
    $password = "root";
    $database = "ToDo";
    $cxn = mysqli_connect($host, $user, $password, $database);
      
    // Test which database operation to perform
    switch ($_POST["operation"])
    {
      
      // -------------------------------------------------------------
      // Add Sale
      // -------------------------------------------------------------
      case "add":                
        {        
          // Create and submit insert query
          $sql = "INSERT INTO list (entry) VALUES ('" . 
            $_POST["entry"] ."')";
          $result = mysqli_query($cxn, $sql);

          $sql = "Select MAX(id) from list;";
          $NewIDResult = mysqli_query($cxn, $sql);

          $NewID = mysqli_fetch_row($NewIDResult);
          
          // Test if entry added
          if($result == false)
            echo "Add operation FAILED.";
          else
            echo "Add operation successful. Entry added: ", $NewID[0], ".";
          break;

      }
      // -------------------------------------------------------------
      // Delete Entry
      // -------------------------------------------------------------
      case "delete":
        {
  
          // Create and submit delete query
          $sql = "DELETE FROM list WHERE id=" . $_POST["id"];
          $result = mysqli_query($cxn, $sql);

          // Test if query failed
          if($result == false)
            echo "Delete operation FAILED for ID: ", $_POST["id"], ".";
          else
            echo "Delete operation successful. ID of deleted record: ", $_POST["id"],
              ".";
           break; 
        }
      
      // -------------------------------------------------------------
      // List Entries
      // -------------------------------------------------------------
      case "list":
      {

        // Create and submit select query
        $sql = "SELECT * FROM list ORDER BY id;";
        $result = mysqli_query($cxn, $sql);
        
        // Test if query failed
        if($result == false)
          echo "List operation FAILED.";
        else
        {  
      $entries = $result;
      // Loop to print each row.
    while ($entries = mysqli_fetch_row($result)) 
    {


      echo "<tr>";
      echo "<td>", $entries[0], "</td>";
      echo "<td>", $entries[1], "</td>";
      echo "</tr>";
    }
            
    }
        break;
      }
      
      // -------------------------------------------------------------
      // Other Default Request
      // -------------------------------------------------------------
      default:
        echo "Error: unknown database request.";

    }

  ?>
