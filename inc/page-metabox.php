<?php
/**
 * tsm metabox for page
 * @package tsm
 */

 /**
 * Calls the class on the post edit screen.
 */
function tms_metabox() {
    new tmsMetabox();
}

if ( is_admin() ) {
    add_action( 'load-post.php',     'tms_metabox' );
    add_action( 'load-post-new.php', 'tms_metabox' );
}

/**
 * The Class.
 */
class tmsMetabox {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'page' );

        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'tms_meta_box_name',
                __( 'Page Setting: Button Text', 'tms' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'advanced',
                'high'
            );
        }
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST['tms_inner_custom_box_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['tms_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'tms_inner_custom_box' ) ) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST['tms_page_button_text'] );

        // Update the meta field.
        update_post_meta( $post_id, '_tms_page_button_text', $mydata );
    }


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'tms_inner_custom_box', 'tms_inner_custom_box_nonce' );

        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, '_tms_page_button_text', true );

        // Display the form, using the current value.
        ?>
        <label for="tms_page_button_text">
            <?php _e( 'The button text for Involved section on front page.', 'tms' ); ?>
        </label><br>
        <input type="text" id="tms_page_button_text" name="tms_page_button_text" value="<?php echo esc_attr( $value ); ?>" size="50" />
        <?php
    }
}
