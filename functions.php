<?php 
/** Funcionalidad para el theme codebaou-hal21-base
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package codebaou-hal21-theme-base*/
add_theme_support( 'editor-styles' );

function codebaou_hal21_theme_enqueue_styles() {
    wp_enqueue_style(
        'codebaou-hal21-base-theme-style', 
        get_stylesheet_uri()
    ); 
    wp_enqueue_style(
        'codebaou-hal21-assetscss-sectionPrimaria01', 
        get_parent_theme_file_uri( 'assets/css/parts-style/section-primaria-01.css' )
    ); 
    wp_enqueue_style(
        'codebaou-hal21-assetscss-woocommerce-finalizar-compra', 
        get_parent_theme_file_uri( 'assets/css/templates-style/404.css' )
    );
    wp_enqueue_style(
        'codebaou-hal21-assetscss-woocommerce-base', 
        get_parent_theme_file_uri( 'assets/css/woocommerce/woocommerce.css' )
    ); 
 }
 add_action( 'wp_enqueue_scripts', 'codebaou_hal21_theme_enqueue_styles' );

 function codebaou_hal21_theme_base_enqueue_editor_styles() {
    add_editor_style( array(
        get_stylesheet_uri(),
            'assets/css/parts-style/section-primaria-01.css',
            'assets/css/templates-style/404.css',
            'assets/css/woocommerce/woocommerce.css'
        ) );
}
add_action( 'after_setup_theme', 'codebaou_hal21_theme_base_enqueue_editor_styles' );

function Register_Block_codebaou_hal21_menu(){
    register_block_type( dirname(__FILE__).'/blocks/codebaou-hal21-menu/build/block.json');
    register_block_type( dirname(__FILE__).'/blocks/codebaou-hal21-menu-vertical/build/block.json');
    register_block_type( dirname(__FILE__).'/blocks/codebaou-hal21-image/build/block.json');
    register_block_type( dirname(__FILE__).'/blocks/codebaou-hal2-ultimas-entradas/build/block.json');
}
add_action('init', 'Register_Block_codebaou_hal21_menu');

function register_codebaou_menu() {
    register_nav_menus(
        array(
            'codebaou-menu-header' => __('Menu Header'),
            'codebaou-menu-footer' => __('Menu Footer'),
        ));
}
add_action('init', 'register_codebaou_menu');

add_action('rest_api_init', function () {
    register_rest_route('codebaou_hal21_end_point/v1', '/site-url', array(
        'methods'  => 'GET',
        'callback' => 'get_site_url_api',
    ));
    register_rest_route('codebaou_hal21_end_point/v1', '/menus', array(
        'methods'  => 'GET',
        'callback' => 'get_menus_and_links_api',
    ));
    register_rest_route('codebaou_hal21_end_point/v1', '/datalegal', array(
        'methods'  => 'GET',
        'callback' => 'get_data_documento_Legal',
    ));
});

function get_site_url_api() {
    return array(
        'siteUrl' => get_site_url(),
    );
}

function get_menus_and_links_api() {
    $menus     = wp_get_nav_menus();
    $menu_data = array();
    foreach ($menus as $menu) {
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $menu_links = array();
        foreach ($menu_items as $item) {
            $menu_links[] = array(
                'id' => $item->ID,
                'title' => $item->title,
                'url' => $item->url,
                'parent' => $item->menu_item_parent,
                'type' => $item->type,
            );
        }
        $menu_data[] = array(
            'id' => $menu->term_id,
            'name' => $menu->name,
            'slug' => $menu->slug,
            'links' => $menu_links,
        );
    }
    return new WP_REST_Response($menu_data, 200);
}

function get_data_documento_Legal(){
    $user_id         = get_current_user_id();
    $dominio_legal   = get_option( 'codebaou_dominio_legal', '' );
    $cif_dni_legal   = get_option( 'codebaou_CIF_DNI_legal', '' );
    $direccion_legal = get_option( 'codebaou_direccion_legal', '');
    $fecha_revision  = get_option( 'codebaou_fecha_revision_legal', '');
    $persona_legal   = get_option( 'codebaou_nombre_legal' ). ' ' .get_option(' codebaou_apellidos_legal');
    $email_legal     = get_option( 'codebaou_email_legal' );
    $legal_data      = array(
        'codebaou_persona_legal'        => $persona_legal,
        'codebaou_dominio_legal'        => $dominio_legal,
        'codebaou_CIF_DNI_legal'        => $cif_dni_legal,
        'codebaou_direccion_legal'      => $direccion_legal,
        'codebaou_fecha_revision_legal' => $fecha_revision,
        'codebaou_email_legal'          => $email_legal
    );
    echo get_user_meta( $user_id, 'codebaou_dominio_legal', true );
    return new WP_REST_Response($legal_data,200);
}

