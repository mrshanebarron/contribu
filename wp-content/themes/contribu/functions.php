<?php
/**
 * Contribu Theme Functions
 * Wedding Group-Funding Gift Registry
 */

// Theme Setup
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
    add_image_size('gift-card', 600, 400, true);
    add_image_size('wedding-hero', 1200, 600, true);

    register_nav_menus([
        'primary' => 'Primary Navigation',
        'footer' => 'Footer Navigation',
    ]);
});

// Enqueue Fonts + CDN
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('contribu-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap', [], null);
    wp_enqueue_style('contribu-style', get_stylesheet_uri(), [], '1.0.0');
});

// Remove admin bar on front end
add_filter('show_admin_bar', '__return_false');

// ===== Custom Post Types =====

// Weddings CPT
add_action('init', function () {
    register_post_type('wedding', [
        'labels' => [
            'name' => 'Weddings',
            'singular_name' => 'Wedding',
            'add_new_item' => 'Add New Wedding',
            'edit_item' => 'Edit Wedding',
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'wedding'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-heart',
        'show_in_rest' => true,
    ]);
});

// Gifts CPT
add_action('init', function () {
    register_post_type('gift', [
        'labels' => [
            'name' => 'Gifts',
            'singular_name' => 'Gift',
            'add_new_item' => 'Add New Gift',
            'edit_item' => 'Edit Gift',
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'gift'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-gifts',
        'show_in_rest' => true,
    ]);
});

// RSVPs CPT
add_action('init', function () {
    register_post_type('rsvp', [
        'labels' => [
            'name' => 'RSVPs',
            'singular_name' => 'RSVP',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title'],
        'menu_icon' => 'dashicons-yes-alt',
    ]);
});

// Contributions CPT (payment tracking)
add_action('init', function () {
    register_post_type('contribution', [
        'labels' => [
            'name' => 'Contributions',
            'singular_name' => 'Contribution',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title'],
        'menu_icon' => 'dashicons-money-alt',
    ]);
});

// Gift Priority taxonomy
add_action('init', function () {
    register_taxonomy('gift_priority', 'gift', [
        'labels' => [
            'name' => 'Priority Levels',
            'singular_name' => 'Priority',
        ],
        'public' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
    ]);
});

// ===== Meta Boxes =====

// Wedding Meta Box
add_action('add_meta_boxes', function () {
    add_meta_box('wedding_details', 'Wedding Details', 'contribu_wedding_meta_box', 'wedding', 'normal', 'high');
});

function contribu_wedding_meta_box($post) {
    wp_nonce_field('contribu_wedding_nonce', 'contribu_wedding_nonce_field');
    $meta = [
        'partner_1' => get_post_meta($post->ID, '_contribu_partner_1', true),
        'partner_2' => get_post_meta($post->ID, '_contribu_partner_2', true),
        'wedding_date' => get_post_meta($post->ID, '_contribu_wedding_date', true),
        'venue' => get_post_meta($post->ID, '_contribu_venue', true),
        'message' => get_post_meta($post->ID, '_contribu_message', true),
        'email' => get_post_meta($post->ID, '_contribu_email', true),
    ];
    ?>
    <table class="form-table">
        <tr><th><label>Partner 1 Name</label></th><td><input type="text" name="contribu_partner_1" value="<?php echo esc_attr($meta['partner_1']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Partner 2 Name</label></th><td><input type="text" name="contribu_partner_2" value="<?php echo esc_attr($meta['partner_2']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Wedding Date</label></th><td><input type="date" name="contribu_wedding_date" value="<?php echo esc_attr($meta['wedding_date']); ?>"></td></tr>
        <tr><th><label>Venue</label></th><td><input type="text" name="contribu_venue" value="<?php echo esc_attr($meta['venue']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Welcome Message</label></th><td><textarea name="contribu_message" rows="3" class="large-text"><?php echo esc_textarea($meta['message']); ?></textarea></td></tr>
        <tr><th><label>Contact Email</label></th><td><input type="email" name="contribu_email" value="<?php echo esc_attr($meta['email']); ?>" class="regular-text"></td></tr>
    </table>
    <?php
}

add_action('save_post_wedding', function ($post_id) {
    if (!isset($_POST['contribu_wedding_nonce_field']) || !wp_verify_nonce($_POST['contribu_wedding_nonce_field'], 'contribu_wedding_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $fields = ['partner_1', 'partner_2', 'wedding_date', 'venue', 'message', 'email'];
    foreach ($fields as $field) {
        if (isset($_POST['contribu_' . $field])) {
            update_post_meta($post_id, '_contribu_' . $field, sanitize_text_field($_POST['contribu_' . $field]));
        }
    }
});

// Gift Meta Box
add_action('add_meta_boxes', function () {
    add_meta_box('gift_details', 'Gift Details', 'contribu_gift_meta_box', 'gift', 'normal', 'high');
});

function contribu_gift_meta_box($post) {
    wp_nonce_field('contribu_gift_nonce', 'contribu_gift_nonce_field');
    $meta = [
        'goal_amount' => get_post_meta($post->ID, '_contribu_goal_amount', true),
        'raised_amount' => get_post_meta($post->ID, '_contribu_raised_amount', true),
        'priority' => get_post_meta($post->ID, '_contribu_priority', true),
        'wedding_id' => get_post_meta($post->ID, '_contribu_wedding_id', true),
    ];
    $weddings = get_posts(['post_type' => 'wedding', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC']);
    ?>
    <table class="form-table">
        <tr>
            <th><label>Wedding</label></th>
            <td>
                <select name="contribu_wedding_id">
                    <option value="">— Select Wedding —</option>
                    <?php foreach ($weddings as $w) : ?>
                        <option value="<?php echo $w->ID; ?>" <?php selected($meta['wedding_id'], $w->ID); ?>><?php echo esc_html($w->post_title); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr><th><label>Goal Amount (AUD)</label></th><td><input type="number" step="0.01" name="contribu_goal_amount" value="<?php echo esc_attr($meta['goal_amount']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Raised Amount (AUD)</label></th><td><input type="number" step="0.01" name="contribu_raised_amount" value="<?php echo esc_attr($meta['raised_amount'] ?: '0'); ?>" class="regular-text"></td></tr>
        <tr>
            <th><label>Priority</label></th>
            <td>
                <select name="contribu_priority">
                    <option value="high" <?php selected($meta['priority'], 'high'); ?>>High</option>
                    <option value="medium" <?php selected($meta['priority'], 'medium'); ?>>Medium</option>
                    <option value="low" <?php selected($meta['priority'], 'low'); ?>>Low</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post_gift', function ($post_id) {
    if (!isset($_POST['contribu_gift_nonce_field']) || !wp_verify_nonce($_POST['contribu_gift_nonce_field'], 'contribu_gift_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $fields = ['goal_amount', 'raised_amount', 'priority', 'wedding_id'];
    foreach ($fields as $field) {
        if (isset($_POST['contribu_' . $field])) {
            update_post_meta($post_id, '_contribu_' . $field, sanitize_text_field($_POST['contribu_' . $field]));
        }
    }
});

// RSVP Meta Box
add_action('add_meta_boxes', function () {
    add_meta_box('rsvp_details', 'RSVP Details', 'contribu_rsvp_meta_box', 'rsvp', 'normal', 'high');
});

function contribu_rsvp_meta_box($post) {
    wp_nonce_field('contribu_rsvp_nonce', 'contribu_rsvp_nonce_field');
    $meta = [
        'guest_name' => get_post_meta($post->ID, '_contribu_guest_name', true),
        'guest_email' => get_post_meta($post->ID, '_contribu_guest_email', true),
        'attending' => get_post_meta($post->ID, '_contribu_attending', true),
        'guests_count' => get_post_meta($post->ID, '_contribu_guests_count', true),
        'dietary' => get_post_meta($post->ID, '_contribu_dietary', true),
        'message' => get_post_meta($post->ID, '_contribu_rsvp_message', true),
        'wedding_id' => get_post_meta($post->ID, '_contribu_wedding_id', true),
    ];
    ?>
    <table class="form-table">
        <tr><th><label>Guest Name</label></th><td><input type="text" name="contribu_guest_name" value="<?php echo esc_attr($meta['guest_name']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Email</label></th><td><input type="email" name="contribu_guest_email" value="<?php echo esc_attr($meta['guest_email']); ?>" class="regular-text"></td></tr>
        <tr>
            <th><label>Attending</label></th>
            <td>
                <select name="contribu_attending">
                    <option value="yes" <?php selected($meta['attending'], 'yes'); ?>>Yes, attending</option>
                    <option value="no" <?php selected($meta['attending'], 'no'); ?>>Unable to attend</option>
                </select>
            </td>
        </tr>
        <tr><th><label>Number of Guests</label></th><td><input type="number" min="1" max="10" name="contribu_guests_count" value="<?php echo esc_attr($meta['guests_count'] ?: '1'); ?>"></td></tr>
        <tr><th><label>Dietary Requirements</label></th><td><input type="text" name="contribu_dietary" value="<?php echo esc_attr($meta['dietary']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Message</label></th><td><textarea name="contribu_rsvp_message" rows="3" class="large-text"><?php echo esc_textarea($meta['message']); ?></textarea></td></tr>
    </table>
    <?php
}

add_action('save_post_rsvp', function ($post_id) {
    if (!isset($_POST['contribu_rsvp_nonce_field']) || !wp_verify_nonce($_POST['contribu_rsvp_nonce_field'], 'contribu_rsvp_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $fields = ['guest_name', 'guest_email', 'attending', 'guests_count', 'dietary', 'rsvp_message', 'wedding_id'];
    foreach ($fields as $field) {
        if (isset($_POST['contribu_' . $field])) {
            update_post_meta($post_id, '_contribu_' . $field, sanitize_text_field($_POST['contribu_' . $field]));
        }
    }
});

// Contribution Meta Box
add_action('add_meta_boxes', function () {
    add_meta_box('contribution_details', 'Contribution Details', 'contribu_contribution_meta_box', 'contribution', 'normal', 'high');
});

function contribu_contribution_meta_box($post) {
    wp_nonce_field('contribu_contribution_nonce', 'contribu_contribution_nonce_field');
    $meta = [
        'amount' => get_post_meta($post->ID, '_contribu_amount', true),
        'gift_id' => get_post_meta($post->ID, '_contribu_gift_id', true),
        'donor_name' => get_post_meta($post->ID, '_contribu_donor_name', true),
        'donor_email' => get_post_meta($post->ID, '_contribu_donor_email', true),
        'message' => get_post_meta($post->ID, '_contribu_donor_message', true),
        'status' => get_post_meta($post->ID, '_contribu_payment_status', true),
    ];
    ?>
    <table class="form-table">
        <tr><th><label>Amount (AUD)</label></th><td><input type="number" step="0.01" name="contribu_amount" value="<?php echo esc_attr($meta['amount']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Donor Name</label></th><td><input type="text" name="contribu_donor_name" value="<?php echo esc_attr($meta['donor_name']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Donor Email</label></th><td><input type="email" name="contribu_donor_email" value="<?php echo esc_attr($meta['donor_email']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Gift</label></th><td><input type="text" name="contribu_gift_id" value="<?php echo esc_attr($meta['gift_id']); ?>" class="regular-text"></td></tr>
        <tr><th><label>Message</label></th><td><textarea name="contribu_donor_message" rows="2" class="large-text"><?php echo esc_textarea($meta['message']); ?></textarea></td></tr>
        <tr>
            <th><label>Payment Status</label></th>
            <td>
                <select name="contribu_payment_status">
                    <option value="completed" <?php selected($meta['status'], 'completed'); ?>>Completed</option>
                    <option value="pending" <?php selected($meta['status'], 'pending'); ?>>Pending</option>
                    <option value="failed" <?php selected($meta['status'], 'failed'); ?>>Failed</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post_contribution', function ($post_id) {
    if (!isset($_POST['contribu_contribution_nonce_field']) || !wp_verify_nonce($_POST['contribu_contribution_nonce_field'], 'contribu_contribution_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $fields = ['amount', 'gift_id', 'donor_name', 'donor_email', 'donor_message', 'payment_status'];
    foreach ($fields as $field) {
        if (isset($_POST['contribu_' . $field])) {
            update_post_meta($post_id, '_contribu_' . $field, sanitize_text_field($_POST['contribu_' . $field]));
        }
    }
});

// ===== Helper Functions =====

function contribu_get_gift_progress($gift_id) {
    $goal = floatval(get_post_meta($gift_id, '_contribu_goal_amount', true));
    $raised = floatval(get_post_meta($gift_id, '_contribu_raised_amount', true));
    $percent = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
    return [
        'goal' => $goal,
        'raised' => $raised,
        'percent' => $percent,
    ];
}

function contribu_get_wedding_gifts($wedding_id) {
    return get_posts([
        'post_type' => 'gift',
        'posts_per_page' => -1,
        'meta_key' => '_contribu_wedding_id',
        'meta_value' => $wedding_id,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
}

function contribu_get_wedding_rsvps($wedding_id) {
    return get_posts([
        'post_type' => 'rsvp',
        'posts_per_page' => -1,
        'meta_key' => '_contribu_wedding_id',
        'meta_value' => $wedding_id,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
}

function contribu_format_aud($amount) {
    return '$' . number_format($amount, 0) . ' AUD';
}

// ===== AJAX: Gift Submission (Front-End Form) =====
add_action('wp_ajax_contribu_submit_gift', 'contribu_handle_gift_submission');
add_action('wp_ajax_nopriv_contribu_submit_gift', 'contribu_handle_gift_submission');

function contribu_handle_gift_submission() {
    check_ajax_referer('contribu_gift_form', 'nonce');

    $title = sanitize_text_field($_POST['gift_title'] ?? '');
    $description = sanitize_textarea_field($_POST['gift_description'] ?? '');
    $goal = floatval($_POST['goal_amount'] ?? 0);
    $priority = sanitize_text_field($_POST['priority'] ?? 'medium');
    $wedding_id = intval($_POST['wedding_id'] ?? 0);

    if (!$title || !$goal || !$wedding_id) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    $gift_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $description,
        'post_type' => 'gift',
        'post_status' => 'publish',
    ]);

    if (is_wp_error($gift_id)) {
        wp_send_json_error(['message' => 'Failed to create gift.']);
    }

    update_post_meta($gift_id, '_contribu_goal_amount', $goal);
    update_post_meta($gift_id, '_contribu_raised_amount', 0);
    update_post_meta($gift_id, '_contribu_priority', $priority);
    update_post_meta($gift_id, '_contribu_wedding_id', $wedding_id);

    // Handle image upload
    if (!empty($_FILES['gift_image']) && $_FILES['gift_image']['error'] === UPLOAD_ERR_OK) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        $attachment_id = media_handle_upload('gift_image', $gift_id);
        if (!is_wp_error($attachment_id)) {
            set_post_thumbnail($gift_id, $attachment_id);
        }
    }

    wp_send_json_success(['message' => 'Gift created successfully!', 'gift_id' => $gift_id]);
}

// ===== AJAX: RSVP Submission =====
add_action('wp_ajax_contribu_submit_rsvp', 'contribu_handle_rsvp_submission');
add_action('wp_ajax_nopriv_contribu_submit_rsvp', 'contribu_handle_rsvp_submission');

function contribu_handle_rsvp_submission() {
    check_ajax_referer('contribu_rsvp_form', 'nonce');

    $name = sanitize_text_field($_POST['guest_name'] ?? '');
    $email = sanitize_email($_POST['guest_email'] ?? '');
    $attending = sanitize_text_field($_POST['attending'] ?? 'yes');
    $guests = intval($_POST['guests_count'] ?? 1);
    $dietary = sanitize_text_field($_POST['dietary'] ?? '');
    $message = sanitize_textarea_field($_POST['rsvp_message'] ?? '');
    $wedding_id = intval($_POST['wedding_id'] ?? 0);

    if (!$name || !$email || !$wedding_id) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    $rsvp_id = wp_insert_post([
        'post_title' => $name . ' — ' . ($attending === 'yes' ? 'Attending' : 'Not Attending'),
        'post_type' => 'rsvp',
        'post_status' => 'publish',
    ]);

    update_post_meta($rsvp_id, '_contribu_guest_name', $name);
    update_post_meta($rsvp_id, '_contribu_guest_email', $email);
    update_post_meta($rsvp_id, '_contribu_attending', $attending);
    update_post_meta($rsvp_id, '_contribu_guests_count', $guests);
    update_post_meta($rsvp_id, '_contribu_dietary', $dietary);
    update_post_meta($rsvp_id, '_contribu_rsvp_message', $message);
    update_post_meta($rsvp_id, '_contribu_wedding_id', $wedding_id);

    wp_send_json_success(['message' => 'RSVP submitted successfully!']);
}

// ===== AJAX: Contribution (Stripe Demo) =====
add_action('wp_ajax_contribu_make_contribution', 'contribu_handle_contribution');
add_action('wp_ajax_nopriv_contribu_make_contribution', 'contribu_handle_contribution');

function contribu_handle_contribution() {
    check_ajax_referer('contribu_contribution_form', 'nonce');

    $amount = floatval($_POST['amount'] ?? 0);
    $gift_id = intval($_POST['gift_id'] ?? 0);
    $donor_name = sanitize_text_field($_POST['donor_name'] ?? '');
    $donor_email = sanitize_email($_POST['donor_email'] ?? '');
    $message = sanitize_textarea_field($_POST['donor_message'] ?? '');

    if (!$amount || !$gift_id || !$donor_name) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    // Create contribution record
    $contribution_id = wp_insert_post([
        'post_title' => $donor_name . ' — $' . number_format($amount, 2) . ' AUD',
        'post_type' => 'contribution',
        'post_status' => 'publish',
    ]);

    update_post_meta($contribution_id, '_contribu_amount', $amount);
    update_post_meta($contribution_id, '_contribu_gift_id', $gift_id);
    update_post_meta($contribution_id, '_contribu_donor_name', $donor_name);
    update_post_meta($contribution_id, '_contribu_donor_email', $donor_email);
    update_post_meta($contribution_id, '_contribu_donor_message', $message);
    update_post_meta($contribution_id, '_contribu_payment_status', 'completed');

    // Update gift raised amount
    $current_raised = floatval(get_post_meta($gift_id, '_contribu_raised_amount', true));
    update_post_meta($gift_id, '_contribu_raised_amount', $current_raised + $amount);

    wp_send_json_success([
        'message' => 'Thank you for your generous contribution!',
        'new_raised' => $current_raised + $amount,
    ]);
}

// ===== AJAX: Contact Form =====
add_action('wp_ajax_contribu_contact', 'contribu_handle_contact');
add_action('wp_ajax_nopriv_contribu_contact', 'contribu_handle_contact');

function contribu_handle_contact() {
    check_ajax_referer('contribu_contact_form', 'nonce');

    $name = sanitize_text_field($_POST['contact_name'] ?? '');
    $email = sanitize_email($_POST['contact_email'] ?? '');
    $subject = sanitize_text_field($_POST['contact_subject'] ?? '');
    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');

    if (!$name || !$email || !$message) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    // Store as a post for demo purposes
    wp_insert_post([
        'post_title' => $name . ' — ' . $subject,
        'post_content' => $message . "\n\nFrom: " . $email,
        'post_type' => 'page',
        'post_status' => 'draft',
    ]);

    wp_send_json_success(['message' => 'Message sent! We\'ll get back to you within 24 hours.']);
}

// Pass AJAX URL to front-end
add_action('wp_footer', function () {
    echo '<script>var contribuAjax = ' . json_encode([
        'url' => admin_url('admin-ajax.php'),
        'giftNonce' => wp_create_nonce('contribu_gift_form'),
        'rsvpNonce' => wp_create_nonce('contribu_rsvp_form'),
        'contributionNonce' => wp_create_nonce('contribu_contribution_form'),
        'contactNonce' => wp_create_nonce('contribu_contact_form'),
    ]) . ';</script>';
});
