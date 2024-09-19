import { __ } from '@wordpress/i18n';
import { useEffect, useState } from '@wordpress/element';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { SelectControl, PanelBody, ColorPicker } from '@wordpress/components';
import './editor.scss';

export default function Edit(props) {

	const { attributes, setAttributes } = props;
	const [menus, setMenus] = useState([]);

	const {selectedMenuVertical, textColorMenuVertical, selectedMenuId} = attributes;

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

    }, [selectedMenuVertical]); // Añade un array vacío como dependencia para ejecutar solo una vez
	
	// Transformar menus en opciones para SelectControl
	const options = menus.map(item => ({
        label: item.name, // Usa item.name para la etiqueta en lugar de una cadena estática
        value: item.slug
    }));

	//Imprimir <li> html
	const getMenuSelectedLinks = () => {

        let links = menus.map( menu => {
            if( selectedMenuVertical == menu.slug){
            
                return menu.links
            }
       });

       return links.filter(link => link != undefined);
    }
	
	 //Seleccion del Menu 
	 const onChangeMenu = (selected) => {
        let id = menus.map( menu => (menu.slug == selected)? menu.id : null);
        let idsanatize = id.filter( id => id!=null)[0];
        setAttributes({ selectedMenuVertical: selected, selectedMenuId:idsanatize });
    };

	const onChangeTextColor = (newColor) => {
		setAttributes({ textColorMenuVertical: newColor.hex });
	}
	return (
		<>
			<InspectorControls>
				<SelectControl
                    label={__('Selecciona Menu para mostrar', 'codebaou-hal21-menu-vertical-select')}
                    value={selectedMenuVertical}
                    options={options}
                    onChange={onChangeMenu}
                />

				<PanelBody title={__('Color Links', 'codebaou-TextColor-menuvertical')}>
                    <ColorPicker
                        color={textColorMenuVertical}
                        onChangeComplete={onChangeTextColor}
                        disableAlpha
                    />
                </PanelBody>
			</InspectorControls>
			
			<ul { ...useBlockProps() }>
				{
                	(getMenuSelectedLinks()[0]) ? getMenuSelectedLinks()[0].map( (link,index)=>  <li  className="codebaou-hal21-menu-li" key={"codebaou-item-menu-"+index} >  <a style={{ color: textColorMenuVertical}}> {link.title} </a> </li> ): <span>Inserta Menu</span> 
                }
			</ul>
		</>	
	);
}
