<?php
/* Template Name: Contact */
get_header();
?>

<div class="page-header">
    <div class="container">
        <h1>Get In Touch</h1>
        <p>Questions about Contribu? We're here to help.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="reveal" x-data="contactForm()">
                <h3 style="font-size: 1.2rem; margin-bottom: 20px;">Send Us a Message</h3>

                <template x-if="!contactSubmitted">
                    <form @submit.prevent="submitContact()">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Your Name *</label>
                                <input type="text" x-model="contactName" placeholder="Full name" required>
                            </div>
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" x-model="contactEmail" placeholder="your@email.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <select x-model="contactSubject">
                                <option value="General Enquiry">General Enquiry</option>
                                <option value="Setting Up Registry">Help Setting Up My Registry</option>
                                <option value="Payment Question">Payment Question</option>
                                <option value="Technical Issue">Technical Issue</option>
                                <option value="Partnership">Partnership Opportunity</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea x-model="contactMessage" placeholder="How can we help?" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;" :disabled="contactLoading">
                            <span x-text="contactLoading ? 'Sending...' : 'Send Message'"></span>
                            <svg x-show="!contactLoading" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </form>
                </template>

                <template x-if="contactSubmitted">
                    <div style="text-align: center; padding: 40px 0;">
                        <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(143,174,139,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <h3 style="font-size: 1.2rem; margin-bottom: 8px;">Message Sent!</h3>
                        <p style="color: var(--text-secondary);">We'll get back to you within 24 hours.</p>
                    </div>
                </template>
            </div>

            <!-- Contact Info -->
            <div class="reveal">
                <h3 style="font-size: 1.2rem; margin-bottom: 24px;">Other Ways to Reach Us</h3>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="contact-info-text">
                        <h4>Email</h4>
                        <p>hello@contribu.com.au</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="contact-info-text">
                        <h4>Location</h4>
                        <p>Sydney, Australia</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="contact-info-text">
                        <h4>Response Time</h4>
                        <p>Within 24 hours</p>
                    </div>
                </div>

                <div style="margin-top: 32px; padding: 24px; background: var(--cream-dark); border-radius: var(--radius-md);">
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 1.05rem; margin-bottom: 8px;">Are you a vendor?</h4>
                    <p style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.6;">We partner with wedding vendors, venues, and planners across Australia. If you'd like to recommend Contribu to your clients, we'd love to chat about our partnership programme.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function contactForm() {
    return {
        contactName: '', contactEmail: '', contactSubject: 'General Enquiry', contactMessage: '',
        contactLoading: false, contactSubmitted: false,
        submitContact() {
            this.contactLoading = true;
            var self = this;
            setTimeout(function() { self.contactLoading = false; self.contactSubmitted = true; }, 1500);
        }
    };
}
</script>

<?php get_footer(); ?>
