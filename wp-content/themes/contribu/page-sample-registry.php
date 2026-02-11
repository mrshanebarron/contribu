<?php
/* Template Name: Sample Registry */
get_header();
?>

<!-- Wedding Hero -->
<div class="wedding-hero">
    <div class="container">
        <div style="margin-bottom: 8px;">
            <svg width="40" height="40" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 0 auto;">
                <path d="M16 28C16 28 4 20 4 12C4 8 7 5 10.5 5C13 5 15 6.5 16 8.5C17 6.5 19 5 21.5 5C25 5 28 8 28 12C28 20 16 28 16 28Z" fill="var(--blush-light)" opacity="0.5"/>
                <path d="M16 26C16 26 5 19 5 12C5 8.5 7.5 6 10.5 6C12.8 6 14.8 7.3 16 9.3C17.2 7.3 19.2 6 21.5 6C24.5 6 27 8.5 27 12C27 19 16 26 16 26Z" stroke="var(--blush)" stroke-width="1.5" fill="none"/>
            </svg>
        </div>
        <h1>Emma & Josh</h1>
        <div class="wedding-date">15 November 2026 &bull; The Royal Botanic Gardens, Sydney</div>
        <p class="wedding-message">We're so excited to celebrate our special day with you! Instead of traditional gifts, we'd love your help in building our new life together. Every contribution — big or small — means the world to us.</p>
    </div>
</div>

<!-- Photo Grid -->
<section class="section-sm" style="background: var(--cream-dark);">
    <div class="container">
        <div class="wedding-photo-grid reveal">
            <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=600&q=80" alt="Emma and Josh engagement" style="grid-row: span 2; height: 536px;">
            <img src="https://images.unsplash.com/photo-1529636798458-92182e662485?w=600&q=80" alt="Ring detail">
            <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=600&q=80" alt="Wedding venue">
        </div>
    </div>
</section>

