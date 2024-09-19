<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

  //Obtener ubicaciones y ver cual coincide con el atributo (Ubicacion seleccionada en edit)
 $locations = get_nav_menu_locations(); //Obtener Ubiucaciones del menu
 $location_select = "";//Nombre Ubicacion del menu seleccionado

 // Recorrer las ubicaciones para encontrar la que coincide con el ID del menú
 foreach ( $locations as $location => $assigned_menu_id ) {
	 if ( $assigned_menu_id == $attributes["selectedMenuId"] ) {
		 $location_select =  $location; // Retorna la ubicación del menú si coincide el ID
	 }
 }

?>
<div <?php echo get_block_wrapper_attributes(); ?>>

<?php

	if ( function_exists( 'pll_current_language' ) ) { //Polylang esta instalado

	$lang       = pll_current_language();
	//Switch menu por ubicacion y idioma (Polylang)
	if ( $lang == 'es' && $location_select == "codebaou-menu-header" ) {// Menu header
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-header', 'menu' => 'Menu Español' ) );
	} else if ( $lang == 'en' ) {
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-header', 'menu' => 'Menu Inglés' ) );
	} else if ( $lang == 'ru' ) {
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-header', 'menu' => 'Menu Ruso' ) );
	} else if ( $lang == 'sk' ) {
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-header', 'menu' => 'Menu Croata' ) );
	}  
	else if ( $lang == 'es' && $location_select == "codebaou-menu-footer" ) {//menu footer  
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-footer', 'menu' => 'Menu Español' ) );
	} else if ( $lang == 'en' ) {
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-footer', 'menu' => 'Menu Inglés' ) );
	} else if ( $lang == 'ru' ) {
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-footer', 'menu' => 'Menu Ruso' ) );
	} else if ( $lang == 'sk' ) {
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-footer', 'menu' => 'Menu Croata' ) );
	}
	
	}else{ //Polylang no esta instalado
	if($location_select == "codebaou-menu-header"){
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-header', 'menu' => 'Menu Español' ) );
	}else if($location_select == "codebaou-menu-footer"){
		wp_nav_menu( array( 'theme_location' => 'codebaou-menu-footer', 'menu' => 'Menu Español' ) );
	}
	} 
?>
</div>
