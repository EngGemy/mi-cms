<?php ($locale = app()->getLocale()); ?>
<section id="contact" class="py-24 lg:py-32" style="background:var(--ink-900);color:#fff">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div data-reveal="left">
        <span class="eyebrow" style="background:rgba(229,57,53,.15);color:var(--mi-red-light)"><?php echo e(__('messages.contact_eyebrow')); ?></span>
        <h2 class="display-2 mt-2" style="color:#fff" data-reveal="title"><?php echo __('messages.contact_title'); ?></h2>
        <p class="lead mt-5" style="color:rgba(255,255,255,.72)" data-reveal data-reveal-delay="0.1"><?php echo e(__('messages.contact_blurb')); ?></p>

        <div class="mt-10 space-y-5" data-reveal data-reveal-delay="0.2">
          <a href="tel:<?php echo e(config('mi.phone_primary')); ?>" class="flex items-center gap-4 group">
            <div style="width:48px;height:48px;border-radius:50%;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);display:grid;place-items:center">
              <i data-lucide="phone" class="w-5 h-5"></i>
            </div>
            <div>
              <div class="label-mono" style="color:rgba(255,255,255,.5)"><?php echo e(__('messages.call_us')); ?></div>
              <div style="font-weight:700;font-size:20px" dir="ltr"><?php echo e(config('mi.phone_primary')); ?></div>
            </div>
          </a>
        </div>
      </div>

      <div data-reveal="right">
        <form method="POST" action="<?php echo e(route('contact.store', $locale)); ?>"
              style="background:rgba(255,255,255,.05);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.1);border-radius:32px;padding:32px">
          <?php echo csrf_field(); ?>
          <div class="grid sm:grid-cols-2 gap-5 mb-5">
            <label class="block">
              <span class="label-mono" style="color:rgba(255,255,255,.55)"><?php echo e(__('messages.field_name')); ?></span>
              <input type="text" name="name" required style="margin-top:8px;width:100%;background:transparent;border:none;border-bottom:1px solid rgba(255,255,255,.2);padding:10px 0;font-size:16px;color:#fff;outline:none"/>
            </label>
            <label class="block">
              <span class="label-mono" style="color:rgba(255,255,255,.55)"><?php echo e(__('messages.field_company')); ?></span>
              <input type="text" name="company" style="margin-top:8px;width:100%;background:transparent;border:none;border-bottom:1px solid rgba(255,255,255,.2);padding:10px 0;font-size:16px;color:#fff;outline:none"/>
            </label>
            <label class="block">
              <span class="label-mono" style="color:rgba(255,255,255,.55)"><?php echo e(__('messages.field_email')); ?></span>
              <input type="email" name="email" required style="margin-top:8px;width:100%;background:transparent;border:none;border-bottom:1px solid rgba(255,255,255,.2);padding:10px 0;font-size:16px;color:#fff;outline:none"/>
            </label>
            <label class="block">
              <span class="label-mono" style="color:rgba(255,255,255,.55)"><?php echo e(__('messages.field_phone')); ?></span>
              <input type="tel" name="phone" style="margin-top:8px;width:100%;background:transparent;border:none;border-bottom:1px solid rgba(255,255,255,.2);padding:10px 0;font-size:16px;color:#fff;outline:none"/>
            </label>
          </div>
          <label class="block mb-5">
            <span class="label-mono" style="color:rgba(255,255,255,.55)"><?php echo e(__('messages.field_flock')); ?></span>
            <select name="flock_size" style="margin-top:8px;width:100%;border:none;border-bottom:1px solid rgba(255,255,255,.2);padding:10px 0;font-size:16px;color:#fff;outline:none;background:var(--ink-900)">
              <option>أقل من 10 آلاف</option>
              <option>10-50 ألف</option>
              <option>50-150 ألف</option>
              <option>أكثر من 150 ألف</option>
            </select>
          </label>
          <label class="block mb-5">
            <span class="label-mono" style="color:rgba(255,255,255,.55)"><?php echo e(__('messages.field_message')); ?></span>
            <textarea name="message" rows="3" style="margin-top:8px;width:100%;background:transparent;border:none;border-bottom:1px solid rgba(255,255,255,.2);padding:10px 0;font-size:15px;color:#fff;outline:none;resize:none"></textarea>
          </label>
          <button type="submit" class="btn btn-primary w-full" style="padding:16px">
            <?php echo e(__('messages.send_request')); ?> <i data-lucide="send" class="w-4 h-4"></i>
          </button>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('contact_ok')): ?>
            <p class="text-sm mt-4" style="color:var(--mi-red-light)">✔ <?php echo e(session('contact_ok')); ?></p>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/contact.blade.php ENDPATH**/ ?>