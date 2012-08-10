<?php
/**
 * Recieves the form submission and generates the various response files
 *
 */

require_once DGS_BASE_DIR . '/load.php';

//strip all HTML from input
array_walk_recursive( $_POST, create_function( '&$val, $index', '$val=strip_tags( $val );' ) );

//set report headers
$report = (object) array(
	'agency' => $_POST['agency'],
	'generated' => date( 'Y-m-d H:i:s' ),
	'items' => $dgs_items,
);

//merge POST data into report array
foreach ( $dgs_items as &$item ) {
	foreach ( $item->fields as &$field ) {

		if ( !isset( $_POST[ $field->name ] ) || empty( $_POST[ $field->name ] ) )
			continue;

		//single value, just store as value
		if ( !$item->multiple && !is_array( $_POST[ $field->name] ) ) {

			$field->value = $_POST[ $field->name ];
			continue;

		}

		//multiple possible values
		$field->value = array(); $i = 0;
		while ( isset( $_POST[ $field->name][$i] ) ) {

			//don't store empty values
			if ( empty( $_POST[ $field->name][$i] ) ) {
				$i++;
				continue;
			}

			$field->value[] = $_POST[ $field->name][$i];
			$i++;

		}

	}

}

//create temporary scratch directory
$dir['tmp'] = DGS_BASE_DIR . '/tmp/' . md5( time() );

// Check for a value in the report directory constant.
if (DGS_REPORT_DIR) {
  // Files will be created in the specified report directory and will not be zipped.
  $dir['rpt'] = DGS_REPORT_DIR;
}
// Files will be created in a temporary directory and added to zip file.
// Create the temporary directory.
mkdir( $dir['tmp'] );
// Create zip file.
$zipfile = "{$report->agency}-report.zip";

foreach ($dir as $id => $loc) {
  //json
  file_put_contents( $loc . '/digitalstrategy.json', json_encode( $report ) );

  //xml
  $xml = new SimpleXMLElement( '<report></report>' );
  $xml = dgs_to_xml( $report, $xml );
  file_put_contents(  $loc . '/digitalstrategy.xml', dgs_tidy_xml( $xml ) );

  //html
  file_put_contents( $loc . '/digitalstrategy.html', dgs_to_html( $report ) );
}

$zip = "{$dir['tmp']}/$zipfile";
dgs_zip( $dir['tmp'], $zip );

//send headers
header( 'Content-Type: application/zip' );
header( "Content-Disposition: attachment; filename=$zipfile" );
header( 'Content-Length: ' . filesize( $zip ) );

//read file
readfile( $zip );

//cleanup
dgs_cleanup( $dir['tmp'] );

exit();
