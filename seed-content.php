<?php
/**
 * Contribu Seed Content
 * Run via WP-CLI: wp eval-file seed-content.php
 */

echo "=== Contribu Content Seeder ===\n\n";

// Create pages
$pages = [
    'Home' => ['content' => '', 'template' => ''],
    'How It Works' => ['content' => '', 'template' => 'page-how-it-works.php'],
    'Create Registry' => ['content' => '', 'template' => 'page-create-registry.php'],
    'Sample Registry' => ['content' => '', 'template' => 'page-sample-registry.php'],
    'Contact' => ['content' => '', 'template' => 'page-contact.php'],
    'Privacy Policy' => [
        'content' => '<h2>Privacy Policy</h2><p>Last updated: ' . date('F Y') . '</p><p>Contribu ("we", "us", or "our") operates the contribu.com.au website. This page informs you of our policies regarding the collection, use, and disclosure of personal information.</p><h3>Information We Collect</h3><p>We collect information you provide when creating a wedding registry, making contributions, or contacting us. This includes names, email addresses, wedding details, and payment information processed securely through Stripe.</p><h3>How We Use Your Information</h3><p>Your information is used to provide our registry services, process contributions, and communicate about your account. We never sell your personal data to third parties.</p><h3>Payment Security</h3><p>All payment processing is handled by Stripe. We never store credit card numbers on our servers. Stripe is PCI-DSS Level 1 certified.</p><h3>Contact Us</h3><p>If you have questions about this Privacy Policy, email us at hello@contribu.com.au.</p>',
        'template' => '',
    ],
    'Terms of Service' => [
        'content' => '<h2>Terms of Service</h2><p>Last updated: ' . date('F Y') . '</p><p>These Terms govern your use of the Contribu platform. By using our service, you agree to these terms.</p><h3>Service Description</h3><p>Contribu provides an online wedding gift registry platform where couples can create gift wishlists and guests can contribute toward gift funding goals.</p><h3>User Accounts</h3><p>Couples are responsible for the accuracy of their registry information. All gift descriptions and images must be appropriate and non-offensive.</p><h3>Payments & Refunds</h3><p>Contributions are processed via Stripe in Australian Dollars (AUD). Standard Stripe processing fees apply. Refunds may be requested within 30 days of contribution.</p><h3>Contact</h3><p>For questions about these Terms, email hello@contribu.com.au.</p>',
        'template' => '',
    ],
];

foreach ($pages as $title => $config) {
    $existing = get_page_by_title($title, OBJECT, 'page');
    if ($existing) {
        echo "Page '{$title}' already exists (ID: {$existing->ID})\n";
        if ($config['template']) {
            update_post_meta($existing->ID, '_wp_page_template', $config['template']);
        }
        continue;
    }
    $page_id = wp_insert_post([
        'post_title' => $title,
        'post_content' => $config['content'],
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => sanitize_title($title),
    ]);
    if ($config['template']) {
        update_post_meta($page_id, '_wp_page_template', $config['template']);
    }
    echo "Created page '{$title}' (ID: {$page_id})\n";
}

// Set homepage
$home = get_page_by_title('Home', OBJECT, 'page');
if ($home) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home->ID);
    echo "\nSet 'Home' as front page\n";
}

// Create sample wedding
echo "\n--- Sample Wedding ---\n";
$wedding_title = 'Emma & Josh';
$existing_wedding = get_page_by_title($wedding_title, OBJECT, 'wedding');
if ($existing_wedding) {
    $wedding_id = $existing_wedding->ID;
    echo "Wedding '{$wedding_title}' already exists (ID: {$wedding_id})\n";
} else {
    $wedding_id = wp_insert_post([
        'post_title' => $wedding_title,
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'wedding',
        'post_name' => 'emma-josh',
    ]);
    update_post_meta($wedding_id, '_contribu_partner_1', 'Emma');
    update_post_meta($wedding_id, '_contribu_partner_2', 'Josh');
    update_post_meta($wedding_id, '_contribu_wedding_date', '2026-11-15');
    update_post_meta($wedding_id, '_contribu_venue', 'The Royal Botanic Gardens, Sydney');
    update_post_meta($wedding_id, '_contribu_message', "We're so excited to celebrate our special day with you! Instead of traditional gifts, we'd love your help in building our new life together. Every contribution — big or small — means the world to us.");
    update_post_meta($wedding_id, '_contribu_email', 'emma.josh@example.com');
    echo "Created wedding '{$wedding_title}' (ID: {$wedding_id})\n";
}