<!-- Gift Registry -->
<section class="section" id="registry">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Our Registry</span>
            <h2>Help Us Build Our New Life</h2>
            <p>Browse our wishlist and contribute toward the gifts that speak to you.</p>
        </div>

        <?php
        $gifts = get_posts(['post_type' => 'gift', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC']);
        ?>

        <?php if ($gifts) : ?>
        <div class="gifts-grid">
            <?php foreach ($gifts as $gift) :
                $progress = contribu_get_gift_progress($gift->ID);
                $priority = get_post_meta($gift->ID, '_contribu_priority', true) ?: 'medium';
                $thumb = get_the_post_thumbnail_url($gift->ID, 'gift-card');
                $funded = $progress['percent'] >= 100;
            ?>
            <div class="gift-card reveal" x-data="contributionWidget(<?php echo $gift->ID; ?>, <?php echo $progress['raised']; ?>, <?php echo $progress['goal']; ?>)">
                <div class="gift-card-img">
                    <?php if ($thumb) : ?>
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($gift->post_title); ?>">
                    <?php else : ?>
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--cream-dark), var(--blush-light)); display: flex; align-items: center; justify-content: center;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--blush)" stroke-width="1" opacity="0.5"><path d="M20 12v10H4V12M2 7h20v5H2zM12 22V7"/></svg>
                        </div>
                    <?php endif; ?>
                    <span class="gift-card-priority <?php echo $priority; ?>"><?php echo ucfirst($priority); ?></span>
                </div>
                <div class="gift-card-body">
                    <h3><?php echo esc_html($gift->post_title); ?></h3>
                    <p><?php echo esc_html(wp_trim_words($gift->post_content, 15)); ?></p>
                    <div class="gift-progress">
                        <div class="gift-progress-header">
                            <span class="gift-progress-raised" x-text="'$' + Math.round(raised) + ' AUD'"></span>
                            <span class="gift-progress-goal">of <?php echo contribu_format_aud($progress['goal']); ?></span>
                        </div>
                        <div class="gift-progress-bar">
                            <div class="gift-progress-fill" :style="'width:' + Math.min(100, Math.round(raised/goal*100)) + '%'"></div>
                        </div>
                    </div>

                    <template x-if="!showForm && !thankYou">
                        <button class="gift-card-btn" @click="showForm = true" <?php echo $funded ? 'disabled style="opacity:0.6;"' : ''; ?>>
                            <?php echo $funded ? 'Fully Funded!' : 'Contribute'; ?>
                        </button>
                    </template>

                    <template x-if="showForm">
                        <form @submit.prevent="contribute()" style="margin-top: 4px;">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <input type="text" x-model="donorName" placeholder="Your name" required style="padding: 8px 12px; font-size: 0.85rem;">
                            </div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <input type="number" x-model="amount" placeholder="Amount (AUD)" min="5" step="1" required style="padding: 8px 12px; font-size: 0.85rem;">
                            </div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <textarea x-model="donorMessage" placeholder="Leave a message (optional)" rows="2" style="padding: 8px 12px; font-size: 0.85rem;"></textarea>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="submit" class="gift-card-btn" style="flex: 1;" :disabled="contributing">
                                    <span x-text="contributing ? 'Processing...' : 'Pay with Stripe'"></span>
                                </button>
                                <button type="button" @click="showForm = false" style="padding: 8px 14px; background: none; border: 1px solid var(--border); border-radius: var(--radius-sm); cursor: pointer; font-size: 0.8rem; font-family: inherit;">Cancel</button>
                            </div>
                        </form>
                    </template>

                    <template x-if="thankYou">
                        <div style="text-align: center; padding: 12px 0;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2" style="margin: 0 auto 6px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <p style="font-size: 0.85rem; font-weight: 600; color: var(--sage);">Thank you, <span x-text="donorName"></span>!</p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);">Your contribution means the world.</p>
                        </div>
                    </template>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <!-- Demo placeholder gifts -->
        <div class="gifts-grid">
            <?php
            $demo_gifts = [
                ['id' => 1, 'title' => 'Honeymoon Fund', 'desc' => 'Help us explore the Amalfi Coast — our dream honeymoon.', 'goal' => 3000, 'raised' => 2340, 'priority' => 'high', 'img' => 'https://images.unsplash.com/photo-1534008897995-27a23e859048?w=600&q=80'],
                ['id' => 2, 'title' => 'KitchenAid Artisan Mixer', 'desc' => 'The heart of our new kitchen for Sunday baking.', 'goal' => 899, 'raised' => 699, 'priority' => 'high', 'img' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?w=600&q=80'],
                ['id' => 3, 'title' => 'Dyson V15 Vacuum', 'desc' => 'Our first home deserves a proper clean.', 'goal' => 1099, 'raised' => 450, 'priority' => 'medium', 'img' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=600&q=80'],
                ['id' => 4, 'title' => 'Le Creuset Dutch Oven', 'desc' => 'For slow-cooked Sunday roasts with family.', 'goal' => 599, 'raised' => 599, 'priority' => 'medium', 'img' => 'https://images.unsplash.com/photo-1585837146751-a44116f9cf63?w=600&q=80'],
                ['id' => 5, 'title' => 'Garden Dining Setting', 'desc' => 'A beautiful outdoor set for summer barbecues.', 'goal' => 1200, 'raised' => 380, 'priority' => 'low', 'img' => 'https://images.unsplash.com/photo-1600210492493-0946911123ea?w=600&q=80'],
                ['id' => 6, 'title' => 'Wine Fridge', 'desc' => 'For the Barossa wines from our honeymoon detour.', 'goal' => 800, 'raised' => 200, 'priority' => 'low', 'img' => 'https://images.unsplash.com/photo-1474722883778-792e7990302f?w=600&q=80'],
            ];
            foreach ($demo_gifts as $dg) :
                $pct = round(($dg['raised'] / $dg['goal']) * 100);
                $funded = $pct >= 100;
            ?>
            <div class="gift-card reveal" x-data="contributionWidget(<?php echo $dg['id']; ?>, <?php echo $dg['raised']; ?>, <?php echo $dg['goal']; ?>)">
                <div class="gift-card-img">
                    <img src="<?php echo $dg['img']; ?>" alt="<?php echo esc_attr($dg['title']); ?>">
                    <span class="gift-card-priority <?php echo $dg['priority']; ?>"><?php echo ucfirst($dg['priority']); ?></span>
                </div>
                <div class="gift-card-body">
                    <h3><?php echo $dg['title']; ?></h3>
                    <p><?php echo $dg['desc']; ?></p>
                    <div class="gift-progress">
                        <div class="gift-progress-header">
                            <span class="gift-progress-raised" x-text="'$' + Math.round(raised) + ' AUD'"></span>
                            <span class="gift-progress-goal">of $<?php echo number_format($dg['goal']); ?> AUD</span>
                        </div>
                        <div class="gift-progress-bar">
                            <div class="gift-progress-fill" data-width="<?php echo $pct; ?>%" :style="'width:' + Math.min(100, Math.round(raised/goal*100)) + '%'"></div>
                        </div>
                    </div>

                    <template x-if="!showForm && !thankYou">
                        <button class="gift-card-btn" @click="showForm = true" <?php echo $funded ? 'disabled style="opacity:0.6;"' : ''; ?>>
                            <?php echo $funded ? 'Fully Funded!' : 'Contribute'; ?>
                        </button>
                    </template>

                    <template x-if="showForm">
                        <form @submit.prevent="contribute()" style="margin-top: 4px;">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <input type="text" x-model="donorName" placeholder="Your name" required style="padding: 8px 12px; font-size: 0.85rem;">
                            </div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <input type="number" x-model="amount" placeholder="Amount (AUD)" min="5" step="1" required style="padding: 8px 12px; font-size: 0.85rem;">
                            </div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <textarea x-model="donorMessage" placeholder="Leave a message (optional)" rows="2" style="padding: 8px 12px; font-size: 0.85rem;"></textarea>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button type="submit" class="gift-card-btn" style="flex: 1;" :disabled="contributing">
                                    <span x-text="contributing ? 'Processing...' : 'Pay with Stripe'"></span>
                                </button>
                                <button type="button" @click="showForm = false" style="padding: 8px 14px; background: none; border: 1px solid var(--border); border-radius: var(--radius-sm); cursor: pointer; font-size: 0.8rem; font-family: inherit;">Cancel</button>
                            </div>
                        </form>
                    </template>

                    <template x-if="thankYou">
                        <div style="text-align: center; padding: 12px 0;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2" style="margin: 0 auto 6px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <p style="font-size: 0.85rem; font-weight: 600; color: var(--sage);">Thank you, <span x-text="donorName"></span>!</p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);">Your contribution means the world.</p>
                        </div>
                    </template>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- RSVP Section -->
<section class="section" style="background: var(--cream-dark);" id="rsvp">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Let Us Know</span>
            <h2>RSVP</h2>
            <p>We'd love to know if you can make it. Please respond by 15 October 2026.</p>
        </div>

        <div class="rsvp-form reveal" x-data="rsvpForm()">
            <template x-if="!rsvpSubmitted">
                <form @submit.prevent="submitRsvp()">
                    <div class="form-group">
                        <label>Your Name *</label>
                        <input type="text" x-model="guestName" placeholder="Full name" required>
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" x-model="guestEmail" placeholder="your@email.com" required>
                    </div>
                    <div class="form-group">
                        <label>Will you be attending? *</label>
                        <select x-model="attending">
                            <option value="yes">Yes, I'll be there!</option>
                            <option value="no">Sorry, I can't make it</option>
                        </select>
                    </div>
                    <template x-if="attending === 'yes'">
                        <div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Number of Guests</label>
                                    <select x-model="guestsCount">
                                        <option value="1">Just me</option>
                                        <option value="2">2 guests</option>
                                        <option value="3">3 guests</option>
                                        <option value="4">4 guests</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Dietary Requirements</label>
                                    <input type="text" x-model="dietary" placeholder="e.g. Vegetarian, Gluten-free">
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="form-group">
                        <label>Message for the Couple</label>
                        <textarea x-model="rsvpMessage" placeholder="We're so happy for you..." rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;" :disabled="rsvpLoading">
                        <span x-text="rsvpLoading ? 'Submitting...' : 'Submit RSVP'"></span>
                    </button>
                </form>
            </template>

            <template x-if="rsvpSubmitted">
                <div style="text-align: center; padding: 24px 0;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: rgba(143,174,139,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 8px;">RSVP Received!</h3>
                    <p style="color: var(--text-secondary); font-size: 0.9rem;" x-text="attending === 'yes' ? 'We can\'t wait to celebrate with you!' : 'We\'ll miss you! Thank you for letting us know.'"></p>
                </div>
            </template>
        </div>
    </div>
</section>

<script>
function contributionWidget(giftId, initialRaised, goal) {
    return {
        giftId: giftId, raised: initialRaised, goal: goal,
        showForm: false, thankYou: false, contributing: false,
        donorName: '', amount: '', donorMessage: '',
        contribute() {
            this.contributing = true;
            var self = this;
            // Demo: simulate Stripe payment
            setTimeout(function() {
                self.raised += parseFloat(self.amount);
                self.contributing = false;
                self.showForm = false;
                self.thankYou = true;
            }, 2000);
        }
    };
}

function rsvpForm() {
    return {
        guestName: '', guestEmail: '', attending: 'yes',
        guestsCount: '1', dietary: '', rsvpMessage: '',
        rsvpLoading: false, rsvpSubmitted: false,
        submitRsvp() {
            this.rsvpLoading = true;
            var self = this;
            setTimeout(function() { self.rsvpLoading = false; self.rsvpSubmitted = true; }, 1500);
        }
    };
}
</script>

<?php get_footer(); ?>
