=== codebaou hal21 base ===

Theme Name: codebaou-hal21-theme-base

Theme URI: codebaou-hal21

Author: codebaou

Author URI: https://hal21.es/

Description: Tema para los clientes de hal21 & codebaou

Requires at least: 6.6.1

Tested up to: 6.6.1

Requires PHP: 8.1.29

Version: 1.0.0

Text Domain: codebaou-hal21-theme hal21 codebaou

Tags: kitdigital hal21 codebaou multilenguaje empresa personal


== Copyright ==

(C) 2024 hal21, 2025
(C) codebaou , 2024

License URI: https://choosealicense.com/licenses/agpl-3.0/


![Screenshot of a comment on a GitHub issue showing an image, added in the Markdown, of an Octocat smiling and raising a tentacle.](/muestra.webp)


== Description ==

Un tema wordpress compatible con woocommerce y polylang. Añade solucciones de tradución de menus (polylang lo introduce de forma premium solo), estilo para plantillas woocommerce, plantillas páginas "Legal" con variables que completan mediante formulario y coleccion de bloques gutemberg que soluccionan necesidades especificas de los clientes.



== Changelog ==

= 1.0.0 =
* Released: Setiembre, 18 , 2024
    - templates
        - index.html
        - home.html
        - front-page.html
        - archive.html
        - 404.html
        - page nosotros
        - page contacto
        - legal 
        - accesibilidad 
        - politica de privacidad
        - términos y condiciones
        - politica de coockies
        - plantillas para woocommerce (Tienda normal y premium separadas)

    - Funcionalidad
        - scripts

        - stylos

        - Menu
            - Registro menu pricipal (compatibilidad con polylang)
            - Registro menu Legal (compatibilidad con polylang)

        - Rest Api
            - Obtener dominio
            - Obtener menus
            - Obtener datos para las plantillas de documentos legales

        - Configuraciones
            - Formulario Usuarios > Perfil
                - Para las plantillas de los documentos legales (legal, cookies, terminos, accesibilidad, privacidad).

    - Bloques Gutemberg (React)

        - Bloque image lazyLoad y efectos, carga el tamaño de imagen correcto segun dispositivo (wp a veces no lo hacía).
        - Bloque menu principal, un menu responsivo y compatible con polylang.
        - Bloque un menu Legal , para el footer y con compatibilidad con polylang.

    - Parts
        - header y footer.
        - Una sección para la página de Inicio.
        - Documento Legal, incluyen el texto legal la página que corresponda para utilizar como plantilla y llena las variables (datos personales) de forma automática. Estos datos se indican mediante formulario en  Usuarios > Perfil en el apartado legal.

    - Registro de fuentes
        - Gruppo
        - Lato
        - Montserrat

===================================================================================