<section id="how" class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-12">
      <div data-reveal="left">
        <span class="eyebrow"><?php echo e(__('messages.how_eyebrow')); ?></span>
        <h2 class="display-2 mt-2" data-reveal="title"><?php echo __('messages.how_title'); ?></h2>
      </div>
      <p class="lead" data-reveal="right"><?php echo e(__('messages.how_blurb')); ?></p>
    </div>
    <div class="grid lg:grid-cols-3 gap-5" data-stagger>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = __('messages.how_steps'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="step <?php if($i === 2): ?> bg-ink-900 <?php endif; ?>"
             <?php if($i === 2): ?> style="background:var(--ink-900);color:#fff;border-color:var(--ink-900)" <?php endif; ?>>
          <div class="step-num" <?php if($i === 2): ?> style="color:var(--mi-red-light)" <?php endif; ?>><?php echo e(['١','٢','٣'][$i]); ?></div>
          <h3 class="step-title" <?php if($i === 2): ?> style="color:#fff" <?php endif; ?>><?php echo e($step['title']); ?></h3>
          <p class="step-desc" <?php if($i === 2): ?> style="color:rgba(255,255,255,.72)" <?php endif; ?>><?php echo e($step['desc']); ?></p>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/how-it-works.blade.php ENDPATH**/ ?>