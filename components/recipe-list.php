<?php // Recipe List ?>

 
    
    <article class="recipe">

        <?php if ( has_post_thumbnail() ) { ?>
            
            <a class="image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>

        <?php } ?>

        <button class="add_prplist" data-like-btn data-recipe-id="<?php the_ID(); ?>" data-user-id="<?php echo get_current_user_id(); ?>">
            <span class="add">
                add to wishlist
            </span>
            <span class="added">
                added to wishlist
            </span>
        </button>

        <div class="content">
        
            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                <h2>
                    <?php the_title(); ?>
                </h2>							
            </a>

            <?php the_field('sub_header'); ?>                                 

        </div>                                        

    </article>
