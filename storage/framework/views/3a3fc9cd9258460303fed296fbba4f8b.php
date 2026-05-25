<?php if (isset($component)) { $__componentOriginal8c0e86a062c1c5bb6d0e151b7076f3fd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c0e86a062c1c5bb6d0e151b7076f3fd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.public','data' => ['seo' => $seo]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.public'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['seo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seo)]); ?>

  
   <?php $__env->slot('head', null, []); ?> 
    <script type="application/ld+json"><?php echo $jsonLd; ?></script>
   <?php $__env->endSlot(); ?>

  
  <nav class="proj-breadcrumb" aria-label="breadcrumb">
    <div class="section-inner">
      <ol class="proj-breadcrumb-list">
        <li><a href="<?php echo e(route('home', app()->getLocale())); ?>"><?php echo e(__('messages.brand')); ?></a></li>
        <li><i data-lucide="chevron-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>" class="w-3 h-3"></i></li>
        <li><a href="<?php echo e(route('projects.index', app()->getLocale())); ?>"><?php echo e(__('messages.projects_eyebrow')); ?></a></li>
        <li><i data-lucide="chevron-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>" class="w-3 h-3"></i></li>
        <li aria-current="page"><?php echo e($project->title); ?></li>
      </ol>
    </div>
  </nav>

  
  <section class="proj-hero" aria-labelledby="proj-title">

    
    <div class="proj-hero-bg" data-proj-parallax>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->getCoverUrl('hero')): ?>
        <img src="<?php echo e($project->getCoverUrl('hero')); ?>"
             alt="<?php echo e($project->title); ?>"
             fetchpriority="high" decoding="async"/>
      <?php else: ?>
        <div style="background:var(--ink-800);width:100%;height:100%;"></div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div class="proj-hero-overlay" aria-hidden="true"></div>

    <div class="proj-hero-inner">

      
      <div data-proj-fade style="--d:0s">
        <span class="proj-hero-cat"><?php echo e($project->getCategoryLabel()); ?></span>
      </div>

      
      <h1 id="proj-title" class="display-1 proj-hero-title" data-proj-title>
        <?php
          $titleWords = explode(' ', $project->title);
          $mid = (int) ceil(count($titleWords) / 2);
          $line1 = implode(' ', array_slice($titleWords, 0, $mid));
          $line2 = implode(' ', array_slice($titleWords, $mid));
        ?>
        <span class="title-line"><?php echo e($line1); ?></span>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($line2): ?>
          <span class="title-line"><?php echo e($line2); ?></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </h1>

      
      <div class="proj-hero-meta" data-proj-fade style="--d:.3s">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->location_code): ?>
          <span class="proj-hero-meta-item">
            <i data-lucide="map-pin" class="w-3 h-3" aria-hidden="true"></i>
            <?php echo e($project->location_code); ?>

          </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->year): ?>
          <span class="proj-hero-meta-item">
            <i data-lucide="calendar" class="w-3 h-3" aria-hidden="true"></i>
            <?php echo e($project->year); ?>

          </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->client_name): ?>
          <span class="proj-hero-meta-item">
            <i data-lucide="building-2" class="w-3 h-3" aria-hidden="true"></i>
            <?php echo e($project->client_name); ?>

          </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

    </div>
  </section>

  
  <div class="proj-stats" role="region" aria-label="<?php echo e(__('messages.project_stats_title')); ?>">
    <div class="proj-stats-inner">

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->capacity_birds && $project->capacity_birds > 0): ?>
      <div class="proj-stat">
        <div class="proj-stat-num">
          <span data-counter data-target="<?php echo e($project->capacity_birds); ?>">0</span>
          <span class="proj-stat-unit"><?php echo e(__('messages.birds_unit')); ?></span>
        </div>
        <div class="proj-stat-label"><?php echo e(__('messages.project_capacity')); ?></div>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->barns_count): ?>
      <div class="proj-stat">
        <div class="proj-stat-num">
          <span data-counter data-target="<?php echo e($project->barns_count); ?>">0</span>
          <span class="proj-stat-unit"><?php echo e(__('messages.barns_unit')); ?></span>
        </div>
        <div class="proj-stat-label"><?php echo e(__('messages.project_barns')); ?></div>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->area_m2): ?>
      <div class="proj-stat">
        <div class="proj-stat-num">
          <span data-counter data-target="<?php echo e($project->area_m2); ?>">0</span>
          <span class="proj-stat-unit"><?php echo e(__('messages.sqm_unit')); ?></span>
        </div>
        <div class="proj-stat-label"><?php echo e(__('messages.project_area')); ?></div>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->year): ?>
      <div class="proj-stat">
        <div class="proj-stat-num"><?php echo e($project->year); ?></div>
        <div class="proj-stat-label"><?php echo e(__('messages.project_year')); ?></div>
      </div>
      <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
  </div>

  
  <section class="py-20 lg:py-28">
    <div class="proj-content">
      <div class="proj-detail-grid">

        
        <div data-reveal>
          <span class="proj-section-label"><?php echo e(__('messages.project_description')); ?></span>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->description): ?>
            <div class="proj-description">
              <?php echo nl2br(e($project->description)); ?>

            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <aside class="proj-info-card" data-reveal>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->client_name): ?>
            <div class="proj-info-row">
              <span class="proj-info-key"><?php echo e(__('messages.project_client')); ?></span>
              <span class="proj-info-val"><?php echo e($project->client_name); ?></span>
            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->location_code): ?>
            <div class="proj-info-row">
              <span class="proj-info-key"><?php echo e(__('messages.project_location')); ?></span>
              <span class="proj-info-val"><?php echo e($project->location_code); ?></span>
            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <div class="proj-info-row">
            <span class="proj-info-key"><?php echo e(__('messages.project_category')); ?></span>
            <span class="proj-info-val"><?php echo e($project->getCategoryLabel()); ?></span>
          </div>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->completion_date): ?>
            <div class="proj-info-row">
              <span class="proj-info-key"><?php echo e(__('messages.project_year')); ?></span>
              <span class="proj-info-val"><?php echo e($project->completion_date->format('Y')); ?></span>
            </div>
          <?php elseif($project->year): ?>
            <div class="proj-info-row">
              <span class="proj-info-key"><?php echo e(__('messages.project_year')); ?></span>
              <span class="proj-info-val"><?php echo e($project->year); ?></span>
            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->capacity_birds && $project->capacity_birds > 0): ?>
            <div class="proj-info-row">
              <span class="proj-info-key"><?php echo e(__('messages.project_capacity')); ?></span>
              <span class="proj-info-val"><?php echo e(number_format($project->capacity_birds)); ?></span>
            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->barns_count): ?>
            <div class="proj-info-row">
              <span class="proj-info-key"><?php echo e(__('messages.project_barns')); ?></span>
              <span class="proj-info-val"><?php echo e($project->barns_count); ?></span>
            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->area_m2): ?>
            <div class="proj-info-row">
              <span class="proj-info-key"><?php echo e(__('messages.project_area')); ?></span>
              <span class="proj-info-val"><?php echo e(number_format($project->area_m2)); ?> <?php echo e(__('messages.sqm_unit')); ?></span>
            </div>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </aside>

      </div>
    </div>
  </section>

  
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->video_url): ?>
  <section class="py-16 lg:py-20">
    <div class="proj-content">

      <span class="proj-section-label" data-reveal><?php echo e(__('messages.project_video')); ?></span>

      <?php
        $ytId    = $project->getYoutubeId();
        $viId    = $project->getVimeoId();
        $isEmbed = $ytId || $viId;
        $poster  = $project->getCoverUrl('card');
      ?>

      <div class="proj-video-wrap" data-reveal
           x-data="{ playing: false }"
           :class="playing ? 'is-playing' : ''"
           @click="playing = true">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($poster): ?>
          <img class="proj-video-poster" src="<?php echo e($poster); ?>" alt="<?php echo e($project->title); ?>" loading="lazy">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="proj-video-overlay" x-show="!playing">
          <button type="button" class="proj-video-btn" :aria-label="'<?php echo e(__('messages.project_play_video')); ?>'">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7" aria-hidden="true">
              <path d="M8 5v14l11-7z"/>
            </svg>
          </button>
          <span class="proj-video-label"><?php echo e(__('messages.project_play_video')); ?></span>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ytId): ?>
          <iframe x-show="playing"
                  :src="playing ? 'https://www.youtube.com/embed/<?php echo e($ytId); ?>?autoplay=1&rel=0' : ''"
                  class="proj-video-iframe"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                  title="<?php echo e($project->title); ?>"
                  loading="lazy"></iframe>
        <?php elseif($viId): ?>
          <iframe x-show="playing"
                  :src="playing ? 'https://player.vimeo.com/video/<?php echo e($viId); ?>?autoplay=1' : ''"
                  class="proj-video-iframe"
                  allow="autoplay; fullscreen; picture-in-picture"
                  allowfullscreen
                  title="<?php echo e($project->title); ?>"
                  loading="lazy"></iframe>
        <?php else: ?>
          
          <video x-show="playing"
                 x-ref="vid"
                 class="proj-video-iframe"
                 :autoplay="playing"
                 controls
                 preload="none"
                 x-init="$watch('playing', v => { if(v) $refs.vid.play(); })">
            <source src="<?php echo e($project->video_url); ?>" type="video/mp4">
          </video>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

      </div>
    </div>
  </section>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

  
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($galleryImages) > 0): ?>
  <section class="py-16 lg:py-20">
    <div class="proj-content"
         x-data="{
           open: false,
           idx: 0,
           images: <?php echo e(Js::from($galleryImages)); ?>,
           openAt(i) { this.idx = i; this.open = true; document.body.style.overflow = 'hidden'; },
           close()   { this.open = false; document.body.style.overflow = ''; },
           prev()    { this.idx = (this.idx - 1 + this.images.length) % this.images.length; },
           next()    { this.idx = (this.idx + 1) % this.images.length; },
         }"
         @keydown.escape.window="close()"
         @keydown.arrow-left.window="open && (<?php echo e(app()->getLocale() === 'ar' ? 'next()' : 'prev()'); ?>)"
         @keydown.arrow-right.window="open && (<?php echo e(app()->getLocale() === 'ar' ? 'prev()' : 'next()'); ?>)">

      <span class="proj-section-label" data-reveal><?php echo e(__('messages.project_gallery')); ?></span>

      <div class="proj-gallery-grid" data-stagger>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <button type="button"
                  class="proj-gallery-item"
                  @click="openAt(<?php echo e($i); ?>)"
                  aria-label="<?php echo e(__('messages.project_img_alt')); ?> <?php echo e($i + 1); ?>">
            <img src="<?php echo e($img['thumb']); ?>"
                 data-full="<?php echo e($img['full']); ?>"
                 alt="<?php echo e($img['alt']); ?> <?php echo e($i + 1); ?>"
                 loading="lazy" decoding="async"/>
          </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

      
      <div class="proj-lightbox"
           x-show="open"
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition ease-in duration-150"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           @click.self="close()"
           role="dialog" aria-modal="true"
           style="display:none">

        <img :src="images[idx]?.full"
             :alt="images[idx]?.alt"
             class="proj-lightbox-img"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"/>

        <button type="button" class="proj-lightbox-close" @click="close()" aria-label="Close">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <button type="button" class="proj-lightbox-nav proj-lightbox-prev"
                @click="prev()" aria-label="Previous">
          <i data-lucide="chevron-<?php echo e(app()->getLocale() === 'ar' ? 'right' : 'left'); ?>" class="w-5 h-5"></i>
        </button>
        <button type="button" class="proj-lightbox-nav proj-lightbox-next"
                @click="next()" aria-label="Next">
          <i data-lucide="chevron-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>" class="w-5 h-5"></i>
        </button>

        <div class="proj-lightbox-counter" aria-live="polite">
          <span x-text="idx + 1"></span> / <span x-text="images.length"></span>
        </div>

      </div>

    </div>
  </section>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

  
  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($related->count() > 0): ?>
  <section class="py-20 lg:py-28" style="background:var(--paper)">
    <div class="proj-content">

      <div class="flex items-end justify-between gap-6 mb-10">
        <div data-reveal="left">
          <span class="proj-section-label"><?php echo e($project->getCategoryLabel()); ?></span>
          <h2 class="display-3 mt-1"><?php echo e(__('messages.project_related')); ?></h2>
        </div>
        <a href="<?php echo e(route('projects.index', app()->getLocale())); ?>"
           class="projects-cta-link hidden lg:inline-flex items-center gap-2" data-reveal="right">
          <?php echo e(__('messages.projects_cta')); ?>

          <i data-lucide="arrow-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>" class="w-4 h-4"></i>
        </a>
      </div>

      <div class="proj-related-grid" data-stagger>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('projects.show', [app()->getLocale(), $rel->slug])); ?>"
             class="pi-card">
            <div class="pi-card-img">
              <img src="<?php echo e($rel->getCoverUrl('card') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=900&q=82&auto=format&fit=crop'); ?>"
                   alt="<?php echo e($rel->title); ?>" loading="lazy" decoding="async"/>
              <div class="pi-card-img-overlay" aria-hidden="true"></div>
              <span class="pi-card-cat"><?php echo e($rel->getCategoryLabel()); ?></span>
            </div>
            <div class="pi-card-body">
              <div class="pi-card-title"><?php echo e($rel->title); ?></div>
              <div class="pi-card-meta">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rel->location_code): ?>
                  <span class="pi-card-meta-item">
                    <i data-lucide="map-pin" class="w-3 h-3" aria-hidden="true"></i>
                    <?php echo e($rel->location_code); ?>

                  </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              </div>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rel->capacity_birds && $rel->capacity_birds > 0): ?>
                <div class="pi-card-stat">
                  <span class="pi-card-stat-num"><?php echo e(number_format($rel->capacity_birds / 1000, 0)); ?>K</span>
                  <span class="pi-card-stat-label"><?php echo e(__('messages.birds_unit')); ?></span>
                </div>
              <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="pi-card-arrow">
              <span><?php echo e(__('messages.view_project')); ?></span>
              <i data-lucide="arrow-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>" class="w-4 h-4"></i>
            </div>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>

    </div>
  </section>
  <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

  
  <section class="py-20 lg:py-28">
    <div class="proj-content">
      <div class="proj-cta" data-reveal="scale">
        <span class="eyebrow eyebrow--light"><?php echo e(__('messages.project_cta_title')); ?></span>
        <p class="lead" style="color:rgba(255,255,255,.65);max-width:480px">
          <?php echo e(__('messages.project_cta_blurb')); ?>

        </p>
        <div class="flex flex-wrap gap-4 justify-center mt-2">
          <a href="<?php echo e(route('home', app()->getLocale())); ?>#contact"
             class="btn btn-primary btn-lg" data-magnetic>
            <?php echo e(__('messages.project_cta_btn')); ?>

            <i data-lucide="arrow-<?php echo e(app()->getLocale() === 'ar' ? 'left' : 'right'); ?>" class="w-4 h-4"></i>
          </a>
          <a href="<?php echo e(route('home', app()->getLocale())); ?>#calculator"
             class="btn btn-ghost btn-lg" style="color:#fff;border-color:rgba(255,255,255,.2)">
            <?php echo e(__('messages.calc_eyebrow')); ?>

          </a>
        </div>
      </div>
    </div>
  </section>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c0e86a062c1c5bb6d0e151b7076f3fd)): ?>
<?php $attributes = $__attributesOriginal8c0e86a062c1c5bb6d0e151b7076f3fd; ?>
<?php unset($__attributesOriginal8c0e86a062c1c5bb6d0e151b7076f3fd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c0e86a062c1c5bb6d0e151b7076f3fd)): ?>
<?php $component = $__componentOriginal8c0e86a062c1c5bb6d0e151b7076f3fd; ?>
<?php unset($__componentOriginal8c0e86a062c1c5bb6d0e151b7076f3fd); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/projects/show.blade.php ENDPATH**/ ?>