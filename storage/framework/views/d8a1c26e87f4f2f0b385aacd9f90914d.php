<?php ($locale = app()->getLocale()); ?>
<header>
  <div class="header-inner">
    <a href="<?php echo e(route('home', $locale)); ?>" class="header-brand">
      <div class="header-brand-logo"><img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="MI"/></div>
      <span class="header-brand-text"><?php echo e($locale === 'ar' ? 'إم آي' : 'MI'); ?></span>
    </a>

    <nav class="header-nav">
      <a href="#products"><?php echo e(__('messages.nav_products')); ?></a>
      <a href="#features"><?php echo e(__('messages.nav_features')); ?></a>
      <a href="#how"><?php echo e(__('messages.nav_how')); ?></a>
      <a href="#calculator"><?php echo e(__('messages.nav_calculator')); ?></a>
      <a href="<?php echo e(route('blog.index', $locale)); ?>"><?php echo e(__('messages.nav_blog')); ?></a>
      <a href="<?php echo e(route('about', $locale)); ?>"><?php echo e(__('messages.nav_about')); ?></a>
    </nav>

    <div class="flex items-center gap-3">
      <a href="<?php echo e(route('locale.switch', $locale === 'ar' ? 'en' : 'ar')); ?>"
         class="lang-btn hidden md:inline-flex">
        <i data-lucide="globe" class="w-4 h-4"></i>
        <?php echo e($locale === 'ar' ? 'EN' : 'ع'); ?>

      </a>
      <a href="#contact" class="btn btn-dark btn-sm hidden md:inline-flex">
        <?php echo e(__('messages.cta_consultation')); ?>

      </a>
      <button class="header-mobile-btn" id="mobBtn" aria-label="القائمة">
        <i data-lucide="menu" class="w-5 h-5" id="mobIcon"></i>
      </button>
    </div>
  </div>
</header>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/partials/header.blade.php ENDPATH**/ ?>