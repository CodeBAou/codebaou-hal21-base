import { __ } from '@wordpress/i18n';
import { useEffect, useState } from '@wordpress/element';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { SelectControl, PanelBody, ColorPicker } from '@wordpress/components';

import "./editor.scss";

const Edit = (props) => {

    const { attributes, setAttributes } = props;
    const [siteUrl, setSiteUrl] = useState(null);
    const [menus, setMenus] = useState([]);

    const { 
        selectedMenu, 
        TextColorTextMenu,
        colorBotonesMenu
    } = attributes;

    useEffect(() => {

        // Fetch site URL
        fetch('/wp-json/codebaou_hal21_end_point/v1/site-url')
            .then(res => res.json()) 
            .then(data => setSiteUrl(data.siteUrl))
            .catch(error => console.error('Error fetching site URL:', error));

        // Fetch menus
        fetch('/wp-json/codebaou_hal21_end_point/v1/menus')
            .then(res => res.json()) 
            .then(data => setMenus(data))
            .catch(error => console.error('Error fetching menus:', error));

    }, [selectedMenu]); // Añade un array vacío como dependencia para ejecutar solo una vez

    // Transformar menus en opciones para SelectControl
    const options = menus.map(item => ({
        label: item.name, // Usa item.name para la etiqueta en lugar de una cadena estática
        value: item.slug
    }));

    //Imprimir <li> html
    const getMenuSelectedLinks = () => {
        let links = menus.map( menu => {
            if( selectedMenu == menu.slug){
                return menu.links
            }
       });
       return links.filter(link => link != undefined);
    }

    //Seleccion del Menu 
    const onChangeMenu = (selected) => {
        let id = menus.map( menu => (menu.slug == selected)? menu.id : null);
        let idsanatize = id.filter( id => id!=null)[0];
        setAttributes({ selectedMenu: selected, selectedMenuId:idsanatize });
    };

    //Color texto enlace del menu
     const onChangeColorTextMenu = (newColor) => {
        setAttributes({ TextColorTextMenu: newColor.hex });
    };

    //Fondo botones menu
    const onChangeColorFondoMenu = (newColor) => {
        setAttributes({colorBotonesMenu:newColor.hex});
    }

    return (
        <>
            <InspectorControls>
                <SelectControl
                    label={__('Selecciona Menu para mostrar', 'codebaou-hal21-menu-select')}
                    value={selectedMenu}
                    options={options}
                    onChange={onChangeMenu}
                />

                <PanelBody title={__('Color texto', 'codebaou-backgroundColor-fondomenu')}>
                    <ColorPicker
                        color={TextColorTextMenu}
                        onChangeComplete={onChangeColorTextMenu}
                        disableAlpha
                    />
                </PanelBody>

                <PanelBody title={__('Color botones', 'codebaou-backgroundColor-fondomenu')}>
                    <ColorPicker
                        color={colorBotonesMenu}
                        onChangeComplete={onChangeColorFondoMenu}
                        disableAlpha
                    />
                </PanelBody>

            </InspectorControls>

            <div {...useBlockProps()}>
               {(!selectedMenu || selectedMenu == "") 
               ?
                    <span> Selecciona Menu </span>
               :    
               <ul className="codebaou-hal21-menu-ul" > 
                    {
                       (getMenuSelectedLinks()[0]) ? getMenuSelectedLinks()[0].map( (link,index)=>  <li style={{ backgroundColor: colorBotonesMenu }} className="codebaou-hal21-menu-li" key={"codebaou-item-menu-"+index}> <a style={{ color: TextColorTextMenu }} className="codebaou-hal21-menu-a" > {link.title} </a> </li> ): null 
                    }
               </ul>
                    
                } 

                <svg fill={TextColorTextMenu} width="800px" height="800px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h4v4H0V0zm0 6h4v4H0V6zm0 6h4v4H0v-4zM6 0h4v4H6V0zm0 6h4v4H6V6zm0 6h4v4H6v-4zm6-12h4v4h-4V0zm0 6h4v4h-4V6zm0 6h4v4h-4v-4z" fill-rule="evenodd"/>
                </svg>

            </div>          
        </>
    );
};

export default Edit;