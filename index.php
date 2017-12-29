<?php

//connect to database
  $dbh = new PDO ( "mysql:host=us-cdbr-azure-southcentral-e.cloudapp.net; dbname=acsm_03a9a5b692a77f1", 'b81a903bbbb0b7', '606b3f2e' );
  $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


  $search = isset($_GET['search']) ? $_GET['search'] : '';

  if ($search == '') {
    $sql = "SELECT * FROM available";
    echo "Search query: empty";
  }
  else{
    $sql = "SELECT * FROM available WHERE model = '$search'";
    echo "Search query: ".$search;
  }

  $sql2 = "SELECT * FROM lastupdate";

  //prepare our sql
  //$artists = $dbh->query ( $sql );
  $sth = $dbh->prepare( $sql );
  $sth->execute();
  $available = $sth->fetchAll();
  $row_count = $sth->rowCount();

  $sth2 = $dbh->prepare( $sql2 );
  $sth2->execute();
  $lastupdate = $sth2->fetchAll();
  $row_count2 = $sth2->rowCount();



  
  //close the DB connection
  $dbh = null;

?>
<!DOCTYPE HTML>
<html lang="en">

  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
    <title>Inventory Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-md-3">
        <h1 class="page-header"><a href="/">Inventory</a></h1>
      </div>
      <div class="col-md-6 md-auto d-flex justify-content-end">
          <form class="form-inline" action="/">
          <div class="form-group mr-3">
              <input class="form-control" name="search" placeholder="Search By Model">
              </div>
              <div class="form-group">
              <input class="form-control" type="submit" value="Submit">
              </div>
          </form>
      </div>
      <div class="col-md-3 ">
        <a href="/"><button class="btn btn-dark btn-block">Show All</button></a>
        </div>
    </div>

      
  	<div class="row">
    <div class="col-md-9">
  		<?php if ($row_count > 0): ?>
  			<table class="table table-striped">
  				<thead>
  					<tr>
              <td>Model</td>
  						<td>Brand</td>
  						<td>Available</td>
              <td>AB</td>
              <td>MA</td>
              <td>MK</td>
              <td>RF</td>
              <td>WD</td>
  					</tr>
  				</thead>

  				<tbody>
  					<?php foreach ($available as $avail ): ?>
  						<tr>
                <td><?= $avail['model'] ?></td>
  							<td><?= $avail['brand'] ?></td>
  							<td><?= $avail['available'] ?></td>
                <td><?= $avail['ab'] ?></td>
                <td><?= $avail['ma'] ?></td>
                <td><?= $avail['mk'] ?></td>
                <td><?= $avail['rf'] ?></td>
                <td><?= $avail['wd'] ?></td>
  						</tr>
  					<?php endforeach ?>	    					
  				</tbody>
  			</table>
  		<?php else: ?>
  			<div class="alert alert_warning">
  			No information to display.
  			</div>
  		<?php endif ?>
      </div>

      <div class="col-md-3">
      <?php if ($row_count2 > 0): ?>
        <table class="table table-dark table-bordered">
          <thead>
            <tr>
              <td>Store</td>
              <td>Updated</td>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($lastupdate as $last ): ?>
              <tr>
                <td><?= $last['store'] ?></td>
                <td><?= $last['time'] ?></td>
              </tr>
            <?php endforeach ?>               
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert_warning">
        No information to display.
        </div>
      <?php endif ?>
      </div>
  	</div>
      
  </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
  
</html>
