<section id="features" class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="eyebrow"><?php echo e(__('messages.features_eyebrow')); ?></span>
      <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.features_title')); ?></h2>
      <p class="lead mt-5" data-reveal data-reveal-delay="0.1"><?php echo e(__('messages.features_blurb')); ?></p>
    </div>
    <div class="grid lg:grid-cols-3 gap-5" data-stagger>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="feature-card">
          <div class="feature-image" data-parallax="0.06">
            <img src="<?php echo e($feature->getFirstMediaUrl('image', 'card') ?: 'https://images.unsplash.com/photo-1531155179084-3e1f15110922?w=1200&q=85&auto=format&fit=crop'); ?>"
                 alt="<?php echo e($feature->title); ?>" loading="lazy"/>
          </div>
          <div class="feature-body">
            <h3 class="feature-title"><?php echo e($feature->title); ?></h3>
            <p class="feature-desc"><?php echo e($feature->description); ?></p>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/features.blade.php ENDPATH**/ ?>