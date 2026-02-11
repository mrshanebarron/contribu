<?php get_header(); ?>

<!-- Hero -->
<section class="hero">
    <div class="container" style="position: relative;">
        <div class="hero-content">
            <div class="hero-badge">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M8 14C8 14 2 10 2 6C2 4 3.5 2.5 5.25 2.5C6.5 2.5 7.5 3.2 8 4.2C8.5 3.2 9.5 2.5 10.75 2.5C12.5 2.5 14 4 14 6C14 10 8 14 8 14Z" fill="#8fae8b"/></svg>
                Australia's Wedding Gift Registry
            </div>
            <h1>The gifts they <em>actually</em> want, funded by the people who love&nbsp;them</h1>
            <p>Contribu lets couples create beautiful, personalised gift registries where friends and family contribute together toward meaningful gifts — from honeymoon funds to home appliances.</p>
            <div class="hero-actions">
                <a href="<?php echo home_url('/create-registry'); ?>" class="btn-primary">
                    Create Your Registry
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="<?php echo home_url('/sample-registry'); ?>" class="btn-secondary">
                    View Sample Registry
                </a>
            </div>
        </div>

        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80" alt="Wedding couple" loading="eager">

            <div class="hero-float hero-float-gift" x-data="{ show: false }" x-init="setTimeout(() => show = true, 800)" x-show="show" x-transition.duration.600ms>
                <div class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12v10H4V12M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                </div>
                <div>
                    <div style="font-weight: 700; font-size: 0.85rem;">$450 contributed</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">toward Honeymoon Fund</div>
                </div>
            </div>

            <div class="hero-float hero-float-progress" x-data="{ show: false }" x-init="setTimeout(() => show = true, 1200)" x-show="show" x-transition.duration.600ms>
                <div style="font-size: 0.8rem; font-weight: 600;">KitchenAid Mixer</div>
                <div style="font-size: 0.75rem; color: var(--sage);">78% funded</div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill" style="width: 78%;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Numbers -->
<section class="section-sm" style="background: var(--white); border-bottom: 1px solid var(--border-light);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; text-align: center;" x-data="{ shown: false }" x-init="
            var el = $el;
            var observer = new IntersectionObserver(function(entries) {
                if (entries[0].isIntersecting) { shown = true; observer.disconnect(); }
            }, { threshold: 0.3 });
            observer.observe(el);
        ">
            <div>
                <div style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--sage);" x-text="shown ? '2,500+' : '0'">2,500+</div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Registries Created</div>
            </div>
            <div>
                <div style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--sage);" x-text="shown ? '$1.8M' : '0'">$1.8M</div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Gifts Funded</div>
            </div>
            <div>
                <div style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--sage);" x-text="shown ? '15,000+' : '0'">15,000+</div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Happy Contributors</div>
            </div>
            <div>
                <div style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--sage);" x-text="shown ? '4.9/5' : '0'">4.9/5</div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Couple Rating</div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Preview -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Simple & Beautiful</span>
            <h2>How Contribu Works</h2>
            <p>Create your dream registry in minutes. Share it with loved ones. Watch the contributions roll in.</p>
        </div>

        <div class="steps-grid">
            <div class="step-card reveal">
                <div class="step-number">1</div>
                <h3>Create Your Page</h3>
                <p>Design a beautiful wedding page with your story, photos, and personalised message for guests.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-number">2</div>
                <h3>Add Your Gifts</h3>
                <p>Upload photos, set funding goals, and describe each gift. From $50 to $5,000 — any amount works.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-number">3</div>
                <h3>Share With Guests</h3>
                <p>Send your unique registry link to friends and family. They can browse and contribute instantly.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-number">4</div>
                <h3>Receive Funds</h3>
                <p>Contributions go directly to your account via Stripe. Secure, instant, and in Australian dollars.</p>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<section class="section" style="background: var(--white);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Why Couples Love Us</span>
            <h2>More Meaningful Than Traditional Registries</h2>
            <p>No more duplicate toasters. No more store credit. Just gifts that matter.</p>
        </div>

        <div class="benefits-grid">
            <div class="benefit-card reveal">
                <div class="benefit-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 12v10H4V12M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                </div>
                <h3>Group Funding</h3>
                <p>Multiple guests contribute toward one gift. A $2,000 espresso machine becomes affordable when 20 people chip in.</p>
            </div>
            <div class="benefit-card reveal">
                <div class="benefit-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                </div>
                <h3>Secure Payments</h3>
                <p>Powered by Stripe. PCI-compliant, bank-level security. All transactions in AUD with instant confirmation.</p>
            </div>
            <div class="benefit-card reveal">
                <div class="benefit-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
                </div>
                <h3>Beautiful Pages</h3>
                <p>Your registry looks stunning on every device. Upload photos, tell your story, and share your unique page.</p>
            </div>
            <div class="benefit-card reveal">
                <div class="benefit-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3>Built-in RSVP</h3>
                <p>Guests RSVP right from your wedding page. Track attendance, dietary requirements, and plus-ones in one place.</p>
            </div>
            <div class="benefit-card reveal">
                <div class="benefit-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 15l2 2 4-4"/></svg>
                </div>
                <h3>You Choose the Gifts</h3>
                <p>No store limitations. Add anything — experiences, appliances, honeymoon funds, house deposits. You decide.</p>
            </div>
            <div class="benefit-card reveal">
                <div class="benefit-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10-4.5 10-10 10z"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 4 10 15 15 0 0 1-4 10 15 15 0 0 1-4-10A15 15 0 0 1 12 2z"/></svg>
                </div>
                <h3>100% Australian</h3>
                <p>Built for Australian couples. AUD payments, local support, and no international transaction fees.</p>
            </div>
        </div>
    </div>
