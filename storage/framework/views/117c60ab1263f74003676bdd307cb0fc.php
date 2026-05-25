<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($quote): ?>
<section class="chairman-section" style="background:linear-gradient(180deg, var(--paper) 0%, var(--cream) 100%)">
  <div class="chairman-watermark" aria-hidden="true" data-parallax="0.06">mi</div>
  <div class="chairman-content">
    <div data-reveal><span class="eyebrow"><?php echo e(__('messages.chairman_eyebrow')); ?></span></div>
    <div data-reveal="scale" data-reveal-delay="0.1"><div class="chairman-avatar">mi</div></div>
    <blockquote class="chairman-quote" data-reveal="clip" data-reveal-delay="0.2">
      <span class="chairman-quotemark">"</span>
      <?php echo e($quote->quote); ?>

      <span class="chairman-quotemark" style="transform:translateY(40px);margin-right:0">"</span>
    </blockquote>
    <div class="chairman-signature" data-reveal data-reveal-delay="0.5">
      <div class="chairman-sig-mark"><?php echo e($quote->signature_name); ?></div>
      <div class="chairman-sig-name"><?php echo e($quote->signature_role); ?></div>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($quote->signature_role_en): ?>
        <div class="chairman-sig-role"><?php echo e($quote->signature_role_en); ?></div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/chairman.blade.php ENDPATH**/ ?>