// Create sample gifts
$gifts = [
    [
        'title' => 'Honeymoon Fund',
        'content' => "Help us explore the Amalfi Coast — our dream honeymoon destination. We've been planning this trip for years and would love your help making it unforgettable.",
        'goal' => 3000,
        'raised' => 2340,
        'priority' => 'high',
    ],
    [
        'title' => 'KitchenAid Artisan Mixer',
        'content' => "The heart of our new kitchen. We love baking together on Sunday mornings and this mixer would make our banana bread recipe even better.",
        'goal' => 899,
        'raised' => 699,
        'priority' => 'high',
    ],
    [
        'title' => 'Dyson V15 Vacuum',
        'content' => "Our first home deserves a proper clean. We know it's practical, but it's something we really need as we set up our new place.",
        'goal' => 1099,
        'raised' => 450,
        'priority' => 'medium',
    ],
    [
        'title' => 'Le Creuset Dutch Oven',
        'content' => "For the slow-cooked Sunday roasts we plan to share with friends and family. The Flame colour would match our kitchen perfectly.",
        'goal' => 599,
        'raised' => 599,
        'priority' => 'medium',
    ],
    [
        'title' => 'Garden Dining Setting',
        'content' => "A beautiful outdoor dining set for our back deck. Perfect for the summer barbecues and dinner parties we love hosting.",
        'goal' => 1200,
        'raised' => 380,
        'priority' => 'low',
    ],
    [
        'title' => 'Wine Fridge',
        'content' => "For the Barossa Valley wines we plan to collect on our honeymoon detour. Josh has been dreaming about this since the engagement.",
        'goal' => 800,
        'raised' => 200,
        'priority' => 'low',
    ],
];

echo "\n--- Gifts ---\n";
foreach ($gifts as $g) {
    $existing = get_page_by_title($g['title'], OBJECT, 'gift');
    if ($existing) {
        echo "Gift '{$g['title']}' already exists\n";
        continue;
    }
    $gift_id = wp_insert_post([
        'post_title' => $g['title'],
        'post_content' => $g['content'],
        'post_status' => 'publish',
        'post_type' => 'gift',
    ]);
    update_post_meta($gift_id, '_contribu_goal_amount', $g['goal']);
    update_post_meta($gift_id, '_contribu_raised_amount', $g['raised']);
    update_post_meta($gift_id, '_contribu_priority', $g['priority']);
    update_post_meta($gift_id, '_contribu_wedding_id', $wedding_id);
    echo "Created gift '{$g['title']}' (ID: {$gift_id}) — \${$g['raised']}/\${$g['goal']} AUD\n";
}

// Create sample RSVPs
$rsvps = [
    ['name' => 'Tom & Sarah Mitchell', 'email' => 'tom.sarah@example.com', 'attending' => 'yes', 'guests' => 2, 'dietary' => 'Vegetarian (Sarah)', 'message' => 'So excited for you both! Counting down the days!'],
    ['name' => 'Mei Lin', 'email' => 'mei@example.com', 'attending' => 'yes', 'guests' => 1, 'dietary' => 'Gluten-free', 'message' => 'Congratulations! I can\'t wait to celebrate with you.'],
    ['name' => 'David & Kate Chen', 'email' => 'dkchen@example.com', 'attending' => 'yes', 'guests' => 2, 'dietary' => '', 'message' => 'We\'ll be there with bells on!'],
    ['name' => 'Patrick O\'Brien', 'email' => 'pat@example.com', 'attending' => 'no', 'guests' => 1, 'dietary' => '', 'message' => 'So sorry to miss it — will be overseas. Sending all the love!'],
];

