<?php
// Asegúrate de que WordPress esté cargado
if (!defined('ABSPATH')) {
    exit;
}

//FILTROS 

// Es un filtro para modificar la etique <a> que imprime la funcion wp_nav_menu()
function agregar_estilo_personalizado_a_menu($item_output, $item, $depth, $args) {

    
    // Verificar si el color de fondo se ha definido en los atributos del bloque
    if (isset($args->block_attributes['backgroundColorLi'])) {
        // Crear el estilo dinámico
        $style = '
            background-color: ' . esc_attr($args->block_attributes['backgroundColorLi']) . '; 
            color: ' . esc_attr($args->block_attributes['TextColorTextMenu'] . ';');

        // Aplicar el estilo en el <li> o <a>
        //$item_output = preg_replace('/(<li )/', '$1style="' . $style . '" ', $item_output);  // Para <li>
        // O puedes usar esta línea si prefieres aplicarlo a <a>:
        $item_output = preg_replace('/(<a )/', '$1style="' . $style . '" ', $item_output);
    }

    return $item_output;
}

// Aplicar el filtro al inicio del renderizado de menú
add_filter('walker_nav_menu_start_el', function($item_output, $item, $depth, $args) use ($attributes) {
    // Pasar los atributos del bloque al argumento del menú
    $args->block_attributes = $attributes;

    // Modificar el estilo con la función personalizada
    return agregar_estilo_personalizado_a_menu($item_output, $item, $depth, $args);
}, 10, 4);

?>


<script>
//Fuciones Abrir/Cerrar  el menu mobile
let open_codebaou_menu = false;

function menu(){
    switch(open_codebaou_menu){
        case true:
            open_codebaou_menu = false;
            document.getElementsByClassName("wp-block-codebaou-hal21-codebaou-hal21-menu")[0].getElementsByTagName("div")[0].style.display ="none";
            document.getElementById("codebaou-icon-menu-principal").style.position = "absolute";    
            break;
        case false:
            open_codebaou_menu = true;
            document.getElementsByClassName("wp-block-codebaou-hal21-codebaou-hal21-menu")[0].getElementsByTagName("div")[0].style.display ="block";
            document.getElementById("codebaou-icon-menu-principal").style.position = "fixed";
            break;
    }
}


</script>

<div <?php echo get_block_wrapper_attributes(); ?> style="background-color: <?php echo esc_attr( $attributes['backgroundColorMenu'] ); ?>;" >

<?php
    //Obtener ubicaciones y ver cual coincide con el atributo (Ubicacion seleccionada en edit)
    $locations = get_nav_menu_locations(); //Obtener Ubiucaciones del menu
    $location_select = "";//Nombre Ubicacion del menu seleccionado

    // Recorrer las ubicaciones para encontrar la que coincide con el ID del menú
    foreach ( $locations as $location => $assigned_menu_id ) {
        if ( $assigned_menu_id == $attributes["selectedMenuId"] ) {
            $location_select =  $location; // Retorna la ubicación del menú si coincide el ID
        }
    }

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

    <svg id="codebaou-icon-menu-principal" onClick='menu()' fill="<?php echo $attributes['colorIconMenuMobile']?>" width="800px" height="800px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0h4v4H0V0zm0 6h4v4H0V6zm0 6h4v4H0v-4zM6 0h4v4H6V0zm0 6h4v4H6V6zm0 6h4v4H6v-4zm6-12h4v4h-4V0zm0 6h4v4h-4V6zm0 6h4v4h-4v-4z" fill-rule="evenodd"/>
    </svg>
</div>