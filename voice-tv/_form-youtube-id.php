<div class="youtube_box">
    <style scoped>
    </style>
    <p class="meta-options hcf_field">
        <label for="youtube_video_id">Video ID</label>
        <input id="youtube_video_id"
            type="text"
            name="youtube_video_id"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'youtube_video_id', true ) ); ?>"
        >
    </p>
    <p class="description">
        Enter the video ID from youtube video.
        i.e. https://www.youtube.com/watch?v=<code>El7eCeEkZNc</code>
    </p>
</div>