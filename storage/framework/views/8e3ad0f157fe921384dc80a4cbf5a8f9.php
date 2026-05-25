<?php ($locale = app()->getLocale()); ?>
<footer class="py-16" style="background:var(--cream)">
  <div class="footer-watermark" aria-hidden="true">MI</div>
  <div class="footer-line"></div>

  <div class="section-inner relative z-10">
    <div class="grid lg:grid-cols-12 gap-8 mb-12">
      <div class="lg:col-span-5 footer-col">
        <a href="<?php echo e(route('home', $locale)); ?>" class="header-brand mb-5 inline-flex footer-brand">
          <div class="header-brand-logo"><img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="MI"/></div>
          <div>
            <div style="font-weight:800;font-size:18px"><?php echo e($locale === 'ar' ? 'إم آي' : 'MI'); ?></div>
            <div class="label-mono" style="color:var(--ink-500);font-size:10px">MI · Automatic Poultry Cages</div>
          </div>
        </a>
        <p style="font-size:15px;line-height:1.85;color:var(--ink-600);margin-top:18px;max-width:420px">
          <?php echo e(__('messages.footer_blurb')); ?>

        </p>

        <!-- Newsletter -->
        <form action="<?php echo e(route('newsletter.store', $locale)); ?>" method="POST" class="mt-7 flex gap-2 max-w-md">
          <?php echo csrf_field(); ?>
          <input type="email" name="email" required placeholder="<?php echo e(__('messages.newsletter_placeholder')); ?>"
                 class="flex-1 px-4 py-3 rounded-full border bg-white" style="border-color:rgba(26,22,17,.1)"/>
          <button class="btn btn-primary"><?php echo e(__('messages.subscribe')); ?></button>
        </form>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('newsletter_ok')): ?>
          <p class="text-sm mt-3" style="color:var(--mi-red)"><?php echo e(session('newsletter_ok')); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      <div class="lg:col-span-2 footer-col">
        <div class="label-mono mb-4" style="color:var(--ink-500)"><?php echo e(__('messages.site_map')); ?></div>
        <ul class="space-y-3" style="font-size:14px">
          <li><a href="#products" class="footer-link"><?php echo e(__('messages.nav_products')); ?></a></li>
          <li><a href="#features" class="footer-link"><?php echo e(__('messages.nav_features')); ?></a></li>
          <li><a href="#how" class="footer-link"><?php echo e(__('messages.nav_how')); ?></a></li>
          <li><a href="<?php echo e(route('blog.index', $locale)); ?>" class="footer-link"><?php echo e(__('messages.nav_blog')); ?></a></li>
        </ul>
      </div>

      <div class="lg:col-span-2 footer-col">
        <div class="label-mono mb-4" style="color:var(--ink-500)"><?php echo e(__('messages.products')); ?></div>
        <ul class="space-y-3" style="font-size:14px">
          <li><a href="<?php echo e(route('products.index', $locale)); ?>" class="footer-link"><?php echo e(__('messages.all_products')); ?></a></li>
        </ul>
      </div>

      <div class="lg:col-span-3 footer-col">
        <div class="label-mono mb-4" style="color:var(--ink-500)"><?php echo e(__('messages.contact_us')); ?></div>
        <ul class="space-y-3" style="font-size:14px;color:var(--ink-700)">
          <li><a href="tel:<?php echo e(config('mi.phone_primary')); ?>" class="flex items-center gap-3 footer-link">
            <i data-lucide="phone" class="w-4 h-4" style="color:var(--mi-red)"></i>
            <span dir="ltr" class="font-mono" style="font-weight:600"><?php echo e(config('mi.phone_primary')); ?></span>
          </a></li>
          <li class="flex items-center gap-3">
            <i data-lucide="map-pin" class="w-4 h-4" style="color:var(--mi-red)"></i>
            <span><?php echo e(config('mi.address.' . $locale)); ?></span>
          </li>
          <li class="flex items-center gap-3">
            <i data-lucide="mail" class="w-4 h-4" style="color:var(--mi-red)"></i>
            <span><?php echo e(config('mi.email')); ?></span>
          </li>
        </ul>
      </div>
    </div>

    <div class="footer-copy pt-8 flex flex-col md:flex-row justify-between gap-3 text-sm"
         style="color:var(--ink-500);border-top:1px solid rgba(26,22,17,.08)">
      <div>© <?php echo e(date('Y')); ?> MI Automatic Poultry Cages. <?php echo e(__('messages.rights')); ?></div>
    </div>
  </div>
</footer>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/partials/footer.blade.php ENDPATH**/ ?>