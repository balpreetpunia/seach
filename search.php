<?php

$db = $_SERVER["DOCUMENT_ROOT"] ."/access/Combined_Inventory.accdb";
  if (!file_exists($db))
  {
          die("No database file.");
  }
  
	if (isset($_GET['term'])){
	    $return_arr = array();

	    try {
	        $conn = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=$db; Uid=; Pwd=;");
	        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        
	        $stmt = $conn->prepare('SELECT Model FROM Available_Stock WHERE Model LIKE :term');
	        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
	        
	        while($row = $stmt->fetch()) {
	            $return_arr[] =  $row['Model'];
	        }

	    } catch(PDOException $e) {
	        echo 'ERROR: ' . $e->getMessage();
	    }


	    /* Toss back results as json encoded array. */
	    echo json_encode($return_arr);
	}

?>