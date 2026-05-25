<div class="calc-card" data-reveal>
  <div class="calc-grid">

    <div class="calc-form">
      <div class="calc-section-title"><?php echo e(__('messages.calc_dimensions')); ?></div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text"><?php echo e(__('messages.calc_length')); ?></span>
          <span class="calc-value-pill"><?php echo e($length); ?> م</span>
        </div>
        <input type="range" class="calc-slider" wire:model.live="length" min="30" max="150" step="1"/>
      </div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text"><?php echo e(__('messages.calc_width')); ?></span>
          <span class="calc-value-pill"><?php echo e($width); ?> م</span>
        </div>
        <input type="range" class="calc-slider" wire:model.live="width" min="8" max="20" step="1"/>
      </div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text"><?php echo e(__('messages.calc_height')); ?></span>
          <span class="calc-value-pill"><?php echo e($height); ?> م</span>
        </div>
        <input type="range" class="calc-slider" wire:model.live="height" min="3" max="5" step="0.5"/>
      </div>

      <div class="calc-section-title" style="margin-top:32px"><?php echo e(__('messages.calc_battery')); ?></div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text"><?php echo e(__('messages.calc_floors')); ?></span>
          <span class="calc-value-pill"><?php echo e($floors); ?></span>
        </div>
        <div class="calc-radio-group">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [3,4,5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" wire:click="$set('floors', <?php echo e($v); ?>)" wire:loading.attr="disabled"
                    class="calc-radio <?php if($floors === $v): ?> is-active <?php endif; ?>"><?php echo e($v); ?></button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>

      <div class="calc-row">
        <div class="calc-label">
          <span class="calc-label-text"><?php echo e(__('messages.calc_lines')); ?></span>
          <span class="calc-value-pill"><?php echo e($lines); ?></span>
        </div>
        <div class="calc-radio-group">
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [3,4,5,6]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" wire:click="$set('lines', <?php echo e($v); ?>)"
                    class="calc-radio <?php if($lines === $v): ?> is-active <?php endif; ?>"><?php echo e($v); ?></button>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
      </div>

      <div class="mt-8 p-5 rounded-2xl" style="background:rgba(200,16,46,.05);border:1px solid rgba(200,16,46,.12)">
        <div class="flex items-start gap-3">
          <i data-lucide="info" class="w-5 h-5 flex-shrink-0 mt-0.5" style="color:var(--mi-red)"></i>
          <div>
            <div style="font-weight:700;font-size:14px;color:var(--ink-900);margin-bottom:4px">
              <?php echo e(__('messages.calc_disclaimer_title')); ?>

            </div>
            <div style="font-size:13px;line-height:1.7;color:var(--ink-600)"><?php echo e(__('messages.calc_disclaimer_body')); ?></div>
          </div>
        </div>
      </div>
    </div>

    <div class="calc-result">
      <div class="relative" style="z-index:1">
        <div class="calc-birds-bar">
          <div>
            <div class="calc-birds-bar-label"><?php echo e(__('messages.calc_capacity')); ?></div>
            <div style="color:rgba(255,255,255,.5);font-size:11px;margin-top:2px" class="font-mono">
              EFFECTIVE LENGTH × 2 × FLOORS × LINES × 16
            </div>
          </div>
          <div class="calc-birds-bar-num"><?php echo e(number_format($breakdown['birds'] ?? 0)); ?>

            <span style="font-size:14px;font-weight:600;color:rgba(255,255,255,.6);margin-right:6px">طائر</span>
          </div>
        </div>

        <div class="calc-section-title" style="margin-top:24px">بند الإنشاءات</div>
        <?php ($c = $breakdown['construction'] ?? []); ?>
        <div class="calc-line"><div class="calc-line-name">الخرسانات</div><div class="calc-line-val"><?php echo e(number_format($c['concrete'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">الاستيل</div><div class="calc-line-val"><?php echo e(number_format($c['steel'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">الحوائط</div><div class="calc-line-val"><?php echo e(number_format($c['walls'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">الخزانات</div><div class="calc-line-val"><?php echo e(number_format($c['tanks'] ?? 0)); ?></div></div>
        <div class="calc-subtotal"><span>إجمالي الإنشاءات</span><span class="calc-subtotal-val"><?php echo e(number_format($c['total'] ?? 0)); ?></span></div>

        <div class="calc-section-title" style="margin-top:20px">بند البطارية</div>
        <div class="calc-line"><div class="calc-line-name">البطاريات</div><div class="calc-line-val"><?php echo e(number_format($breakdown['battery']['total'] ?? 0)); ?></div></div>

        <div class="calc-section-title" style="margin-top:20px">بند المشتملات</div>
        <?php ($a = $breakdown['accessories'] ?? []); ?>
        <div class="calc-line"><div class="calc-line-name">الشفاطات الخلفية (<?php echo e($a['rear_fans']['count'] ?? 0); ?>)</div><div class="calc-line-val"><?php echo e(number_format($a['rear_fans']['total'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">منظومة التبريد</div><div class="calc-line-val"><?php echo e(number_format($a['cooling']['total'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">الشبابيك (<?php echo e($a['windows']['count'] ?? 0); ?>)</div><div class="calc-line-val"><?php echo e(number_format($a['windows']['total'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">الشفاطات الجانبية (<?php echo e($a['side_fans']['count'] ?? 0); ?>)</div><div class="calc-line-val"><?php echo e(number_format($a['side_fans']['total'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">الدفايات (<?php echo e($a['heaters']['count'] ?? 0); ?>)</div><div class="calc-line-val"><?php echo e(number_format($a['heaters']['total'] ?? 0)); ?></div></div>
        <div class="calc-line"><div class="calc-line-name">منظومة التحكم</div><div class="calc-line-val"><?php echo e(number_format($a['control']['total'] ?? 0)); ?></div></div>
        <div class="calc-subtotal"><span>إجمالي المشتملات</span><span class="calc-subtotal-val"><?php echo e(number_format($a['total'] ?? 0)); ?></span></div>

        <div class="calc-grand">
          <div class="calc-grand-label"><?php echo e(__('messages.calc_grand_total')); ?></div>
          <div class="calc-grand-num">
            <span class="calc-grand-currency">ج.م</span><?php echo e(number_format($breakdown['grand_total'] ?? 0)); ?>

          </div>
          <div class="calc-grand-note"><?php echo e(__('messages.calc_grand_note')); ?></div>
        </div>

        <div class="flex flex-wrap gap-3 mt-6">
          <button type="button" wire:click="persist" class="btn btn-primary flex-1" data-magnetic>
            <i data-lucide="send" class="w-4 h-4"></i> <?php echo e(__('messages.calc_persist')); ?>

          </button>
          <a href="tel:<?php echo e(config('mi.phone_primary')); ?>" class="btn flex-1"
             style="background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.2);backdrop-filter:blur(8px)" data-magnetic>
            <i data-lucide="phone" class="w-4 h-4"></i>
            <span dir="ltr"><?php echo e(config('mi.phone_primary')); ?></span>
          </a>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('calc_ok')): ?>
          <p class="text-sm mt-4" style="color:var(--mi-red-light)">✔ <?php echo e(session('calc_ok')); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/livewire/price-calculator.blade.php ENDPATH**/ ?>