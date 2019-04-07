<?php global $shortname; ?>

<?php
/* Template Name: Vessel search */
get_header(); ?>
<?php

//ini_set("display_errors", "1");
//error_reporting(E_ALL);
  // These were variables declared in original ASP script.
  $VesselName = '';
  $VesselType = '';
  $CauseofAccident = '';
  $AreaofAccident = '';
  $YearofAccidentOnAfter = '';
  $YearofAccidentOnBefore = '';
  $LengthGreaterEqual = '';
  $LengthLessEqual = '';
  $re = '';
  $results = '';
  $regexClean = '';
  $part = '';
  $parts = '';
  $fields = array(); //was dim Fields(6)
  $startingRow = '0';
  $endingRow = '25'; // default to 25 results
  $currentRow = '';
  $rowsPerPage = '';
  $disablePrevious = 'disabled';
  $disableNext = 'disabled';

  // Instantiate variables for sql output.
  $strOutput = '';
  $result = NULL;
  $counter = 0;
?>


<?php

//if (isset($_POST) && isset($_POST['submit'])):

  // Pre-populate with searched for terms and data.
  $VesselName = $_POST['VesselName'];
  $VesselType = $_POST['VesselType'];
  $CauseofAccident = $_POST['CauseofAccident'];
  $AreaofAccident = $_POST['AreaofAccident'];
  $YearofAccidentOnAfter = $_POST['YearofAccidentOnAfter'];
  $YearofAccidentOnBefore = $_POST['YearofAccidentOnBefore'];
  $LengthGreaterEqual = $_POST['LengthGreaterEqual'];
  $LengthLessEqual = $_POST['LengthLessEqual'];


  //$link = mysql_connect('localhost', 'sos', 'Scr9d7$9');

  //if (!$link):
 // 	echo 'test';
    //die("MySQL could not connect!! " . mysql_error());
 // endif;
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Oh no! A connect_errno exists so the connection attempt failed!
if ($mysqli->connect_errno) {
    // The connection failed. What do you want to do? 
    // You could contact yourself (email?), log the error, show a nice page, etc.
    // You do not want to reveal sensitive information

    // Let's try this:
    echo "Sorry, this website is experiencing problems.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    
    // You might want to show them something nice, but we will simply exit
    exit;
}
  //mysql_select_db('boltmedia_sos',$link);

   $qry = "SELECT * FROM shipwrecks WHERE VesselName IS NOT NULL ";

    // Check for vessel name.
    if (isset($_POST['VesselName'])):
      $qry .= " AND LOWER(VesselName) LIKE '%" . strtolower($_POST['VesselName']) . "%'";
    endif;

    // Check for vessel type.
    if (isset($_POST['VesselType'])):
      $qry .= " AND LOWER(VesselType) LIKE '%" . strtolower($_POST['VesselType']) . "%'";
    endif;

    // Check for accident cause.
    if (isset($_POST['CauseofAccident'])):
      $qry .= " AND LOWER(CauseofAccident) LIKE '%" . strtolower($_POST['CauseofAccident']) . "%'";
    endif;

    // Check for accident area.
    if (isset($_POST['AreaofAccident'])):
      $qry .= " AND LOWER(AreaofAccident) LIKE '%" . strtolower($_POST['AreaofAccident']) . "%'";
    endif;

    // Check for start year
    if (!empty($_POST['YearofAccidentOnAfter'])):
      $qry .= " AND YearofAccident >= '" . strtolower($_POST['YearofAccidentOnAfter']) . "'";
    endif;

    // Check for end year
    if (!empty($_POST['YearofAccidentOnBefore'])):
      $qry .= " AND YearofAccident <= '" . strtolower($_POST['YearofAccidentOnBefore']) . "'";
    endif;

    // Check for min length
    if (!empty($_POST['LengthGreaterEqual'])):
      $qry .= " AND Length >= '" . strtolower($_POST['LengthGreaterEqual']) . "'";
    endif;

    // Check for max length
    if (!empty($_POST['LengthLessEqual'])):
      $qry .= " AND Length <= '" . strtolower($_POST['LengthLessEqual']) . "'";
    endif;


  // Limit query. Returning 26000 results is not cool.
  if ($_POST['submit'] == 'Next Page') {
    $startingRow = (int) $_POST['endingRow'];
    $endingRow = $startingRow + $_POST['rowsPerPage'];
  }
  elseif ($_POST['submit'] == 'Previous Page') {
    $startingRow = (((int) $_POST['endingRow'] - ($_POST['rowsPerPage'] * 2)) >= 0) ? (int) $_POST['endingRow'] - ($_POST['rowsPerPage'] * 2) : '0';
    $endingRow = $startingRow + $_POST['rowsPerPage'];
  }
  else { // Start search button.
    $startingRow = '0';
    $endingRow = $_POST['rowsPerPage'];
  }
  if($endingRow=='' || $endingRow=='0'){
  	$endingRow='25';
  }
  // Set limit because 26000 plus records in table.
   $qry_limit = sprintf(" LIMIT %s, %s", $startingRow, $endingRow);


  // Here for debugging.
