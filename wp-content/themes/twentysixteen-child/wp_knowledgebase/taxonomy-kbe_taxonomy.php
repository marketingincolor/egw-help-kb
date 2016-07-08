<?php
    get_header('knowledgebase');

    // load the style and script
    wp_enqueue_style ( 'kbe_theme_style' );
    if( KBE_SEARCH_SETTING == 1 ){
        wp_enqueue_script( 'kbe_live_search' );
    }

    // Classes For main content div
    if(KBE_SIDEBAR_INNER == 0) {
        $kbe_content_class = 'class="kbe_content_full"';
    } elseif(KBE_SIDEBAR_INNER == 1) {
        $kbe_content_class = 'class="kbe_content_right"';
    } elseif(KBE_SIDEBAR_INNER == 2) {
        $kbe_content_class = 'class="kbe_content_left"';
    }

    // Classes For sidebar div
    if(KBE_SIDEBAR_INNER == 0) {
        $kbe_sidebar_class = 'kbe_aside_none';
    } elseif(KBE_SIDEBAR_INNER == 1) {
        $kbe_sidebar_class = 'kbe_aside_left';
    } elseif(KBE_SIDEBAR_INNER == 2) {
        $kbe_sidebar_class = 'kbe_aside_right';
    }

    // Query for Category
    $kbe_cat_slug = get_queried_object()->slug;
    $kbe_cat_name = get_queried_object()->name;

    $kbe_tax_post_args = array(
        'post_type' => KBE_POST_TYPE,
        'posts_per_page' => 999,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => KBE_POST_TAXONOMY,
                'field' => 'slug',
                'terms' => $kbe_cat_slug
            )
        )
    );
    $kbe_tax_post_qry = new WP_Query($kbe_tax_post_args);
?>
<div id="kbe_container">
    <div class="header-image">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        </a>
    </div><!-- .header-image -->

    <!--Breadcrum-->
    <?php
        if(KBE_BREADCRUMBS_SETTING == 1){
    ?>
            <div class="kbe_breadcrum">
                <?php echo kbe_breadcrumbs(); ?>
            </div>
    <?php
        }
    ?>
    <!--/Breadcrum-->

    <!--search field-->
    <?php
        if(KBE_SEARCH_SETTING == 1){
            kbe_search_form();
        }
    ?>
    <!--/search field-->

    <!--content-->
    <div id="kbe_content" <?php echo $kbe_content_class; ?>>
        <!--leftcol-->
        <div class="kbe_leftcol">

            <!--<articles>-->
            <div class="kbe_articles">
                <h2><strong><?php echo $kbe_cat_name; ?></strong></h2>

                <ul>
            <?php
                if($kbe_tax_post_qry->have_posts()) :
                    while($kbe_tax_post_qry->have_posts()) :
                        $kbe_tax_post_qry->the_post();
            ?>
                        <li class="<?php echo ( current_user_can( 'read' ) ? 'yes' : 'no'); ?>">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </li>
            <?php
                    endwhile;
                endif;
            ?>
                </ul>

            </div>
        </div>
        <!--/leftcol-->

    </div>
    <!--/content-->

    <!--aside-->
    <div class="kbe_aside <?php echo $kbe_sidebar_class; ?>">
    <?php
        if((KBE_SIDEBAR_INNER == 2) || (KBE_SIDEBAR_INNER == 1)){
            dynamic_sidebar('kbe_cat_widget');
        }
    ?>
    </div>
    <!--/aside-->

</div>
<?php
    get_footer('knowledgebase');
?>