</section>

<!-- Registry Preview -->
<section class="section registry-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">See It In Action</span>
            <h2>A Registry That Tells Your Story</h2>
            <p>Here's what a Contribu registry looks like. Beautiful gift cards with real-time progress tracking.</p>
        </div>

        <?php
        $gifts = get_posts(['post_type' => 'gift', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC']);
        if ($gifts) :
        ?>
        <div class="gifts-grid">
            <?php foreach ($gifts as $gift) :
                $progress = contribu_get_gift_progress($gift->ID);
                $priority = get_post_meta($gift->ID, '_contribu_priority', true) ?: 'medium';
                $thumb = get_the_post_thumbnail_url($gift->ID, 'gift-card');
            ?>
            <div class="gift-card reveal">
                <div class="gift-card-img">
                    <?php if ($thumb) : ?>
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($gift->post_title); ?>">
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--cream-dark), var(--blush-light)); display: flex; align-items: center; justify-content: center;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--blush)" stroke-width="1" opacity="0.5"><path d="M20 12v10H4V12M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                        </div>
                    <?php endif; ?>
                    <span class="gift-card-priority <?php echo $priority; ?>"><?php echo ucfirst($priority); ?> Priority</span>
                </div>
                <div class="gift-card-body">
                    <h3><?php echo esc_html($gift->post_title); ?></h3>
                    <p><?php echo esc_html(wp_trim_words($gift->post_content, 15)); ?></p>
                    <div class="gift-progress">
                        <div class="gift-progress-header">
                            <span class="gift-progress-raised"><?php echo contribu_format_aud($progress['raised']); ?></span>
                            <span class="gift-progress-goal">of <?php echo contribu_format_aud($progress['goal']); ?></span>
                        </div>
                        <div class="gift-progress-bar">
                            <div class="gift-progress-fill" data-width="<?php echo $progress['percent']; ?>%" style="width: <?php echo $progress['percent']; ?>%;"></div>
                        </div>
                    </div>
                    <button class="gift-card-btn">Contribute</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <!-- Placeholder gifts for demo -->
        <div class="gifts-grid">
            <?php
            $demo_gifts = [
                ['title' => 'Honeymoon Fund', 'desc' => 'Help us explore the Amalfi Coast — our dream honeymoon destination after years of planning.', 'goal' => 3000, 'raised' => 2340, 'priority' => 'high', 'img' => 'https://images.unsplash.com/photo-1534008897995-27a23e859048?w=600&q=80'],
                ['title' => 'KitchenAid Artisan Mixer', 'desc' => 'The heart of our new kitchen. We love baking together on Sunday mornings.', 'goal' => 899, 'raised' => 699, 'priority' => 'high', 'img' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?w=600&q=80'],
                ['title' => 'Dyson V15 Vacuum', 'desc' => 'Our first home deserves a proper clean. Practical but something we really need.', 'goal' => 1099, 'raised' => 450, 'priority' => 'medium', 'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=600&q=80'],
                ['title' => 'Le Creuset Dutch Oven', 'desc' => 'For the slow-cooked Sunday roasts we plan to share with friends and family.', 'goal' => 599, 'raised' => 599, 'priority' => 'medium', 'img' => 'https://images.unsplash.com/photo-1585837146751-a44116f9cf63?w=600&q=80'],
                ['title' => 'Garden Setting', 'desc' => 'A beautiful outdoor dining set for our back deck. Perfect for summer barbecues.', 'goal' => 1200, 'raised' => 380, 'priority' => 'low', 'img' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?w=600&q=80'],
                ['title' => 'Wine Fridge', 'desc' => 'For the Barossa Valley wines we plan to collect on our honeymoon detour.', 'goal' => 800, 'raised' => 200, 'priority' => 'low', 'img' => 'https://images.unsplash.com/photo-1474722883778-792e7990302f?w=600&q=80'],
            ];
            foreach ($demo_gifts as $dg) :
                $pct = round(($dg['raised'] / $dg['goal']) * 100);
            ?>
            <div class="gift-card reveal">
                <div class="gift-card-img">
                    <img src="<?php echo $dg['img']; ?>" alt="<?php echo esc_attr($dg['title']); ?>">
                    <span class="gift-card-priority <?php echo $dg['priority']; ?>"><?php echo ucfirst($dg['priority']); ?> Priority</span>
                </div>
                <div class="gift-card-body">
                    <h3><?php echo $dg['title']; ?></h3>
                    <p><?php echo $dg['desc']; ?></p>
                    <div class="gift-progress">
                        <div class="gift-progress-header">
                            <span class="gift-progress-raised">$<?php echo number_format($dg['raised']); ?> AUD</span>
                            <span class="gift-progress-goal">of $<?php echo number_format($dg['goal']); ?> AUD</span>
                        </div>
                        <div class="gift-progress-bar">
                            <div class="gift-progress-fill" data-width="<?php echo $pct; ?>%" style="width: <?php echo $pct; ?>%;"></div>
                        </div>
                    </div>
                    <button class="gift-card-btn"><?php echo $pct >= 100 ? 'Fully Funded!' : 'Contribute'; ?></button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Couple Showcase -->
<section class="section">
    <div class="container">
        <div class="couple-preview reveal">
            <div>
                <img src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=800&q=80" alt="Happy couple with their registry">
            </div>
            <div>
                <span class="section-label">Your Story, Your Way</span>
                <h2 style="margin-bottom: 16px;">Create Gifts That Mean Something</h2>
                <p style="color: var(--text-secondary); margin-bottom: 24px; line-height: 1.7;">With Contribu, you're not limited to a store catalogue. Add anything — from a $50 contribution toward your first date night as a married couple, to a $5,000 honeymoon fund. Upload your own photos, write personal descriptions, and set priorities so guests know what matters most.</p>
                <ul class="couple-features">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Upload photos and write personal descriptions for each gift</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Set priority levels so guests know your favourites</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Real-time progress bars show how close each gift is to being funded</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Guests leave personal messages with their contributions</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section testimonials-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Love Stories</span>
            <h2>What Couples Are Saying</h2>
        </div>

        <div class="testimonial-grid">
            <div class="testimonial-card reveal">
                <div class="testimonial-stars">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">"We didn't want another set of towels. Contribu let us ask for what we actually needed — and our guests loved being able to see exactly what they were helping us get."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar-placeholder" style="background: var(--sage);">E</div>
                    <div>
                        <div class="testimonial-name">Emma & Josh</div>
                        <div class="testimonial-role">Married December 2025, Sydney</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal">
                <div class="testimonial-stars">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">"The group funding was genius. Our KitchenAid got funded by 12 different people, and each one left the sweetest message. Way more personal than a department store voucher."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar-placeholder" style="background: var(--blush-dark);">S</div>
                    <div>
                        <div class="testimonial-name">Sarah & Michael</div>
                        <div class="testimonial-role">Married March 2026, Melbourne</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal">
                <div class="testimonial-stars">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">"Setting up took 15 minutes. Our honeymoon fund was 40% funded within the first week of sharing. The Stripe integration is seamless — money lands in your account fast."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar-placeholder" style="background: var(--gold);">L</div>
                    <div>
                        <div class="testimonial-name">Liam & Priya</div>
                        <div class="testimonial-role">Married January 2026, Brisbane</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
