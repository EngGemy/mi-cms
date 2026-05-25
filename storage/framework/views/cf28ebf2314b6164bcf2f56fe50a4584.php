<?php ($locale = app()->getLocale()); ?>
<div class="mobile-drawer" id="mobDrawer">
  <div class="mobile-drawer-inner">
    <a href="#products" data-mob-link><span class="num">01</span><?php echo e(__('messages.nav_products')); ?></a>
    <a href="#features" data-mob-link><span class="num">02</span><?php echo e(__('messages.nav_features')); ?></a>
    <a href="#how" data-mob-link><span class="num">03</span><?php echo e(__('messages.nav_how')); ?></a>
    <a href="#calculator" data-mob-link><span class="num">04</span><?php echo e(__('messages.nav_calculator')); ?></a>
    <a href="<?php echo e(route('blog.index', $locale)); ?>" data-mob-link><span class="num">05</span><?php echo e(__('messages.nav_blog')); ?></a>
    <a href="#about" data-mob-link><span class="num">06</span><?php echo e(__('messages.nav_about')); ?></a>
    <a href="#contact" data-mob-link><span class="num">07</span><?php echo e(__('messages.nav_contact')); ?></a>

    <div class="mt-auto pt-8 border-t border-white/10 flex gap-3">
      <a href="tel:<?php echo e(config('mi.phone_primary')); ?>" class="btn btn-primary flex-1">
        <i data-lucide="phone" class="w-4 h-4"></i> <?php echo e(__('messages.call_us')); ?>

      </a>
      <a href="https://wa.me/<?php echo e(config('mi.whatsapp')); ?>" class="btn btn-ghost flex-1"
         style="color:#fff;border-color:rgba(255,255,255,.2)">
        <i data-lucide="message-circle" class="w-4 h-4"></i> WhatsApp
      </a>
    </div>
  </div>
</div>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/partials/mobile-drawer.blade.php ENDPATH**/ ?>