<?php

function pweb_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<div>
            <label class="screen-reader-text" for="s">' . __( 'Search for:', 'properweb' ) . '</label>
            <input type="text" value="' . get_search_query() . '" name="s" id="s" />
            <input type="submit" class="button tiny round" aria-label="submit form" value="'. __( 'Search', 'properweb' ) .'" />
	</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'pweb_search_form' );

?>