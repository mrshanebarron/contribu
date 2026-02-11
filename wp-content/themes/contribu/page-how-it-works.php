<?php
/* Template Name: How It Works */
get_header();
?>

<div class="page-header">
    <div class="container">
        <h1>How Contribu Works</h1>
        <p>From setup to celebration — here's your journey with Contribu.</p>
    </div>
</div>

<!-- Steps Detail -->
<section class="section">
    <div class="container">
        <div class="steps-grid" style="grid-template-columns: 1fr;">
            <?php
            $steps = [
                [
                    'num' => '1',
                    'title' => 'Create Your Wedding Page',
                    'desc' => 'Sign up for free and build your personalised wedding page. Add your names, wedding date, venue details, and a message to your guests. Upload couple photos and choose from beautiful page layouts.',
                    'features' => ['Custom URL for your wedding page', 'Upload engagement & couple photos', 'Write a personalised welcome message', 'Add venue and date details'],
                    'img' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=700&q=80',
                ],
                [
                    'num' => '2',
                    'title' => 'Add Your Gift Wishlist',
                    'desc' => 'Use our simple front-end form to add gifts to your registry. Upload a photo, set a funding goal, write a description, and mark priority levels. Add as many gifts as you like — from practical items to dream experiences.',
                    'features' => ['Drag-and-drop image upload', 'Set AUD goal amounts for each gift', 'Write personal descriptions', 'Assign priority: High, Medium, or Low'],
                    'img' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=700&q=80',
                ],
                [
                    'num' => '3',
                    'title' => 'Share Your Registry Link',
                    'desc' => 'Copy your unique Contribu link and share it with your wedding invitations, on social media, or via email. Your guests will see a beautiful page with your story, gifts, and an easy way to contribute.',
                    'features' => ['Unique, shareable wedding page URL', 'Looks stunning on phones and tablets', 'Built-in RSVP form for guests', 'Real-time progress tracking'],
                    'img' => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=700&q=80',
                ],
                [
                    'num' => '4',
                    'title' => 'Receive Contributions Securely',
                    'desc' => 'Guests choose a gift, enter their contribution amount, and pay securely via Stripe. All transactions are in Australian dollars. Funds are deposited directly into your nominated bank account.',
                    'features' => ['Stripe-powered secure payments', 'All amounts in AUD', 'Guests can leave personal messages', 'Instant confirmation emails'],
                    'img' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=700&q=80',
                ],
            ];
            foreach ($steps as $i => $step) :
                $reverse = $i % 2 === 1;
            ?>
            <div class="couple-preview reveal" style="<?php echo $reverse ? 'direction: rtl;' : ''; ?>">
                <div style="<?php echo $reverse ? 'direction: ltr;' : ''; ?>">
                    <img src="<?php echo $step['img']; ?>" alt="<?php echo esc_attr($step['title']); ?>" style="border-radius: var(--radius-xl); box-shadow: var(--shadow-md);">
                </div>
                <div style="<?php echo $reverse ? 'direction: ltr;' : ''; ?>">
                    <div style="display: inline-flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div class="step-number"><?php echo $step['num']; ?></div>
                        <h2 style="font-size: 1.5rem;"><?php echo $step['title']; ?></h2>
                    </div>
                    <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 20px;"><?php echo $step['desc']; ?></p>
                    <ul class="couple-features">
                        <?php foreach ($step['features'] as $f) : ?>
                        <li>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span><?php echo $f; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php if ($i < count($steps) - 1) : ?>
            <div style="height: 1px; background: var(--border-light); margin: 20px 0;"></div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section" style="background: var(--cream-dark);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Questions?</span>
            <h2>Frequently Asked Questions</h2>
        </div>

        <div style="max-width: 700px; margin: 48px auto 0;" x-data="{ active: null }">
            <?php
            $faqs = [
                ['q' => 'Is Contribu free to use?', 'a' => 'Yes! Creating your wedding page and gift registry is completely free. There is a small processing fee on contributions (Stripe\'s standard rate of 1.75% + 30c per transaction) which ensures secure, reliable payments.'],
                ['q' => 'How do I receive the funds?', 'a' => 'Funds from contributions are deposited directly into your nominated Australian bank account via Stripe. You\'ll receive payouts on a rolling basis — typically within 2-3 business days of each contribution.'],
                ['q' => 'Can guests contribute any amount?', 'a' => 'Absolutely! Guests can choose how much they want to contribute toward any gift. Whether it\'s $20 or $200, every contribution counts and moves the progress bar forward.'],
                ['q' => 'What happens if a gift is over-funded?', 'a' => 'That\'s great news! If a gift reaches its goal, it will show as "Fully Funded" and guests will be directed to other gifts on your registry. Any excess contributions are still deposited to your account.'],
                ['q' => 'Can I edit or remove gifts after creating them?', 'a' => 'Yes! You can update gift descriptions, photos, goal amounts, and priority levels at any time. You can also remove gifts that are no longer needed.'],
                ['q' => 'Do guests need to create an account?', 'a' => 'No. Guests can contribute without creating an account. They simply enter their name, email (for the receipt), choose an amount, and pay via Stripe. Quick and easy.'],
            ];
            foreach ($faqs as $i => $faq) :
            ?>
            <div class="reveal" style="border-bottom: 1px solid var(--border); padding: 20px 0;">
                <button @click="active = active === <?php echo $i; ?> ? null : <?php echo $i; ?>" style="width: 100%; display: flex; justify-content: space-between; align-items: center; background: none; border: none; cursor: pointer; font-family: inherit; font-size: 1rem; font-weight: 600; color: var(--text-primary); text-align: left; padding: 0;">
                    <span><?php echo $faq['q']; ?></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" :style="active === <?php echo $i; ?> ? 'transform: rotate(180deg)' : ''" style="transition: transform 0.3s; flex-shrink: 0; margin-left: 16px;"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="active === <?php echo $i; ?>" x-collapse style="overflow: hidden;">
                    <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.7; padding-top: 12px;"><?php echo $faq['a']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
