@if($quote)
<section class="chairman-section" style="background:linear-gradient(180deg, var(--paper) 0%, var(--cream) 100%)">
  <div class="chairman-watermark" aria-hidden="true" data-parallax="0.06">mi</div>
  <div class="chairman-content">
    <div data-reveal><span class="eyebrow">{{ __('messages.chairman_eyebrow') }}</span></div>
    <div data-reveal="scale" data-reveal-delay="0.1"><div class="chairman-avatar">mi</div></div>
    <blockquote class="chairman-quote" data-reveal="clip" data-reveal-delay="0.2">
      <span class="chairman-quotemark">"</span>
      {{ $quote->quote }}
      <span class="chairman-quotemark" style="transform:translateY(40px);margin-right:0">"</span>
    </blockquote>
    <div class="chairman-signature" data-reveal data-reveal-delay="0.5">
      <div class="chairman-sig-mark">{{ $quote->signature_name }}</div>
      <div class="chairman-sig-name">{{ $quote->signature_role }}</div>
      @if($quote->signature_role_en)
        <div class="chairman-sig-role">{{ $quote->signature_role_en }}</div>
      @endif
    </div>
  </div>
</section>
@endif
