
<section class="projects-section py-24 lg:py-32" id="projects">
  <div class="section-inner">

    
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-10">
      <div data-reveal="left">
        <span class="eyebrow"><?php echo e(__('messages.projects_eyebrow')); ?></span>
        <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.projects_title')); ?></h2>
      </div>
      <div data-reveal="right" class="flex flex-col gap-4">
        <p class="lead"><?php echo e(__('messages.projects_blurb')); ?></p>
        <a href="<?php echo e(route('projects.index', app()->getLocale())); ?>"
           class="projects-cta-link inline-flex items-center gap-2 font-mono text-xs uppercase tracking-widest text-ink-600 hover:text-mi-red transition-colors self-start">
          <?php echo e(__('messages.projects_cta')); ?>

          <svg class="w-4 h-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->getLocale() === 'ar'): ?>
              <path d="M10 8H3M6 5l-3 3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <?php else: ?>
              <path d="M6 8H13M10 5l3 3-3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </svg>
        </a>
      </div>
    </div>

    
    <div class="filters-row" data-reveal id="projectFilters">
      <button class="filter-pill is-active" data-filter="all"><?php echo e(__('messages.filter_all')); ?></button>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Models\Project::CATEGORIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $names): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button class="filter-pill" data-filter="<?php echo e($key); ?>"><?php echo e($names[app()->getLocale()]); ?></button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="projects-grid" id="projectsGrid" data-stagger>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('projects.show', [app()->getLocale(), $project->slug])); ?>"
           class="project-tile pt-<?php echo e((($i % 8) + 1)); ?>"
           data-cat="<?php echo e($project->category); ?>"
           aria-label="<?php echo e($project->title); ?>">

          
          <span class="project-tile-cat"><?php echo e($project->getCategoryLabel()); ?></span>

          
          <img src="<?php echo e($project->getCoverUrl('card') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=900&q=85&auto=format&fit=crop'); ?>"
               alt="<?php echo e($project->title); ?>"
               loading="lazy" decoding="async"/>

          
          <div class="project-tile-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5">
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->getLocale() === 'ar'): ?>
                <path d="M19 12H5M10 7l-5 5 5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <?php else: ?>
                <path d="M5 12h14M14 7l5 5-5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </svg>
          </div>

          
          <div class="project-tile-info">
            <div class="project-tile-title"><?php echo e($project->title); ?></div>
            <div class="project-tile-meta-row">
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->location_code): ?>
                <span class="project-tile-meta"><?php echo e($project->location_code); ?></span>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->capacity_birds && $project->capacity_birds > 0): ?>
                <span class="project-tile-stat">
                  <?php echo e(number_format($project->capacity_birds / 1000, 0)); ?>K
                  <span class="project-tile-stat-label"><?php echo e(__('messages.birds_unit')); ?></span>
                </span>
              <?php elseif($project->year): ?>
                <span class="project-tile-stat">
                  <?php echo e($project->year); ?>

                </span>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
          </div>

        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projects->count() >= 6): ?>
    <div class="text-center mt-12" data-reveal>
      <a href="<?php echo e(route('projects.index', app()->getLocale())); ?>"
         class="btn btn-ghost">
        <?php echo e(__('messages.projects_cta')); ?>

        <i data-lucide="arrow-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>" class="w-4 h-4"></i>
      </a>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/projects.blade.php ENDPATH**/ ?>