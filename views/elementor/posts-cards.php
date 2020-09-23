<div class="posts-widget__wrapper">

	<ul class="posts-list__cards">

		<?php if ( $query->have_posts() ): ?>

			<?php while ( $query->have_posts() ): $query->the_post(); ?>

				<li class="posts-item__cards">

                    <div class="thumbnail-post" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_ID() ,'posts-size' ) ?>')">

	                    <?php global $post;

	                    echo get_avatar(get_the_author_meta('user_email' , $post->post_author));

	                    ?>

                    </div>

					<h3 class="post-title"><?php echo get_the_title() ?></h3>

					<p><?php echo get_the_excerpt() ?></p>

                    <a class="post-permalink" href="<?php echo get_the_permalink() ?>"><?php _e('Read More >>') ?></a>

				</li>

			<?php endwhile; ?>

		<?php endif; ?>

	</ul>

</div>