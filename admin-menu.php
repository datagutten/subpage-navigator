<?Php
require 'DOMDocument_createElement_simple.php';
$dom = new DOMDocumentCustom;
$div = $dom->createElement( 'div' );
$div->setAttribute( 'class','wrap' );
$div->setAttribute( 'style','background-color: #FFFFFF' );
$h2 = $dom->createElement_simple( 'h2', $div, false, __( 'Create shortcode for subpage navigator','subpage' ) );
$table = $dom->createElement_simple( 'table', $div, array(
	'class' => 'form-table',
) );
$tbody = $dom->createElement_simple( 'tbody',$table );
$tr = $dom->createElement_simple( 'tr',$tbody );
$td = $dom->createElement_simple( 'td',$tr,array(
	'colspan' => 2,
) );

$h3 = $dom->createElement_simple( 'h3', $td, false, __( 'Sub Page Display Options', 'subpage' ) );
$h4 = $dom->createElement_simple( 'h4', $td, false, __( 'Select how you want the subpages displayed','subpage' ) );
// Title.
$tr = $dom->createElement_simple( 'tr',$tbody );
//Label.
$td = $dom->createElement_simple( 'th',$tr );
$label = $dom->createElement_simple( 'label', $td, array(
	'for' => 'title',
), __( 'Title', 'subpage' ) );
//Field.
$td = $dom->createElement_simple( 'td',$tr );
$input = $dom->createElement_simple( 'input', $td, array(
	'type' => 'text',
	'id' => 'title',
	'name' => 'title',
	'onchange' => 'change_attribute(this)',
) );
// Sort order.
$tr = $dom->createElement_simple( 'tr',$tbody );
// Label.
$td = $dom->createElement_simple( 'th',$tr );
$label = $dom->createElement_simple( 'label', $td, array(
	'for' => 'sort_order',
), __( 'Sort order', 'subpage' ) );
//Field.
$td = $dom->createElement_simple( 'td',$tr );
$select = $dom->createElement_simple( 'select', $td, array(
	'id' => 'sort_order',
	'name' => 'sort_order',
	'onchange' => 'change_attribute(this)',
) );
$dom->createElement_simple( 'option', $select,array(
	'value' => 'ASC',
),__( 'Ascending' ) );
$dom->createElement_simple( 'option', $select,array(
	'value' => 'DESC',
),__( 'Descending' ) );

// Sorting criteria.
$tr = $dom->createElement_simple( 'tr',$tbody );
// Label.
$td = $dom->createElement_simple( 'th',$tr );
$label = $dom->createElement_simple( 'label', $td, array(
	'for' => 'sort_column',
), __( 'Sort by', 'subpage' ) );
//Input.
$td = $dom->createElement_simple( 'td',$tr );
$fields = array(
	'post_author' => __( 'Post author' ),
	'post_date' => __( 'Post date' ),
	'post_title' => __( 'Post title' ),
	'post_name' => __( 'Post name' ),
	'post_modified' => __( 'Post modified' ),
	'menu_order' => __( 'Menu order' ),
);
$select = $dom->createElement_simple( 'select',$td,array(
	'id' => 'sort_column',
	'name' => 'sort_order',
	'multiple' => 'multiple',
	'onchange' => 'change_attribute(this)',
) );
foreach ( $fields as $key => $value ) {
	$attributes['value'] = $key;
	$dom->createElement_simple( 'option', $select, $attributes, $value );
}

// Show shortcode.
$tr = $dom->createElement_simple( 'tr', $tbody );
$td = $dom->createElement_simple( 'td', $tr, array(
	'colspan' => 2,
) );

$h3 = $dom->createElement( 'h3', __( 'Dynamic shortcode','subpage' ) );
$div->appendChild( $h3 );
$h4 = $dom->createElement( 'h4', __( 'Please copy this shortcode and paste where you want to display subpages','subpage' ) );
$div->appendChild( $h4 );

echo $dom->saveXML( $div );
