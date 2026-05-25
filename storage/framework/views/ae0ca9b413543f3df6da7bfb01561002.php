<section id="calculator" class="py-24 lg:py-32 bg-paper">
  <div class="section-inner">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="eyebrow"><?php echo e(__('messages.calc_eyebrow')); ?></span>
      <h2 class="display-2 mt-2" data-reveal="title"><?php echo e(__('messages.calc_title')); ?></h2>
      <p class="lead mt-5" data-reveal data-reveal-delay="0.1"><?php echo e(__('messages.calc_blurb')); ?></p>
    </div>
    <div data-reveal="scale" data-reveal-delay="0.15">
      <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('price-calculator');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-43921532-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
  </div>
</section>
<?php /**PATH D:\laragon\www\mi\mi-poultry-cms\mi-poultry-cms\resources\views/sections/calculator.blade.php ENDPATH**/ ?>