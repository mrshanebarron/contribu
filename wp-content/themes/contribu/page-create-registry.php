<?php
/* Template Name: Create Registry */
get_header();
?>

<div class="page-header">
    <div class="container">
        <h1>Create Your Registry</h1>
        <p>Set up your wedding gift registry in minutes. It's free, beautiful, and easy.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <!-- Wedding Page Creator -->
        <div class="gift-form-card reveal" x-data="registryForm()" style="max-width: 700px;">
            <h3 style="display: flex; align-items: center; gap: 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/><path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
                Wedding Details
            </h3>
            <p style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 24px;">Tell us about your big day. This information will appear on your wedding page.</p>

            <template x-if="!submitted">
                <form @submit.prevent="submitWedding()">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Partner 1 Name *</label>
                            <input type="text" x-model="partner1" placeholder="e.g. Emma" required>
                        </div>
                        <div class="form-group">
                            <label>Partner 2 Name *</label>
                            <input type="text" x-model="partner2" placeholder="e.g. Josh" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Wedding Date *</label>
                            <input type="date" x-model="weddingDate" required>
                        </div>
                        <div class="form-group">
                            <label>Venue</label>
                            <input type="text" x-model="venue" placeholder="e.g. The Royal Botanic Gardens, Sydney">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Contact Email *</label>
                        <input type="email" x-model="email" placeholder="your@email.com" required>
                    </div>

                    <div class="form-group">
                        <label>Welcome Message</label>
                        <textarea x-model="message" placeholder="Write a personal message for your guests..." rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Couple Photo</label>
                        <div class="image-upload-area" @click="$refs.weddingPhoto.click()" @dragover.prevent @drop.prevent="handleDrop($event)">
                            <template x-if="!photoPreview">
                                <div>
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="1.5" style="margin: 0 auto 8px;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                    <p style="font-size: 0.85rem;">Click or drag a photo here</p>
                                    <p style="font-size: 0.75rem; margin-top: 4px;">JPG, PNG up to 5MB</p>
                                </div>
                            </template>
                            <template x-if="photoPreview">
                                <img :src="photoPreview" style="max-height: 200px; border-radius: 8px; margin: 0 auto;">
                            </template>
                            <input type="file" x-ref="weddingPhoto" @change="handlePhotoSelect($event)" accept="image/*" style="display: none;">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;" :disabled="loading">
                        <span x-text="loading ? 'Creating...' : 'Create Wedding Page'"></span>
                        <svg x-show="!loading" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </form>
            </template>

            <template x-if="submitted">
                <div style="text-align: center; padding: 32px 0;">
                    <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(143,174,139,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 8px;">Wedding Page Created!</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 24px;">Your page for <strong x-text="partner1 + ' & ' + partner2"></strong> is ready. Now add your gift wishlist below.</p>
                    <a href="#add-gifts" class="btn-primary" style="display: inline-flex;">
                        Add Your First Gift
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </a>
                </div>
            </template>
        </div>

        <!-- Gift Creation Form -->
        <div id="add-gifts" class="gift-form-card reveal" x-data="giftForm()" style="max-width: 700px; margin-top: 32px;">
            <h3 style="display: flex; align-items: center; gap: 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><path d="M20 12v10H4V12M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                Add a Gift
            </h3>
            <p style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 24px;">Create gifts for your registry. Add as many as you like — guests can contribute any amount toward each one.</p>

            <template x-if="!giftSubmitted">
                <form @submit.prevent="submitGift()">
                    <div class="form-group">
                        <label>Gift Title *</label>
                        <input type="text" x-model="giftTitle" placeholder="e.g. Honeymoon Fund, KitchenAid Mixer" required>
                    </div>

                    <div class="form-group">
                        <label>Gift Image</label>
                        <div class="image-upload-area" @click="$refs.giftPhoto.click()">
                            <template x-if="!giftPhotoPreview">
                                <div>
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="1.5" style="margin: 0 auto 8px;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                    <p style="font-size: 0.85rem;">Upload a photo of the gift</p>
                                </div>
                            </template>
                            <template x-if="giftPhotoPreview">
                                <img :src="giftPhotoPreview" style="max-height: 160px; border-radius: 8px; margin: 0 auto;">
                            </template>
                            <input type="file" x-ref="giftPhoto" @change="handleGiftPhoto($event)" accept="image/*" style="display: none;">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Goal Amount (AUD) *</label>
                            <input type="number" step="1" min="10" x-model="goalAmount" placeholder="e.g. 500" required>
                        </div>
                        <div class="form-group">
                            <label>Priority Level</label>
                            <select x-model="priority">
                                <option value="high">High Priority</option>
                                <option value="medium" selected>Medium Priority</option>
                                <option value="low">Low Priority</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea x-model="giftDescription" placeholder="Tell your guests why this gift is special to you..." rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;" :disabled="giftLoading">
                        <span x-text="giftLoading ? 'Adding...' : 'Add Gift to Registry'"></span>
                        <svg x-show="!giftLoading" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </button>
                </form>
            </template>

            <template x-if="giftSubmitted">
                <div style="text-align: center; padding: 24px 0;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: rgba(143,174,139,0.15); display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 8px;">Gift Added!</h3>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 16px;"><strong x-text="giftTitle"></strong> has been added to your registry.</p>
                    <button @click="resetGift()" class="btn-secondary" style="display: inline-flex; font-family: inherit;">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        Add Another Gift
                    </button>
                </div>
            </template>
        </div>
    </div>
</section>

<script>
function registryForm() {
    return {
        partner1: '', partner2: '', weddingDate: '', venue: '', email: '', message: '',
        photoPreview: null, photoFile: null, loading: false, submitted: false,
        handlePhotoSelect(e) {
            var file = e.target.files[0];
            if (file) { this.photoFile = file; this.photoPreview = URL.createObjectURL(file); }
        },
        handleDrop(e) {
            var file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) { this.photoFile = file; this.photoPreview = URL.createObjectURL(file); }
        },
        submitWedding() {
            this.loading = true;
            // Demo: simulate creation
            setTimeout(() => { this.loading = false; this.submitted = true; }, 1500);
        }
    };
}

function giftForm() {
    return {
        giftTitle: '', giftDescription: '', goalAmount: '', priority: 'medium',
        giftPhotoPreview: null, giftPhotoFile: null, giftLoading: false, giftSubmitted: false,
        handleGiftPhoto(e) {
            var file = e.target.files[0];
            if (file) { this.giftPhotoFile = file; this.giftPhotoPreview = URL.createObjectURL(file); }
        },
        submitGift() {
            this.giftLoading = true;
            // Demo: simulate submission
            setTimeout(() => { this.giftLoading = false; this.giftSubmitted = true; }, 1200);
        },
        resetGift() {
            this.giftTitle = ''; this.giftDescription = ''; this.goalAmount = '';
            this.priority = 'medium'; this.giftPhotoPreview = null; this.giftPhotoFile = null;
            this.giftSubmitted = false;
        }
    };
}
</script>

<?php get_footer(); ?>
