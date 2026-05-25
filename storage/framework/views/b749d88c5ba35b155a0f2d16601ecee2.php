<section id="team" class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-12">
      <div data-reveal="left">
        <span class="eyebrow"><?php echo e(__('messages.team_eyebrow')); ?></span>
        <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.team_title')); ?></h2>
      </div>
      <p class="lead" data-reveal="right"><?php echo e(__('messages.team_blurb')); ?></p>
    </div>
    <div class="team-grid" data-stagger>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="team-card <?php if($m->is_featured): ?>is-featured <?php endif; ?>">
          <span class="team-badge"><?php echo e($m->role); ?></span>
          <div class="team-avatar" <?php if($m->badge_color): ?> style="background:<?php echo e($m->badge_color); ?>" <?php endif; ?>><?php echo e($m->initials); ?></div>
          <div class="team-role"><?php echo e($m->role); ?></div>
          <h3 class="team-name"><?php echo e($m->name); ?></h3>
          <p class="team-desc"><?php echo e($m->description); ?></p>
          <div class="team-contact">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($m->phone): ?>
              <a href="tel:<?php echo e($m->phone); ?>" class="team-action">
                <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                <span dir="ltr"><?php echo e($m->phone); ?></span>
              </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($m->whatsapp): ?>
              <a href="<?php echo e($m->getWhatsappLink()); ?>" class="team-action wa">
                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i> WhatsApp
              </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/team.blade.php ENDPATH**/ ?>