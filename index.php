<?php

//connect to database
  $dbh = new PDO( "mysql:host=localhost;dbname=comp1006", "root", "" );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


  $search = isset($_GET['search']) ? $_GET['search'] : '';

  if ($search == '') {
    $sql = "SELECT * FROM artists";
    echo "Search query: empty";
  }
  else{
    $sql = "SELECT * FROM artists WHERE id = $search";
    echo "Search query: ".$search;
  }



  //prepare our sql
  //$artists = $dbh->query ( $sql );
  $sth = $dbh->prepare( $sql );
  $sth->execute();
  $artists = $sth->fetchAll();
  $row_count = $sth->rowCount();

  
  //close the DB connection
  $dbh = null;

?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Inventory Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <!-- This is a Bootstrap container. Get more info at http://getbootstrap.com/ -->
    <div class="container">
    	<header>
    		<h1 class="page-header"><a href="/inven/index.php">Inventory</a></h1>
        <form class="form-inline" action="/inven/index.php">
          <div class="form-group">
            <input class="form-control" type="number" name="search" placeholder="Search By ID">
          </div>
          <div class="form-group">
            <input class="form-control" type="submit" value="Submit">
          </div>
        </form>
    	</header>

      

    	<section>
    		<?php if ($row_count > 0): ?>
    			<table class="table">
    				<thead>
    					<tr>
                <td>ID</td>
    						<td>Brand</td>
    						<td>Model</td>
    					</tr>
    				</thead>

    				<tbody>
    					<?php foreach ($artists as $artist ): ?>
    						<tr>
                  <td><?= $artist['id'] ?></td>
    							<td><!--<a href="artist_songs.php?artist_id=<? $artist['id'] ?>">--><?= $artist['name'] ?><!--</a>--></td>
    							<td><!--<a href="<?= $artist['bio_link'] ?>" title="<?= $artist['name'] ?> Bio Link">--><?= $artist['bio_link'] ?></td>
    						</tr>
    					<?php endforeach ?>	    					
    				</tbody>
    			</table>
    		<?php else: ?>
    			<div class="alert alert_warning">
    			No information to display.
    			</div>
    		<?php endif ?>
    	</section>
      
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  
</html>

