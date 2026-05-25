<section id="products" class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-12">
      <div data-reveal="left">
        <span class="eyebrow"><?php echo e(__('messages.products_eyebrow')); ?> · 06</span>
        <h2 class="display-2 mt-2" data-reveal="title">
          <?php echo e(__('messages.products_title_part1')); ?>

          <span class="serif-italic" style="color:var(--mi-red)"><?php echo e(__('messages.brand')); ?></span>
          <?php echo e(__('messages.products_title_part2')); ?>

        </h2>
      </div>
      <p class="lead lg:text-right" data-reveal="right"><?php echo e(__('messages.products_blurb')); ?></p>
    </div>

    <div class="products-grid" data-stagger>
      <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('products.show', [app()->getLocale(), $product->slug])); ?>"
           class="product-card">
          <div class="product-card-image">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->badge): ?>
              <span class="product-card-badge"><?php echo e($product->badge); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <img src="<?php echo e($product->getMainImageUrl('card') ?? 'https://images.unsplash.com/photo-1553531009-c4605ebe6122?w=900&q=85&auto=format&fit=crop'); ?>"
                 alt="<?php echo e($product->name); ?>" loading="lazy"/>
          </div>
          <div class="product-card-body">
            <h3 class="product-card-title"><?php echo e($product->name); ?></h3>
            <p class="product-card-desc"><?php echo e($product->summary); ?></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($product->specs)): ?>
              <div class="product-card-meta">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = array_slice((array) $product->specs, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div><?php echo e($key); ?> <strong><?php echo e($val); ?></strong></div>
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?><div style="color:var(--ink-300)">·</div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
              </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </div>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="text-center mt-12" data-reveal data-reveal-delay="0.2">
      <a href="#contact" class="btn btn-dark btn-lg" data-magnetic>
        <?php echo e(__('messages.products_cta')); ?> <i data-lucide="arrow-left" class="w-4 h-4"></i>
      </a>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/products.blade.php ENDPATH**/ ?>