echo "\n--- RSVPs ---\n";
foreach ($rsvps as $r) {
    $rsvp_title = $r['name'] . ' — ' . ($r['attending'] === 'yes' ? 'Attending' : 'Not Attending');
    $existing = get_page_by_title($rsvp_title, OBJECT, 'rsvp');
    if ($existing) {
        echo "RSVP '{$r['name']}' already exists\n";
        continue;
    }
    $rsvp_id = wp_insert_post([
        'post_title' => $rsvp_title,
        'post_type' => 'rsvp',
        'post_status' => 'publish',
    ]);
    update_post_meta($rsvp_id, '_contribu_guest_name', $r['name']);
    update_post_meta($rsvp_id, '_contribu_guest_email', $r['email']);
    update_post_meta($rsvp_id, '_contribu_attending', $r['attending']);
    update_post_meta($rsvp_id, '_contribu_guests_count', $r['guests']);
    update_post_meta($rsvp_id, '_contribu_dietary', $r['dietary']);
    update_post_meta($rsvp_id, '_contribu_rsvp_message', $r['message']);
    update_post_meta($rsvp_id, '_contribu_wedding_id', $wedding_id);
    echo "Created RSVP: {$r['name']} ({$r['attending']})\n";
}

// Create sample contributions
$contributions = [
    ['donor' => 'Tom Mitchell', 'email' => 'tom@example.com', 'amount' => 200, 'gift' => 'Honeymoon Fund', 'message' => 'Have an amazing time! You deserve it.'],
    ['donor' => 'Sarah Mitchell', 'email' => 'sarah@example.com', 'amount' => 150, 'gift' => 'Honeymoon Fund', 'message' => 'For the gelato budget!'],
    ['donor' => 'Mei Lin', 'email' => 'mei@example.com', 'amount' => 100, 'gift' => 'KitchenAid Artisan Mixer', 'message' => 'Looking forward to tasting that banana bread!'],
    ['donor' => 'Grandma Joan', 'email' => 'joan@example.com', 'amount' => 500, 'gift' => 'Honeymoon Fund', 'message' => 'Go make beautiful memories, darlings.'],
];

echo "\n--- Contributions ---\n";
foreach ($contributions as $c) {
    $title = $c['donor'] . ' — $' . number_format($c['amount'], 2) . ' AUD';
    $existing = get_page_by_title($title, OBJECT, 'contribution');
    if ($existing) {
        echo "Contribution from '{$c['donor']}' already exists\n";
        continue;
    }
    $contribution_id = wp_insert_post([
        'post_title' => $title,
        'post_type' => 'contribution',
        'post_status' => 'publish',
    ]);
    update_post_meta($contribution_id, '_contribu_amount', $c['amount']);
    update_post_meta($contribution_id, '_contribu_donor_name', $c['donor']);
    update_post_meta($contribution_id, '_contribu_donor_email', $c['email']);
    update_post_meta($contribution_id, '_contribu_donor_message', $c['message']);
    update_post_meta($contribution_id, '_contribu_payment_status', 'completed');
    echo "Created contribution: {$c['donor']} — \${$c['amount']} toward {$c['gift']}\n";
}

// Permalink structure
global $wp_rewrite;
$wp_rewrite->set_permalink_structure('/%postname%/');
$wp_rewrite->flush_rules(true);
echo "\nPermalinks set to /%postname%/\n";

// Site settings
update_option('blogname', 'Contribu');
update_option('blogdescription', 'Wedding Group-Funding Gift Registry');
echo "Site title and tagline updated\n";

echo "\n=== Seeding complete! ===\n";
