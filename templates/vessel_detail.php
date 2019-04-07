<?php global $shortname; ?>

<?php
/* Template Name: Vessel detail */
get_header(); ?>


<?php
if (isset($_GET) && isset($_GET['RecordId']) && (int) $_GET['RecordId'] > 0 && (int) $_GET['RecordId'] < 26519) {

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
$qryDataSources = "SELECT * FROM shipwrecks_datasources ORDER BY id";
  $result_data = mysqli_query($mysqli,$qryDataSources);


  $arrDataSources = array();
  while ($row = mysqli_fetch_array($result_data)) {
    $arrDataSources[$row['id']] = $row['detail'];
  }

   $qry = "SELECT * FROM shipwrecks WHERE RecordId = " . $_GET['RecordId'] . " LIMIT 0,1";

  $result = mysqli_query($mysqli,$qry);

  while ($row = mysqli_fetch_array($result)) {
    //$strOutput .= sprintf("<tr><td><a href='vessel_detail.php?RecordId=%s'>Details</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row['RecordId'], $row['VesselName'], $row['VesselType'], $row['CauseofAccident'], $row['AreaofAccident'], $row['YearofAccident'], $row['Length'], $row['YearBuilt']);
		$AdditionalReferences = $row['AdditionalReferences'];
		$AreaofAccident = $row['AreaofAccident'];
		$Beam = $row['Beam'];
		$BoilerMaker = $row['BoilerMaker'];
		$BoilerMakerAddress = $row['BoilerMakerAddress'];
		$BoilerType = $row['BoilerType'];
		$BuiltBy = $row['BuiltBy'];
		$Captain = $row['Captain'];
		$CaptainAddress = $row['CaptainAddress'];
		$CasualtyCargo = $row['CasualtyCargo'];
		$CauseofAccident = $row['CauseofAccident'];
		$CompartmentDimensions = $row['CompartmentDimensions'];
		$Crew = $row['Crew'];
		$DataSource = $row['DataSource'];
		$DayofAccident = $row['DayofAccident'];
		$Draft = $row['Draft'];
		$EngineDimension = $row['EngineDimension'];
		$EngineMaker = $row['EngineMaker'];
		$EngineMakerAddress = $row['EngineMakerAddress'];
		$EngineType = $row['EngineType'];
		$Fuel = $row['Fuel'];
		$Function = $row['Function'];
		$GrossTonnage = $row['GrossTonnage'];
		$HatchDimensions = $row['HatchDimensions'];
		$HeadedFor = $row['HeadedFor'];
		$HIST_IMAGY = $row['HIST_IMAGY'];
		$HomePort = $row['HomePort'];
		$HorsePower = $row['HorsePower'];
		$HullMaterial = $row['HullMaterial'];
		$HullType = $row['HullType'];
		$ID = $row['ID'];
		$Lake_Region = $row['Lake_Region'];
		$Length = $row['Length'];
		$LivesLost = $row['LivesLost'];
		$Loss = $row['Loss'];
		$Masts = $row['Masts'];
		$MonthofAccident = $row['MonthofAccident'];
		$Nationality = $row['Nationality'];
		$NetTonnage = $row['NetTonnage'];
		$NoofEngines = $row['NoofEngines'];
		$NumberofBoilers = $row['NumberofBoilers'];
		$NumberofCompartments = $row['NumberofCompartments'];
		$NumberofDecks = $row['NumberofDecks'];
		$NumberofHatches = $row['NumberofHatches'];
		$OtherName = $row['OtherName'];
		$OtherSources = $row['OtherSources'];
		$Owner = $row['Owner'];
		$OwnerAddress = $row['OwnerAddress'];
		$PlaceBuilt = $row['PlaceBuilt'];
		$PortofDeparture = $row['PortofDeparture'];
		$PortofRegistry = $row['PortofRegistry'];
		$ProbableWreck = $row['ProbableWreck'];
		$PropertyDamage = $row['PropertyDamage'];
		$Propulsion = $row['Propulsion'];
		$RebuiltBy = $row['RebuiltBy'];
		$RebuiltDate = $row['RebuiltDate'];
		$RebuiltWhere = $row['RebuiltWhere'];
		$RecordId = $row['RecordId'];
		$Recovered = $row['Recovered'];
		$ReferenceNumber = $row['ReferenceNumber'];
		$RegistrationNumber = $row['RegistrationNumber'];
		$Remarks = $row['Remarks'];
		$Researcher = $row['Researcher'];
		$Rig = $row['Rig'];
		$VesselName = $row['VesselName'];
		$VesselType = $row['VesselType'];
		$WreckFound = $row['WreckFound'];
		$YearBuilt = $row['YearBuilt'];
		$YearofAccident = $row['YearofAccident'];
  }
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
								<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
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
					
			
			
<div class="table-responsive">          
            <table class="table data-table table-striped">
			
				    <thead><tr><th colspan="2" align="center">Registry and Rig Information</th></tr></thead>

				    <tr><td>Vessel Name</td><td><?php print $VesselName; ?></td></tr>
				    <tr><td>Nationality</td><td><?php print $Nationality; ?></td></tr>   
				    <tr><td>Registration Number</td><td><?php print $RegistrationNumber; ?></td></tr>
				    <tr><td>Port of Registry</td><td><?php print $PortofRegistry; ?></td></tr>
				    <tr><td>Home Port</td><td><?php print $HomePort; ?></td></tr>    
				    <tr><td>Vessel Type</td><td><?php print $VesselType; ?></td></tr>
				    <tr><td>Rig</td><td><?php print $Rig; ?></td></tr>
				    <tr><td>Other Name</td><td><?php print $OtherName; ?></td></tr>


				    <thead><tr><th colspan="2" align="center">Dimensions and Tonnage</th></tr></thead>

				    <tr><td>Length</td><td><?php print $Length;?></td></tr>
				    <tr><td>Gross Tonnage</td><td><?php print $GrossTonnage ;?></td></tr>
				    <tr><td>Beam</td><td><?php print $Beam ;?></td></tr>
				    <tr><td>Net Tonnage</td><td><?php print $NetTonnage ;?></td></tr>
				    <tr><td>Draft</td><td><?php print $Draft ;?></td></tr>

				    <tr><td>Hull Material</td><td><?php print $HullMaterial ;?></td></tr>
				    <tr><td>Masts</td><td><?php print $Masts ;?></td></tr>
				    <tr><td>Hull Type</td><td><?php print $HullType ;?></td></tr>
				    


				    <thead><tr><th colspan="2" align="center">Accident</th></tr></thead>
				    <tr><td>Cause of Accident</td><td><?php print $CauseofAccident ;?></td></tr>
				    <tr><td>Area of Accident</td><td><?php print $AreaofAccident ;?></td></tr>
				    <tr><td>Day of Accident</td><td><?php print $DayofAccident ;?></td></tr>

				    <tr><td>Month of Accident</td><td><?php print $MonthofAccident ;?></td></tr>
				    <tr><td>Year of Accident</td><td><?php print $YearofAccident ;?></td></tr>
				    <tr><td>Lives Lost</td><td><?php print $LivesLost;?></td></tr>
				    <tr><td>Property Damage</td><td><?php print $PropertyDamage;?></td></tr>

				    <tr><td>Recovered</td><td><?php print $Recovered;?></td></tr>
				    <tr><td>Lake/Region</td><td><?php print $Lake_Region;?></td></tr>
				    <tr><td>Casualty Cargo</td><td><?php print $CasualtyCargo;?></td></tr>
				    <tr><td>Loss</td><td><?php print $Loss;?></td></tr>

				    <tr><td>Wreck Found</td><td><?php print $WreckFound;?></td></tr>
				    <tr><td>Probable Wreck</td><td><?php print $ProbableWreck;?></td></tr>
				    <tr><td>Headed For</td><td><?php print $HeadedFor;?></td></tr>


				    <thead><tr><th colspan="2" align="center">Builder Information</th></tr></thead>
				    <tr><td>Year Built</td><td><?php print $YearBuilt;?></td></tr>
				    <tr><td>Place Built</td><td><?php print $PlaceBuilt;?></td></tr>
				    <tr><td>Built By</td><td><?php print $BuiltBy;?></td></tr>



				    <thead><tr><th colspan="2" align="center">Rebuilt Information</th></tr></thead>
				    <tr><td>Rebuilt Date</td><td><?php print $RebuiltDate;?></td></tr>
				    <tr><td>Rebuilt Where</td><td><?php print $RebuiltWhere;?></td></tr>

				    <tr><td>Rebuilt By</td><td><?php print $RebuiltBy;?></td></tr>


				    <thead><tr><th colspan="2" align="center">Miscellaneous Data</th></tr></thead>
				    <tr><td>ID</td><td><?php print $ID;?></td></tr>

				    <tr><td>Researcher</td><td><?php print $Researcher;?></td></tr>

				    <tr><td>Owner</td><td><?php print $Owner;?></td></tr>
				    <tr><td>Captain</td><td><?php print $Captain;?></td></tr>
				    <tr><td>Captain Address</td><td><?php print $CaptainAddress;?></td></tr>

				    <tr><td>Crew</td><td><?php print $Crew;?></td></tr>
				    <tr><td>Function</td><td><?php print $Function;?></td></tr>
				    <tr><td>Propulsion</td><td><?php print $Propulsion;?></td></tr>
				    <tr><td>No of Engines</td><td><?php print $NoofEngines;?></td></tr>
				    <tr><td>Engine Type</td><td><?php print $EngineType;?></td></tr>

				    <tr><td>Engine Maker</td><td><?php print $EngineMaker;?></td></tr>
				    <tr><td>Engine Maker Address</td><td><?php print $EngineMakerAddress;?></td></tr>
				    <tr><td>Engine Dimension</td><td><?php print $EngineDimension;?></td></tr>
				    <tr><td>Horse Power</td><td><?php print $HorsePower;?></td></tr>
				    <tr><td>Number of Boilers</td><td><?php print $NumberofBoilers;?></td></tr>

				    <tr><td>Boiler Type</td><td><?php print $BoilerType;?></td></tr>
				    <tr><td>Boiler Maker</td><td><?php print $BoilerMaker;?></td></tr>
				    <tr><td>Boiler Maker Address</td><td><?php print $BoilerMakerAddress;?></td></tr>
				    <tr><td>Number of Compartments</td><td><?php print $NumberofCompartments;?></td></tr>
				    <tr><td>Compartment Dimensions</td><td><?php print $CompartmentDimensions;?></td></tr>

				    <tr><td>Number of Hatches</td><td><?php print $NumberofHatches;?></td></tr>
				    <tr><td>Hatch Dimensions</td><td><?php print $HatchDimensions;?></td></tr>
				    <tr><td>Number of Decks</td><td><?php print $NumberofDecks;?></td></tr>
				    <tr><td>Historical Imagery</td><td><?php print $HIST_IMAGY;?></td></tr>
				    <tr><td>Reference Number</td><td><?php print $ReferenceNumber;?></td></tr>

				    <tr><td>Additional References</td><td><?php print $AdditionalReferences;?></td></tr>
				    <tr><td>Other Sources</td><td><?php print $OtherSources;?></td></tr>
				    <tr><td>Remarks</td><td><?php print $Remarks;?></td></tr>
				    <tr><td>Data Source</td><td><?php print $arrDataSources[$DataSource];?></td></tr>

				    <tr><td>Record Id</td><td><?php print $RecordId;?></td></tr>
				</table>
			</div>
				<?php
				  if ($RecordId == '26518') {
				    $nextVesselID = 1;
				  }
				  else {
				    $nextVesselID = $RecordId + 1;
				  }
				?>

				<p><a title="Next vessel" href="?RecordId=<?php print $nextVesselID;?>" class="bttn-inline">Next vessel</a></p>
				<p><a title="Search Page" href="<?php echo site_url(); ?>/resources/marine-heritage-database/search" class="bttn-inline">Search Page</a></p>
				</ul>

				<?php
				}
				else {
				?>

				<h2>Oops, we can't find what you're looking for</h2>

				<p>Have you been mucking about with the RecordId parameter in the URL? This page will return vessel information only if the RecordId can be found in the Marine Heritage Database.</p>

				<?php
				}
				?>
				
						

		</div>
	</div>
	
<?php include( get_template_directory() . '/widgets/cta.php'); ?>

<?php get_footer(); ?>
