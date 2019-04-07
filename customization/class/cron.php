<?php
/**
 * CRON JOBS
 *
 * PHP version 7.1.2
 *
 * @category Null
 * @package  SOS_PMS_Customizations
 * @author   Japol <japol69@gmail.com>
 * @license  N/A 
 * @link     http://www.boltmedia.ca 
 */

require '../../../../../wp-load.php';


$cronPMS = new BoltPMS();
$cronPMS->pmsReminder();