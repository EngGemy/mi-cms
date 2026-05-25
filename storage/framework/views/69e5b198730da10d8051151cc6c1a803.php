<section class="py-24 lg:py-32 bg-paper" id="stagesSection">
  <div class="section-inner">
    <div class="stages-controls">
      <div class="flex-1" data-reveal="left">
        <span class="eyebrow"><?php echo e(__('messages.stages_eyebrow')); ?></span>
        <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.stages_title')); ?></h2>
        <p class="lead mt-4 max-w-xl"><?php echo e(__('messages.stages_blurb')); ?></p>
      </div>
      <div class="stages-nav flex-shrink-0 hidden md:flex" data-reveal="right">
        <button class="stages-btn" id="stagesPrev" aria-label="السابق">
          <i data-lucide="arrow-right" class="w-5 h-5"></i></button>
        <button class="stages-btn" id="stagesNext" aria-label="التالي">
          <i data-lucide="arrow-left" class="w-5 h-5"></i></button>
      </div>
    </div>

    <div class="stages-wrap">
      <div class="stages-track" id="stagesTrack">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="stage-card">
            <div class="stage-image">
              <span class="stage-num"><?php echo e($stage->stage_number); ?></span>
              <img src="<?php echo e($stage->getImageUrl() ?? 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=900&q=85&auto=format&fit=crop'); ?>"
                   alt="<?php echo e($stage->title); ?>" loading="lazy"/>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stage->getVideoUrl()): ?>
                <button class="stage-play" aria-label="تشغيل الفيديو">
                  <i data-lucide="play" class="w-5 h-5 ml-0.5"></i></button>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="stage-body">
              <div class="stage-eyebrow"><?php echo e($stage->eyebrow); ?></div>
              <h3 class="stage-title"><?php echo e($stage->title); ?></h3>
              <p class="stage-desc"><?php echo e($stage->description); ?></p>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </div>

    
    <div class="stages-progress" id="stagesProgress" aria-hidden="true"></div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/production-stages.blade.php ENDPATH**/ ?>