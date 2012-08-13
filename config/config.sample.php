<?php
/**
 * Main config file for digital strategy report generator
 * Copy this file to config.php and edit as needed for your installation
 */

//base dir for includes, leave at default for same directory as this file`
define( 'DGS_BASE_DIR', dirname( __FILE__ ) ); 

//directory where reports will reside afer generation, FALSE to delete after sending to user
define( 'DGS_REPORT_DIR', FALSE );

//base url for schema, change to false to use local information only
define( 'DGS_SCHEMA_BASE', 'https://raw.github.com/GSA/digital-strategy/1/' ); 

//TTL of disk / in-memory cache ( default is 1 hour )
define( 'DGS_TTL', 3600 ); 

//that's it!