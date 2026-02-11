<?php if (!is_page('contact') && !is_page('create-registry')) : ?>
<section class="cta-band">
    <div class="container">
        <h2>Ready to Create Your Registry?</h2>
        <p>Start your wedding gift journey today. Free to set up, beautiful to share.</p>
        <a href="<?php echo home_url('/create-registry'); ?>" class="btn-white">
            Create Your Registry
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </div>
</section>
<?php endif; ?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?php echo home_url(); ?>" class="nav-logo">
                    <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 26C16 26 5 19 5 12C5 8.5 7.5 6 10.5 6C12.8 6 14.8 7.3 16 9.3C17.2 7.3 19.2 6 21.5 6C24.5 6 27 8.5 27 12C27 19 16 26 16 26Z" stroke="rgba(143,174,139,0.6)" stroke-width="1.5" fill="none"/>
                        <path d="M12 14L15 17L20 12" stroke="rgba(143,174,139,0.6)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Contribu
                </a>
                <p>The modern wedding gift registry. Let your loved ones contribute to what matters most.</p>
            </div>
            <div class="footer-col">
                <h4>Platform</h4>
                <ul>
                    <li><a href="<?php echo home_url('/how-it-works'); ?>">How It Works</a></li>
                    <li><a href="<?php echo home_url('/create-registry'); ?>">Create Registry</a></li>
                    <li><a href="<?php echo home_url('/sample-registry'); ?>">Sample Registry</a></li>
                    <li><a href="<?php echo home_url('/contact'); ?>">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo home_url('/terms-of-service'); ?>">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; <?php echo date('Y'); ?> Contribu. Made with love in Australia.</span>
            <span>Secure payments via Stripe</span>
        </div>
    </div>
</footer>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- GSAP + ScrollTrigger -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    // Reveal animations
    document.querySelectorAll('.reveal').forEach(function(el) {
        var rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            gsap.fromTo(el, { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.7, ease: 'power2.out' });
        } else {
            ScrollTrigger.create({
                trigger: el,
                start: 'top 88%',
                once: true,
                onEnter: function() {
                    gsap.fromTo(el, { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.7, ease: 'power2.out' });
                }
            });
        }
    });

    // Progress bar animations
    document.querySelectorAll('.gift-progress-fill').forEach(function(bar) {
        var width = bar.getAttribute('data-width') || bar.style.width;
        bar.style.width = '0%';
        ScrollTrigger.create({
            trigger: bar,
            start: 'top 90%',
            once: true,
            onEnter: function() {
                gsap.to(bar, { width: width, duration: 1.2, ease: 'power2.out' });
            }
        });
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
