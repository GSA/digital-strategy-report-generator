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
$dir = DGS_BASE_DIR . '/tmp/' . md5( time() );
mkdir( $dir );

//json
file_put_contents( $dir . '/digital-strategy.json', json_encode( $report ) );

//xml
$xml = new SimpleXMLElement( '<report></report>' );
$xml = dgs_to_xml( $report, $xml );
file_put_contents(  $dir . '/digital-strategy.xml', dgs_tidy_xml( $xml ) );

//html
file_put_contents( $dir . '/digital-strategy.html', dgs_to_html( $report ) );

$zip = $dir . "/{$report->agency}-report.zip";
dgs_zip( $dir, $zip );

//send headers
header( 'Content-Type: application/zip' );
header( "Content-Disposition: attachment; filename={$report->agency}-report.zip" );
header( 'Content-Length: ' . filesize( $zip ) );

//read file
readfile( $zip );

//cleanup
dgs_cleanup( $dir );
exit();