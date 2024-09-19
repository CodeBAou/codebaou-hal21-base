/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, MediaUpload, MediaUploadCheck, InspectorControls, BlockControls } from '@wordpress/block-editor';


/** @wordpress/components */
import { Button, ResizableBox,ToggleControl, PanelBody } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

import { useState, useEffect } from '@wordpress/element';
/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit (props) {

	const {attributes, setAttributes, toggleSelection } = props;
	const { mediaALT, mediaID, srcfull, srclarge, srcmedium, srcthumbnail, widthfull, widthlarge, widthmedium, widththumbnail, width, height, filtroTransparenciaLadosImg, classDesvanece } = attributes;
	
	

	const setImageUpload = (media) => {
		
		setAttributes({
			mediaID: media.id,
			mediaALT: media.alt,
			srcfull: media.sizes.full.url,
			srclarge: media.sizes.large.url,
			srcmedium: media.sizes.medium.url,
			srcthumbnail: media.sizes.thumbnail.url,
			widthfull: media.sizes.full.width,
			widthlarge: media.sizes.large.width,
			widthmedium: media.sizes.medium.width,
			widththumbnail: media.sizes.thumbnail.width,
		});
	}

	 // Actualizar toggle , activar filtro opacidad en los lados
	 const onChangeToggle = (value) => {

		setAttributes({ filtroTransparenciaLadosImg: value });

		if(value){
			setAttributes({classDesvanece:'wp-block-codebaou-hal21-libcss-desvanece-opacidad-lados'});
		}else{
			setAttributes({classDesvanece:''});
		}
        
    };

	return (

		<div {...useBlockProps()}>

			<BlockControls>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={setImageUpload}
						allowedTypes={['image']}
						value={mediaID}
						render={({ open }) => (
							<Button className="wp-block-codebaou-wp-codebaou-wp-responsiveimage-button" onClick={open}> IMAGEN </Button>
						)}
					/>
				</MediaUploadCheck>
			</BlockControls>
		    
			<InspectorControls>
                <PanelBody title={__("Efectos", "codebaou-hal21-image-effects-list")} initialOpen={false}>
                    <ToggleControl
                        label={__("Opacidad lados", "codebaou-hal21-effect-desvanece")}
                        checked={filtroTransparenciaLadosImg}
                        onChange={onChangeToggle}
                    />
                </PanelBody>
            </InspectorControls>

			{/** 
			* SE SIGUE EL PROTOCOLO DE IMAGEN RESPONSIVE --> https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images
			*
			*/}
			{mediaID ? (

				<ResizableBox
				size={ {
					height,
					width,
				} }
				minHeight="50"
				minWidth="50"
				enable={ {
					top: true,
					right: true,
					bottom: true,
					left: true,
					topRight: true,
					bottomRight: true,
					bottomLeft: true,
					topLeft: true,
				} }
				onResizeStop={ ( event, direction, elt, delta ) => {
					setAttributes({
						height: height + delta.height,
						width: width + delta.width
					});
					
					toggleSelection( true );
				} }
				onResizeStart={ () => {
					toggleSelection( false );
				} }
				>
					<picture >
						
						<source
							media="(max-width: 450px)"
							srcSet={srcthumbnail}
						/>
						
						<source
							media="(max-width: 553px)"
							srcSet={srcmedium}
						/>

						<source
							media="(max-width:1024px)"
							srcSet={srclarge}
						/>

						<img
							src={srcfull}
							alt={attributes.mediaALT}
							style={{ width:width, maxWidth: '100%', height:height }}
							className={classDesvanece}
						/>
					</picture>

				</ResizableBox>
			) : (
				<div>
					<p>Carga una imagen desde el botón</p>
				</div>
			)}
		</div>
	)
}