function agregar_campos_personalizados_usuario( $user ) {
    $user_id                 = get_current_user_id();
    $persona_nombre_Legal    = get_option( 'codebaou_nombre_legal', 'Nombre');
    $persona_apellidos_Legal = get_option( 'codebaou_apellidos_legal', 'Apellidos');
    $dominio_legal           = get_option( 'codebaou_dominio_legal', ' Empresa ' );
    $cif_dni_legal           = get_option( 'codebaou_CIF_DNI_legal', ' xxxxxxxxT' );
    $direccion_legal         = get_option( 'codebaou_direccion_legal', 'C/ ');
    $fecha_revision          = get_option( 'codebaou_fecha_revision_legal', '18 sept 2024');?>
    <h3> Información complementaria para los documentos legales </h3>
    <table class="form-table">
        <tr>
            <th><label for="codebaou_dominio_legal">Nombre responsable legal</label></th>
            <td>
                <input type="text" name="codebaou_nombre_legal" id="codebaou_nombre_legal" value="<?php echo esc_html( get_option( 'codebaou_nombre_legal', true ) )?>" class="regular-text" />
                <span class="description">Introduce El nombre y apellidos que se debe mostrar en el documento legal</span>
            </td>
        </tr>
        <tr>
            <th><label for="codebaou_dominio_legal">Apellidos, responsable legal</label></th>
            <td>
                <input type="text" name="codebaou_apellidos_legal" id="codebaou_apellidos_legal" value="<?php echo esc_html( get_option( 'codebaou_apellidos_legal', true ) )?>" class="regular-text" />
                <span class="description">Introduce El nombre y apellidos que se debe mostrar en el documento legal</span>
            </td>
        </tr>
        <tr>
            <th><label for="codebaou_dominio_legal">Nombre dominio</label></th>
            <td>
                <input type="text" name="codebaou_dominio_legal" id="codebaou_dominio_legal" value="<?php echo esc_html( get_option( 'codebaou_dominio_legal', true ) )?>" class="regular-text" />
                <br><span class="description">Introduce dominio</span>
            </td>
        </tr>
        <tr>
            <th><label for="codebaou_CIF_DNI_legal">CIF/DNI - Legal</label></th>
            <td>
                <input type="text" name="codebaou_CIF_DNI_legal" id="codebaou_CIF_DNI_legal" value="<?php echo esc_html( get_option('codebaou_CIF_DNI_legal', true ) )?>" class="regular-text" />
                <br><span class="description">Por favor, introduce un CIF o DNI válido.</span>
            </td>
        </tr>
        <tr>
            <th><label for="codebaou_direccion_legal">Direccion - Legal</label></th>
            <td>
                <input type="text" name="codebaou_direccion_legal" id="codebaou_direccion_legal" value="<?php echo esc_html( get_option( 'codebaou_direccion_legal', true )) ?>" class="regular-text" />
                <br><span class="description">Introduce la direccion legal </span>
            </td>
        </tr>
        <tr>
            <th><label for="codebaou_email_legal">Email - Legal</label></th>
            <td>
                <input type="text" name="codebaou_email_legal" id="codebaou_email_legal" value="<?php echo esc_html( get_option( 'codebaou_email_legal', true )) ?>" class="regular-text" />
                <br><span class="description">Introduce la direccion legal </span>
            </td>
        </tr>
        <tr>
            <th><label for="codebaou_fecha_revision_legal">Fecha ultima revisión legal</label></th>
            <td>
                <input type="text" name="codebaou_fecha_revision_legal" id="codebaou_fecha_revision_legal" value="<?php echo esc_html( get_option('codebaou_fecha_revision_legal', true)) ?>" class="regular-text" />
                <br><span class="description">Por favor, introduce la fecha para el documento legal.</span>
            </td>
        </tr>
    </table>
<?php
}


add_action( 'show_user_profile', 'agregar_campos_personalizados_usuario' );
add_action( 'edit_user_profile', 'agregar_campos_personalizados_usuario' );

function guardar_campos_personalizados_usuario( $user_id ) {
     if ( isset( $_POST['codebaou_nombre_legal'] ) ) {
        update_option('codebaou_nombre_legal', sanitize_text_field( $_POST['codebaou_nombre_legal'] ) );}
    if ( isset( $_POST['codebaou_apellidos_legal'] ) ) {
        update_option('codebaou_apellidos_legal', sanitize_text_field( $_POST['codebaou_apellidos_legal'] ) );}
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;}
    if ( isset( $_POST['codebaou_dominio_legal'] ) ) {
        update_option('codebaou_dominio_legal', sanitize_text_field( $_POST['codebaou_dominio_legal'] ) );}
    if ( isset( $_POST['codebaou_CIF_DNI_legal'] ) ) {
        update_option('codebaou_CIF_DNI_legal', sanitize_text_field( $_POST['codebaou_CIF_DNI_legal'] ) );}
    if ( isset( $_POST['codebaou_direccion_legal'] ) ) {
        update_option('codebaou_direccion_legal', sanitize_text_field( $_POST['codebaou_direccion_legal'] ) );}
    if ( isset( $_POST['codebaou_fecha_revision_legal'] ) ) {
        update_option('codebaou_fecha_revision_legal', sanitize_text_field( $_POST['codebaou_fecha_revision_legal'] ) );}
    if ( isset( $_POST['codebaou_email_legal'] ) ) {
        update_option('codebaou_email_legal', sanitize_text_field( $_POST['codebaou_email_legal'] ) );}
}

add_action( 'personal_options_update', 'guardar_campos_personalizados_usuario' );
add_action( 'edit_user_profile_update', 'guardar_campos_personalizados_usuario' );