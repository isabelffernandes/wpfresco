<?php
function mp_artwork_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    $html = '';
    $id = $post_thumbnail_id;
    $image = wp_get_attachment_image_src($id, $size);
    if ($size != 'post-thumbnail') {
        $image_medium = wp_get_attachment_image_src($id, 'thumb-medium');
        $image_thumbnails = wp_get_attachment_image_src( get_post_thumbnail_id($post_id) ,'post-thumbnail');
    }
    if ($image) {
        list($src, $width, $height) = $image;
        $hwstring = image_hwstring($width, $height);
        $size_class = $size;
        if (is_array($size_class)) {
            $size_class = join('x', $size_class);
        }
        $attachment = get_post($id);
        $default_attr = array(
            'src' => $src,
            'class' => "attachment-$size_class",
            'alt' => trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true))), // Use Alt field first
        );
        if (empty($default_attr['alt']))
            $default_attr['alt'] = trim(strip_tags($attachment->post_excerpt)); // If not, Use the Caption
        if (empty($default_attr['alt']))
            $default_attr['alt'] = trim(strip_tags($attachment->post_title)); // Finally, use the title

        $attr = wp_parse_args($attr, $default_attr);
        $attr = apply_filters('wp_get_attachment_image_attributes', $attr, $attachment, $size);
        $attr = array_map('esc_attr', $attr);
        $html = rtrim("<img $hwstring");
        foreach ($attr as $name => $value) {
            $html .= " $name=" . '"' . $value . '"';
        }
        if ($size != 'post-thumbnail') {
           
              $html .=' srcset="'.esc_url($image_thumbnails[0]).'   720w, '.esc_url($image_medium[0]).'   940w, ' .$attr['src'].'  1170w, " sizes=" (min-width:1230px) 1170px, (min-width:992px) 940px,  720px" width="1170" height="543"';
        }
              $html .= ' />';
    }
    return $html;
}

add_filter('post_thumbnail_html', 'mp_artwork_post_thumbnail_html', 99, 5);