//   print '<p>' . $qry . $qry_limit . '</p>';

  $result = mysqli_query($mysqli,$qry . $qry_limit);
  $result_nums = mysqli_query($mysqli,$qry . $qry_limit);

  // Count results.
  $counter = 0;
  while ($row_nums = mysqli_fetch_array($result_nums)) {
    $counter++;
  }

  // Enable previous and next buttons.
  if ($counter > 0):
    $disablePrevious = '';
    $disableNext = '';
  endif;

  // Check if we do not have enough results to do previous page.
  if ((int) $startingRow <= 0):
    $disablePrevious = ' disabled';
  endif;

  // Check if we do not have enough results to do previous page.
  if ($counter < (int) $_POST['rowsPerPage']):
    $disableNext = ' disabled';
  endif;

  while ($row = mysqli_fetch_array($result)) {
    $strOutput .= sprintf("<tr><td><a href='".site_url()."/vessel_detail?RecordId=%s'>Details</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row['RecordId'], $row['VesselName'], $row['VesselType'], $row['CauseofAccident'], $row['AreaofAccident'], $row['YearofAccident'], $row['Length'], $row['YearBuilt']);
  }

//endif;
?>
<div class="page_header">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1 class="text-capitalize">Marine Heritage Database</h1>
				</div>
		
				<div class="col-sm-6">
					<div class="bcrumbs">
						<div class="container">
							<ul>
								<li><a href="#">Home</a></li>
								<li><span>Search</span></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
	
	<div class="search-listing">
		<div class="container">
				
			<div class="advanced-search">
				<h5>Search</h5>
				
				<form action="" method="post" name="Search_Form">
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="VesselName" value="<?php echo $VesselName; ?>" placeholder="Vessel Name">
						</div>
					
						<div class="col-sm-6">
							<input type="text" name="VesselType" value="<?php echo $VesselType; ?>"  placeholder="Vessel Type">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="CauseofAccident" value="<?php echo $CauseofAccident; ?>" placeholder="Cause of Accident">
						</div>
					
						<div class="col-sm-6">
							<input type="text" name="AreaofAccident" value="<?php echo $AreaofAccident; ?>" placeholder="Area of Accident">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">					
							<div class="row">
								<div class="col-sm-4">
									<label>Year of Accident</label>
								</div>
							
								<div class="col-sm-4">
									<input type="text" name="YearofAccidentOnAfter" value="<?php echo $YearofAccidentOnAfter; ?>" placeholder="Lower Limit">
								</div>
							
								<div class="col-sm-4">
									<input type="text" name="YearofAccidentOnBefore" value="<?php echo $YearofAccidentOnBefore; ?>" placeholder="Upper Limit">
								</div>
							</div>
						</div>
						
						<div class="col-sm-6">					
							<div class="row">
								<div class="col-sm-4">
									<label>Length(Feet)</label>
								</div>
							
								<div class="col-sm-4">
									<input type="text" size="4" maxlength="4" name="LengthGreaterEqual" value="<?php echo $LengthGreaterEqual; ?>" placeholder="Lower Limit">
								</div>
							
								<div class="col-sm-4">
									<input type="text"  size="4" maxlength="4" name="LengthLessEqual" value="<?php echo $LengthLessEqual; ?>" placeholder="Upper Limit">
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-6">
									<label>Results to Display Per Page</label>
								</div>
							
								<div class="col-sm-6">
									<select  name="rowsPerPage">
										<option value="25" <?php echo $selected = (isset($_POST['rowsPerPage']) && (int) $_POST['rowsPerPage'] == 25) ? 'selected' : '';?>>25</option>
										<option value="50" <?php echo $selected = (isset($_POST['rowsPerPage']) && (int) $_POST['rowsPerPage'] == 50) ? 'selected' : '';?>>50</option>
										<option value="75" <?php echo $selected = (isset($_POST['rowsPerPage']) && (int) $_POST['rowsPerPage'] == 75) ? 'selected' : '';?>>75</option>
										<option value="100" <?php echo $selected = (isset($_POST['rowsPerPage']) && (int) $_POST['rowsPerPage'] == 100) ? 'selected' : '';?>>100	</option>
									</select>
								</div>
							</div>
						</div>
					
						<div class="col-sm-6">
							<button type="submit" name="submit"><i class="fa fa-search"></i> Start Search</button>
						</div>
					</div>
				</form>
			</div>
			
			<div class="search-results">
				
				
                <?php if ($counter > 0) { ?>
                <h1><b><?php echo $counter; ?> Search Results</b></h1>
					<div class="table-responsive">					
						<table class="table data-table table-striped">
							<thead>
								<tr>
									<th>Link to Details</th>
									<th>Vessel Name</th>
									<th>Vessel Type</th>
									<th>Cause of Accident</th>
									<th>Area of Accident</th>
									<th>Year of Accident</th>
									<th>Length</th>
									<th>Year Built</th>
									
								</tr>
							</thead>
							<tbody>

							<?php echo $strOutput; ?>
							</tbody>
						</table>
					</div>
					

					<table>
					  <tr>
					  <td><a href="#top">Top of Page</a></td>
					  <?php /*
					  <td><input type="submit" name="submit" value="Previous Page" <?php print $disablePrevious; ?> /></td>
					  <td><input type="submit" name="submit" value="Next Page" <?php print $disableNext; ?> /></td>
					  */ ?>
					  </tr>
					  </table>


				<?php }
				      else {
				?>
				<h2>Successful search results will appear here</h2>

				<?php
				      }
				 ?>					
			
			</div>
			
				
						

		</div>
	</div>
	
<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
