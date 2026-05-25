<section id="about" class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="relative" data-reveal="left">
        <div style="aspect-ratio:4/5;border-radius:32px;overflow:hidden;box-shadow:0 30px 80px -20px rgba(26,22,17,.25)">
          <img src="https://plus.unsplash.com/premium_photo-1661930553507-59420df08d82?w=1600&q=85&auto=format&fit=crop"
               alt="مصنع MI" loading="lazy" style="width:100%;height:100%;object-fit:cover" data-parallax="0.08"/>
        </div>
        <div data-reveal="scale" data-reveal-delay="0.25" style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;">
          <div style="width:100%;height:100%;border-radius:50%;background:var(--ink-900);color:#fff;display:grid;place-items:center;text-align:center;box-shadow:0 16px 40px -8px rgba(26,22,17,.4);transform:rotate(12deg);">
          <div>
            <div style="font-family:'JetBrains Mono',monospace;font-weight:700;font-size:32px;line-height:1">15+</div>
            <div class="label-mono" style="color:rgba(255,255,255,.6);margin-top:4px;font-size:9px"><?php echo e(__('messages.about_badge')); ?></div>
          </div>
          </div>
        </div>
      </div>
      <div data-reveal="right">
        <span class="eyebrow"><?php echo e(__('messages.about_eyebrow')); ?></span>
        <h2 class="display-2 mt-2" data-reveal="title"><?php echo __('messages.about_title'); ?></h2>
        <p class="lead mt-6" data-reveal data-reveal-delay="0.1"><?php echo e(__('messages.about_blurb')); ?></p>
        <a href="<?php echo e(route('about', app()->getLocale())); ?>" class="btn btn-primary mt-8" data-magnetic data-reveal data-reveal-delay="0.2">
          <?php echo e(__('messages.about_cta')); ?> <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
      </div>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/about.blade.php ENDPATH**/ ?>