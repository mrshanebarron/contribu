<?php
/**
 * Single Wedding Template
 * Displays a couple's wedding page with their gifts and RSVP
 */
get_header();

while (have_posts()) : the_post();
    $partner1 = get_post_meta(get_the_ID(), '_contribu_partner_1', true);
    $partner2 = get_post_meta(get_the_ID(), '_contribu_partner_2', true);
    $wedding_date = get_post_meta(get_the_ID(), '_contribu_wedding_date', true);
    $venue = get_post_meta(get_the_ID(), '_contribu_venue', true);
    $message = get_post_meta(get_the_ID(), '_contribu_message', true);
    $couple_name = ($partner1 && $partner2) ? $partner1 . ' & ' . $partner2 : get_the_title();
    $formatted_date = $wedding_date ? date('j F Y', strtotime($wedding_date)) : '';
    $gifts = contribu_get_wedding_gifts(get_the_ID());
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
        <h1><?php echo esc_html($couple_name); ?></h1>
        <?php if ($formatted_date || $venue) : ?>
        <div class="wedding-date"><?php echo esc_html($formatted_date); ?><?php if ($formatted_date && $venue) echo ' &bull; '; ?><?php echo esc_html($venue); ?></div>
        <?php endif; ?>
        <?php if ($message) : ?>
        <p class="wedding-message"><?php echo esc_html($message); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php if (has_post_thumbnail()) : ?>
<section class="section-sm" style="background: var(--cream-dark);">
    <div class="container" style="max-width: 800px;">
        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'wedding-hero'); ?>" alt="<?php echo esc_attr($couple_name); ?>" style="border-radius: var(--radius-xl); box-shadow: var(--shadow-md); width: 100%;">
    </div>
</section>
<?php endif; ?>

<?php if ($gifts) : ?>
<section class="section" id="registry">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Our Registry</span>
            <h2>Help Us Build Our New Life</h2>
        </div>

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
                        </div>
                    </template>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- RSVP -->
<section class="section" style="background: var(--cream-dark);" id="rsvp">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Let Us Know</span>
            <h2>RSVP</h2>
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
                        <label>Will you be attending?</label>
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
                                    <input type="text" x-model="dietary" placeholder="e.g. Vegetarian">
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea x-model="rsvpMessage" placeholder="A note for the happy couple..." rows="3"></textarea>
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
                    <p style="color: var(--text-secondary); font-size: 0.9rem;" x-text="attending === 'yes' ? 'We can\'t wait to celebrate with you!' : 'We\'ll miss you!'"></p>
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

<?php endwhile; ?>

<?php get_footer(); ?>
