@if($quote)
<section class="chairman-section" style="background:linear-gradient(180deg, var(--paper) 0%, var(--cream) 100%)">
  <div class="chairman-watermark" aria-hidden="true" data-parallax="0.06">mi</div>
  <div class="chairman-content">
    <div data-reveal><span class="eyebrow">{{ __('messages.chairman_eyebrow') }}</span></div>
    <div data-reveal="scale" data-reveal-delay="0.1"><div class="chairman-avatar">mi</div></div>

    <blockquote
      class="chairman-quote"
      data-chairman-typewriter
      data-quote="{{ $quote->quote }}"
    >
      <span class="chairman-quotemark chairman-quotemark--open" aria-hidden="true">"</span>
      <span class="chairman-quote-typed" aria-live="polite"></span>
      <span class="chairman-type-caret" aria-hidden="true"></span>
      <span class="chairman-quotemark chairman-quotemark--close" aria-hidden="true">"</span>
      {{-- Full text for accessibility / no-JS fallback --}}
      <span class="chairman-quote-fallback">{{ $quote->quote }}</span>
    </blockquote>

    <div class="chairman-signature" data-chairman-signature>
      <div class="chairman-sig-mark">{{ $quote->signature_name }}</div>
      <div class="chairman-sig-name">{{ $quote->signature_role }}</div>
      @if($quote->signature_role_en)
        <div class="chairman-sig-role">{{ $quote->signature_role_en }}</div>
      @endif
    </div>
  </div>
</section>
@endif
