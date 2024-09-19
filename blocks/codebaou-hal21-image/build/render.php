<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

 $width=$attributes["width"];
 $height=$attributes["height"];
 

?>


<div <?php echo get_block_wrapper_attributes(); ?> > 
<picture>
    <source
        media="(max-width: 450px)"
        srcset="<?php echo esc_url($attributes['srcthumbnail']); ?>"
    >
    <source
        media="(max-width: 553px)"
        srcset="<?php echo esc_url($attributes['srcmedium']); ?>"
    >
    <source
        media="(max-width: 1024px)"
        srcset="<?php echo esc_url($attributes['srclarge']); ?>"
    >
    <img
        width="<?php echo esc_attr($width) ?>px"
        height="<?php echo esc_attr($height) ?>px"
        src="<?php echo esc_url($attributes['srcfull']); ?>"
        alt="<?php echo esc_attr($attributes['mediaALT']); ?>"
        class="<?php echo esc_attr($attributes['classDesvanece']); ?>"
    /> 
</picture>

</div>

