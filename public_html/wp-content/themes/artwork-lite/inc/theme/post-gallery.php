<?php
/*
 * Class post gallery
 */

class MP_Artwork_Gallery {

    private $prefix;

    public function __construct($prefix) {
        $this->prefix = $prefix;
    }

    private function get_img_attr($id, $src, $class = 'post-thumbnail') {
        $attr = '';
        $html = '';
        $attachment = get_post($id);
        $default_attr = array(
            'src' => $src,
            'class' => "attachment",
            'alt' => trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true))), // Use Alt field first
        );
        if (empty($default_attr['alt'])){
            $default_attr['alt'] = trim(strip_tags($attachment->post_excerpt)); // If not, Use the Caption
        }
        if (empty($default_attr['alt'])){
            $default_attr['alt'] = trim(strip_tags($attachment->post_title)); // Finally, use the title
        }
        $attr = wp_parse_args($attr, $default_attr);
        $attr = apply_filters('wp_get_attachment_image_attributes', $attr);
        $attr = array_map('esc_attr', $attr);
        foreach ($attr as $name => $value) {
            $html .= " $name=" . '"' . $value . '"';
        }
        return $html;
    }

    private function set_post_gallery($src, $className, $id) {
        $post_id = get_the_ID();
        $html = '';

        if ("gallery-12" != $className) {
            $srcImg = wp_get_attachment_image_src($id, 'post-thumbnail');
            $src = $srcImg[0];
            $html .= '<div class="' . $className . '"><a href="' . get_permalink() . '"><img  ';
            $html .= $this->get_img_attr($id, $srcImg[0]);
            $html .=' ></a></div>';
        } else {
            $image_medium = wp_get_attachment_image_src($id, 'thumb-medium');
            $image_thumbnails = wp_get_attachment_image_src($id, 'post-thumbnail');
            $html .= '<div class="' . $className . '"><a href="' . get_permalink() . '" ><img ';
            $html .= $this->get_img_attr($id, $src, 'thumb-large-blog');
            $html .=' srcset="' . $image_thumbnails[0] . '   720w, ' . $image_medium[0] . '   940w, ' . $src . '  1170w, " sizes=" (min-width:1230px) 1170px, (min-width:992px) 940px,  720px" width="1170" height="543"></a></div>';
        }
        echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    private function get_post_gallery_class($mp_artwork_feat_image_url) {
        $mp_artwork_width_img = $mp_artwork_feat_image_url[1];
        if ($mp_artwork_width_img >= 1170) {
            return 'gallery-12';
        }
        if ($mp_artwork_width_img >= 589) {
            return 'gallery-6';
        }
        return 'gallery-4';
    }

    private function get_post_gallery_list($id_gallery, $size) {
        $src[0] = wp_get_attachment_image_src($id_gallery[0], 'thumb-large-blog');
        $className[0] = $this->get_post_gallery_class($src[0]);
        if ($size > 1) {
            $src[1] = wp_get_attachment_image_src($id_gallery[1], 'thumb-large-blog');
            $className[1] = $this->get_post_gallery_class($src[1]);
            if ($size > 2) {
                $src[2] = wp_get_attachment_image_src($id_gallery[2], 'thumb-large-blog');
                $className[2] = $this->get_post_gallery_class($src[2]);
            }
        }

        if (in_array("gallery-4", $className)) {
            $this->set_post_gallery($src[0][0], "gallery-4", $id_gallery[0]);
            if ($size > 1) {
                $this->set_post_gallery($src[1][0], "gallery-4", $id_gallery[1]);
                if ($size > 2) {
                    $this->set_post_gallery($src[2][0], "gallery-4", $id_gallery[2]);
                }
            }
            return;
        }
        if (in_array("gallery-12", $className)) {
            if ($size == 2) {
                $this->set_post_gallery($src[0][0], "gallery-6", $id_gallery[0]);
                $this->set_post_gallery($src[1][0], "gallery-6", $id_gallery[1]);
            }
            if ($size == 1) {
                $this->set_post_gallery($src[0][0], "gallery-12", $id_gallery[0]);
            }
            if ($size == 3) {
                if ($className[0] === 'gallery-12') {
                    $this->set_post_gallery($src[0][0], "gallery-12", $id_gallery[0]);
                    $this->set_post_gallery($src[1][0], "gallery-6", $id_gallery[1]);
                    $this->set_post_gallery($src[2][0], "gallery-6", $id_gallery[2]);
                } else {
                    if ($className[1] === 'gallery-12') {
                        $this->set_post_gallery($src[1][0], "gallery-12", $id_gallery[1]);
                        $this->set_post_gallery($src[0][0], "gallery-6", $id_gallery[0]);
                        $this->set_post_gallery($src[2][0], "gallery-6", $id_gallery[2]);
                    } else {
                        $this->set_post_gallery($src[2][0], "gallery-12", $id_gallery[2]);
                        $this->set_post_gallery($src[0][0], "gallery-6", $id_gallery[0]);
                        $this->set_post_gallery($src[1][0], "gallery-6", $id_gallery[1]);
                    }
                }
            }
            return;
        } else {
            if ($size === 3) {
                $this->set_post_gallery($src[0][0], "gallery-4", $id_gallery[0]);
                $this->set_post_gallery($src[1][0], "gallery-4", $id_gallery[1]);
                $this->set_post_gallery($src[2][0], "gallery-4", $id_gallery[2]);
            } else {
                $this->set_post_gallery($src[0][0], "gallery-6", $id_gallery[0]);
                if ($size > 1) {
                    $this->set_post_gallery($src[1][0], "gallery-6", $id_gallery[1]);
                    if ($size > 2) {
                        $this->set_post_gallery($src[2][0], "gallery-6", $id_gallery[2]);
                    }
                }
            }
        }
    }

    public function get_post_gallery($post, $mp_artwork_page_template) {
        if (get_post_gallery()) :
            ?>
            <div class="entry-thumbnail entry-thumbnail-gallery ">
                <div class="gallery-row">
                    <?php
                    $gallery = get_post_gallery(get_the_ID(), false);
                    if (empty($gallery["ids"])) {
                        $size = sizeof($gallery["src"]);
                        echo '<div class="gallery-4"><a href="' . get_permalink() . '" rel="bookmark"><img src="' . $gallery["src"][0] . '"></a></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        if ($size > 1) {
                            echo '<div class="gallery-4"><a href="' . get_permalink() . '" rel="bookmark"><img src="' . $gallery["src"][1] . '"></a></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            if ($size > 2) {
                                echo '<div class="gallery-4"><a href="' . get_permalink() . '" rel="bookmark"><img src="' . $gallery["src"][2] . '"></a></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            }
                        }
                        echo '</div></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        return;
                    }
                    $id_gallery = explode(',', $gallery["ids"]);
                    $size = sizeof($id_gallery);
                    switch ($size) {
                        case 2:
                            $this->get_post_gallery_list($id_gallery, 2);
                            break;
                        case 1:
                            $this->get_post_gallery_list($id_gallery, 1);
                            break;
                        default:
                            if ($size >= 3) {
                                $this->get_post_gallery_list($id_gallery, 3);
                            }
                            break;
                    }
                    ?>
                </div>
            </div>
            <?php
        else:
            mp_artwork_post_thumbnail($post, $mp_artwork_page_template);
        endif;
    }

}
