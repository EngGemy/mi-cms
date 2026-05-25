<section class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="grid lg:grid-cols-12 gap-10 items-end mb-10">
      <div class="lg:col-span-7" data-reveal="left">
        <span class="eyebrow"><?php echo e(__('messages.video_eyebrow')); ?></span>
        <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.video_title')); ?></h2>
      </div>
      <p class="lead lg:col-span-5" data-reveal="right"><?php echo e(__('messages.video_blurb')); ?></p>
    </div>
    <div class="video-showcase" data-reveal="scale" data-parallax="0.05">
      <video autoplay muted loop playsinline poster="https://plus.unsplash.com/premium_photo-1661930553507-59420df08d82?w=1600&q=85&auto=format&fit=crop">
        <source src="https://videos.pexels.com/video-files/3045163/3045163-uhd_2560_1440_25fps.mp4" type="video/mp4">
      </video>
      <div class="video-overlay">
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
          <span class="label-mono text-white">LIVE TOUR · 02:34</span>
        </div>
        <div>
          <div class="serif-italic text-white" style="font-size:18px">made in damietta</div>
          <div class="display-3 text-white mt-1"><?php echo e(__('messages.video_headline')); ?></div>
          <div class="flex flex-wrap gap-3 mt-6">
            <a href="#contact" class="btn btn-primary">
              <?php echo e(__('messages.video_cta')); ?> <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/video-showcase.blade.php ENDPATH**/ ?>