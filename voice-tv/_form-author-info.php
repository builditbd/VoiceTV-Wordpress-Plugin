<div class="youtube_box">
	<style scoped>
	</style>
	<p class="meta-options hcf_field">
		<label for="author_info">Author Info</label>
		<input id="author_info"
			   type="text"
			   name="author_info"
			   value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'author_info', true ) ); ?>"
		>
	</p>
</div>