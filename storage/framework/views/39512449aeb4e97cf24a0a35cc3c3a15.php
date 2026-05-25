<section class="py-24 lg:py-32">
  <div class="section-inner mb-10">
    <div class="text-center max-w-2xl mx-auto">
      <span class="eyebrow"><?php echo e(__('messages.testimonials_eyebrow')); ?></span>
      <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.testimonials_title')); ?></h2>
    </div>
  </div>
  <div class="marquee" data-reveal="scale">
    <div class="marquee-track">
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="testimonial-card">
          <div class="testimonial-avatar" <?php if($t->avatar_color): ?> style="background:<?php echo e($t->avatar_color); ?>" <?php endif; ?>><?php echo e($t->initials); ?></div>
          <p class="testimonial-quote">"<?php echo e($t->quote); ?>"</p>
          <div style="font-weight:700;font-size:15px"><?php echo e($t->author_name); ?></div>
          <div class="label-mono" style="color:var(--ink-500);margin-top:2px"><?php echo e($t->author_role); ?></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="testimonial-card">
          <div class="testimonial-avatar" <?php if($t->avatar_color): ?> style="background:<?php echo e($t->avatar_color); ?>" <?php endif; ?>><?php echo e($t->initials); ?></div>
          <p class="testimonial-quote">"<?php echo e($t->quote); ?>"</p>
          <div style="font-weight:700;font-size:15px"><?php echo e($t->author_name); ?></div>
          <div class="label-mono" style="color:var(--ink-500);margin-top:2px"><?php echo e($t->author_role); ?></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/testimonials.blade.php ENDPATH**/ ?>