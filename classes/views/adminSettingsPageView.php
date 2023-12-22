<?php
$popup_event_active         = get_option( 'proxima_popup_event_active' );
$popup_event_posts          = get_option( 'proxima_popup_event_posts' );
$popup_event_pages          = get_option( 'proxima_popup_event_pages' );
$popup_event_archive        = get_option( 'proxima_popup_event_archive' );
$popup_subscription_active  = get_option( 'proxima_popup_subscription_active' );
$popup_subscription_posts   = get_option( 'proxima_popup_subscription_posts' );
$popup_subscription_pages   = get_option( 'proxima_popup_subscription_pages' );
$popup_subscription_archive = get_option( 'proxima_popup_subscription_archive' );
$popup_offset_time          = get_option( 'proxima_popup_offset_time' );
$popup_emails               = get_option( 'proxima_popup_emails' );

?>

<div class="popups-settings_heading">
    <h2>Popups settings</h2>
</div>
<div class="popups-settings_content">
    <form method="post" class="popups-settings_form">
        <div class="popups-settings_wrapper">
            <label for="popup_event_active">Active event popup</label>
            <select name="popup_event_active" id="popup_event_active">
                <option value="0" <?php echo $popup_event_active == '0' ? 'selected' : ''; ?>>None</option>
                <?php if ( ! empty( $popups_event ) ): ?>
                    <?php foreach ( $popups_event as $popup_event ): ?>
                        <option value="<?php echo $popup_event['popup_id']; ?>" <?php echo $popup_event_active == $popup_event['popup_id'] ? 'selected' : ''; ?>><?php echo $popup_event['popup_name']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="popups-settings_wrapper">
            <label for="popup_event_posts">Posts, where show event popup</label>
            <select name="popup_event_posts[]" id="popup_event_posts" multiple>
                <option value="all" <?php echo is_array( $popup_event_posts ) && in_array( 'all', $popup_event_posts ) ? 'selected' : ''; ?>>
                    All
                </option>
                <?php if ( ! empty( $posts ) ): ?>
                    <?php foreach ( $posts as $post ): ?>
                        <option value="<?php echo $post['post_id']; ?>" <?php echo is_array( $popup_event_posts ) && in_array( $post['post_id'], $popup_event_posts ) ? 'selected' : ''; ?>><?php echo $post['post_name']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="popups-settings_wrapper">
            <label for="popup_event_pages">Pages, where show event popup</label>
            <select name="popup_event_pages[]" id="popup_event_pages" multiple>
                <option value="all" <?php echo is_array( $popup_event_pages ) && in_array( 'all', $popup_event_pages ) ? 'selected' : ''; ?>>
                    All
                </option>
                <?php if ( ! empty( $pages ) ): ?>
                    <?php foreach ( $pages as $page ): ?>
                        <option value="<?php echo $page['post_id']; ?>" <?php echo is_array( $popup_event_pages ) && in_array( $page['post_id'], $popup_event_pages ) ? 'selected' : ''; ?>><?php echo $page['post_name']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="popups-settings_wrapper">
            <label for="popup_event_archive">Show on archive pages</label>
            <input type="checkbox" name="popup_event_archive"
                   id="popup_event_archive" <?php echo ! empty( $popup_event_archive ) ? 'checked' : ''; ?>>
        </div>

        <hr>

        <div class="popups-settings_wrapper">
            <label for="popup_subscription_active">Active subscription popup</label>
            <select name="popup_subscription_active" id="popup_subscription_active">
                <option value="0" <?php echo $popup_subscription_active == '0' ? 'selected' : ''; ?>>None</option>
                <?php if ( ! empty( $popups_subscription ) ): ?>
                    <?php foreach ( $popups_subscription as $popup_subscription ): ?>
                        <option value="<?php echo $popup_subscription['popup_id']; ?>" <?php echo $popup_subscription_active == $popup_subscription['popup_id'] ? 'selected' : ''; ?>><?php echo $popup_subscription['popup_name']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="popups-settings_wrapper">
            <label for="popup_subscription_posts">Posts, where show subscription popup</label>
            <select name="popup_subscription_posts[]" id="popup_subscription_posts" multiple>
                <option value="all" <?php echo is_array( $popup_subscription_posts ) && in_array( 'all', $popup_subscription_posts ) ? 'selected' : ''; ?>>
                    All
                </option>
                <?php if ( ! empty( $posts ) ): ?>
                    <?php foreach ( $posts as $post ): ?>
                        <option value="<?php echo $post['post_id']; ?>" <?php echo is_array( $popup_subscription_posts ) && in_array( $post['post_id'], $popup_subscription_posts ) ? 'selected' : ''; ?>><?php echo $post['post_name']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="popups-settings_wrapper">
            <label for="popup_subscription_pages">Pages, where show subscription popup</label>
            <select name="popup_subscription_pages[]" id="popup_subscription_pages" multiple>
                <option value="all" <?php echo is_array( $popup_subscription_pages ) && in_array( 'all', $popup_subscription_pages ) ? 'selected' : ''; ?>>
                    All
                </option>
                <?php if ( ! empty( $pages ) ): ?>
                    <?php foreach ( $pages as $page ): ?>
                        <option value="<?php echo $page['post_id']; ?>" <?php echo is_array( $popup_subscription_pages ) && in_array( $page['post_id'], $popup_subscription_pages ) ? 'selected' : ''; ?>><?php echo $page['post_name']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="popups-settings_wrapper">
            <label for="popup_subscription_archive">Show on archive pages</label>
            <input type="checkbox" name="popup_subscription_archive"
                   id="popup_subscription_archive" <?php echo ! empty( $popup_subscription_archive ) ? 'checked' : ''; ?>>
        </div>

        <hr>

        <div class="popups-settings_wrapper">
            <label for="popup_offset_time">Time offset (in sec)</label>
            <input type="number" name="popup_offset_time" id="popup_offset_time"
                   value="<?php echo $popup_offset_time; ?>" min="0">
        </div>

        <div class="popups-settings_wrapper">
            <label for="popup_emails">Mails to which to send data from the form (comma-separated list)</label>
            <input type="text" name="popup_emails" id="popup_emails"
                   value="<?php echo $popup_emails; ?>">
        </div>

        <input type="hidden" name="action" value="proxima_save_popups_options"/>
        <?php wp_nonce_field( 'proxima_save_popups_options_nonce', 'proxima_save_popups_options_nonce' ); ?>

        <button type="submit" class="button button-primary">Save changes</button>
    </form>
</div>