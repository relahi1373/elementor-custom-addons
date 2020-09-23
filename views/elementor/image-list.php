<div class="image-list__wrapper">

    <ul class="image-list">
		<?php foreach ( $settings['list'] as $setting ): ?>
            <li class="image-item">
				<?php

				$image_field = $setting['image_field'];
				$image       = attachment_url_to_postid( $image_field['url'] );

				echo wp_get_attachment_image( $image, $setting['image_size'] );

				?>
            </li>
		<?php endforeach; ?>
    </ul>
</div>
