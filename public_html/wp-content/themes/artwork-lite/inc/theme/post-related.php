<?php
/*
 * Class post related posts
 */

class MP_Artwork_Related {

    private $prefix;
    

    public function __construct($prefix) {
        $this->prefix = $prefix;
    }

    function related_posts() {
        global $post;
        if (strcmp(get_post_type($post), 'post') === 0) {
            $this->related_posts_post();
        } else {
            $this->related_posts_work();
        }
    }

    function related_cat_id() {
        global $post;
        $category_ids = array();
        $categories = get_the_category($post->ID);
        if ($categories) {
            foreach ($categories as $individual_category) {
                if ($individual_category->slug != 'uncategorised') {
                    $category_ids[] = $individual_category->term_id;
                }
            }
        }
        return $category_ids;
    }

    function related_tag_id() {
        global $post;
        $tag_ids = array();
        $tags = wp_get_post_tags($post->ID);
        if ($tags) {
            foreach ($tags as $individual_tag) {
                $tag_ids[] = $individual_tag->term_id;
            }
        }
        return $tag_ids;
    }

    function related_tag_tax_id($postTypeSlug) {
        global $post;
        $tag_ids = array();
        $tags = wp_get_post_terms($post->ID, 'post_tag_' . $postTypeSlug);
        foreach ($tags as $individual_tag) {
            $tag_ids[] = $individual_tag->term_id;
        }
        return $tag_ids;
    }

    function related_cat_tax_id($postTypeSlug) {
        global $post;
        $category_ids = array();
        $categories = wp_get_post_terms($post->ID, 'category_' . $postTypeSlug);
        foreach ($categories as $individual_cat) {
            $category_ids[] = $individual_cat->term_id;
        }
        return $category_ids;
    }

    function related_posts_work() {
        global $post;
        
        $postTypeSlug = mp_artwork_get_post_type_slug();
		if ($postTypeSlug) {
			$tag_ids = $this->related_tag_tax_id($postTypeSlug);
			$category_ids = $this->related_cat_tax_id($postTypeSlug);
			$post_ids = array($post->ID);
			$args = array();
			if ($tag_ids || $category_ids) {
				$tax_query = array('relation' => 'OR');
				if ($tag_ids) {
					array_push($tax_query, array(
						'taxonomy' => 'post_tag_' . $postTypeSlug,
						'field' => 'term_id',
						'terms' => $tag_ids,
					));
				}
				if ($category_ids) {
					array_push($tax_query, array(
						'taxonomy' => 'category_' . $postTypeSlug,
						'field' => 'term_id',
						'terms' => $category_ids,
					));
				}
				$args = array(
					'orderby' => 'date',
					'tax_query' => $tax_query,
					'post__not_in' => array($post->ID),
					'posts_per_page' => 6,
					'post_type' => get_post_type($post)
				);
				$works = null;
				$works = new wp_query($args);
				if ($works->have_posts()) {
					$this->related_posts_loop_before();
					while ($works->have_posts()) {
						$this->related_posts_loop($works);
					}
					$this->related_posts_loop_after();
				}
				wp_reset_query();
			}
		}
    }


    function related_posts_post() {
        global $post;
        $tag_ids = $this->related_tag_id();
        $category_ids = $this->related_cat_id();
        $args = array();
        if ($tag_ids || $category_ids) {
            $tax_query = array('relation' => 'OR');
            $args = array(
                'orderby' => 'date',
                'tax_query' => $tax_query,
                'post__not_in' => array($post->ID),
                'posts_per_page' => 4,
                'post_type' => get_post_type($post)
            );
            if ($tag_ids) {
                $args['tag__in'] = $tag_ids;
            }
            if ($category_ids) {
                $args['category__in'] = $category_ids;
            }
            $works = null;
            $works = new wp_query($args);
            if ($works->have_posts()) {
                $this->related_posts_loop_before();
                while ($works->have_posts()) {
                    $this->related_posts_loop($works);
                }
                $this->related_posts_loop_after();
            }
            wp_reset_query();
        }
    }

    function related_posts_loop_before() {
        ?>
        <div class="posts-related" id="post-<?php the_ID(); ?>">
            <div class="two-col-works">
                <?php
            }

            function related_posts_loop_after() {
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php
    }

    function related_posts_content($args, $argscat) {
        global $post;
        $post_ids = array($post->ID);
        $first = false;
        $works = null;
        $works = new wp_query($args);
        if ($works->have_posts()) {
            $first = true;
            $this->related_posts_loop_before();
            while ($works->have_posts()) {
                array_push($post_ids, $post->ID);
                $this->related_posts_loop($works);
            }
        }
        wp_reset_query();
        $argscat['post__not_in'] = $post_ids;
        $works = null;
        $works = new wp_query($argscat);
        if ($works->have_posts()) {
            if (!$first) {
                $first = true;
                $this->related_posts_loop_before();
            }
            while ($works->have_posts()) {
                $this->related_posts_loop($works);
            }
        }
        wp_reset_query();
        if ($first) {
            $this->related_posts_loop_after();
        }
    }

    function related_posts_loop($works) {
        global $post;
        $works->the_post();
        $mp_artwork_feat_image_url =wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), mp_artwork_get_prefix() . 'thumb-large');
        $mp_artwork_width_img = $mp_artwork_feat_image_url[1];
        $mp_artwork_class_page = '';
        if ($mp_artwork_width_img >= 600) {
            $mp_artwork_class_page = 'work-wrapper-cover';
        }
        $mp_artwork_work_bg = get_post_meta(get_the_ID(), '_work_bg', true);
        if (empty($mp_artwork_work_bg)):
            $mp_artwork_work_bg = "work-wrapper-light";
        endif;
        ?>
        <?php
        if ($mp_artwork_feat_image_url):
            ?>
            <a href="<?php the_permalink(); ?>" class="work-element" id="post-<?php echo esc_attr($post->ID); ?>">
                <div class="work-wrapper work-wrapper-bg <?php echo  esc_attr($mp_artwork_work_bg); ?> <?php echo esc_attr($mp_artwork_class_page); ?>" style="background-image: url(<?php echo esc_url($mp_artwork_feat_image_url[0]); ?>)">
                </div>
            <?php the_title('<div class="work-content"><div class="work-header"><h5>', '</h5></div></div>'); ?>                            
            </a>
            <?php else: ?>
            <a href="<?php the_permalink(); ?>" class="work-element default-elemet"  id="post-<?php echo esc_attr($post->ID); ?>">
                <div class="work-wrapper <?php echo  esc_attr($mp_artwork_work_bg); ?> <?php echo esc_attr($mp_artwork_class_page); ?>" >
                </div>
            <?php the_title('<div class="work-content"><div class="work-header"><h5>', '</h5></div></div>'); ?>  
            </a>
        <?php
        endif;
    }
}
