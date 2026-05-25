<section class="py-24 lg:py-32">
  <div class="section-inner max-w-3xl">
    <div class="text-center mb-12">
      <span class="eyebrow"><?php echo e(__('messages.faq_eyebrow')); ?></span>
      <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.faq_title')); ?></h2>
    </div>
    <div data-reveal>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="faq-item">
          <button class="faq-q" aria-expanded="false">
            <span><?php echo e($faq->question); ?></span>
            <span class="faq-icon"><i data-lucide="plus" class="w-5 h-5"></i></span>
          </button>
          <div class="faq-a"><div class="faq-a-inner"><?php echo e($faq->answer); ?></div></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/faq.blade.php ENDPATH**/ ?>