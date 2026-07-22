<div class="calc-gateway-help-band" data-reveal wire:ignore.self>
  <div class="section-inner">
    <div class="calc-gateway-help-head">
      <span class="calc-gateway-eyebrow calc-gateway-eyebrow--help">{{ __('messages.gateway_help_eyebrow') }}</span>
      <h3 class="calc-gateway-help-title">
        {{ __('messages.gateway_help_title') }}
        <span class="calc-gateway-help-icon" aria-hidden="true">
          <i data-lucide="scan-search"></i>
        </span>
      </h3>
      <p class="calc-gateway-help-blurb">{{ __('messages.gateway_help_blurb') }}</p>
    </div>

    <div class="calc-gateway-chips" role="group" aria-label="{{ __('messages.gateway_help_title') }}">
      @foreach($chips as $key => $msg)
        <button
          type="button"
          class="calc-gateway-chip {{ in_array($key, $selected, true) ? 'is-on' : '' }}"
          wire:click="toggle('{{ $key }}')"
          aria-pressed="{{ in_array($key, $selected, true) ? 'true' : 'false' }}"
        >{{ __("messages.{$msg}") }}</button>
      @endforeach
    </div>

    <div class="calc-gateway-continue-wrap">
      <button
        type="button"
        class="calc-gateway-continue {{ $selected !== [] ? 'is-ready' : '' }}"
        wire:click="openModal"
        @disabled($selected === [])
      >
        <span>{{ __('messages.gateway_help_continue') }}</span>
        <i data-lucide="arrow-left" aria-hidden="true"></i>
      </button>
    </div>
  </div>

  @if($showModal)
    <div
      class="gw-modal"
      role="dialog"
      aria-modal="true"
      aria-labelledby="gwModalTitle"
      wire:keydown.escape.window="closeModal"
    >
      <div class="gw-modal-backdrop" wire:click="closeModal"></div>
      <div class="gw-modal-panel">
        <button type="button" class="gw-modal-close" wire:click="closeModal" aria-label="{{ __('messages.close_menu') }}">
          <i data-lucide="x"></i>
        </button>

        @if($submitted)
          <div class="gw-modal-success">
            <div class="gw-modal-success-icon" aria-hidden="true">
              <i data-lucide="check-circle"></i>
            </div>
            <h3 id="gwModalTitle" class="gw-modal-title">{{ __('messages.contact_ok_title') }}</h3>
            <p class="gw-modal-blurb">{{ __('messages.contact_ok') }}</p>
            <button type="button" class="btn btn-primary gw-modal-submit" wire:click="closeModal">
              {{ __('messages.close_menu') }}
            </button>
          </div>
        @else
          <h3 id="gwModalTitle" class="gw-modal-title">{{ __('messages.gateway_modal_title') }}</h3>
          <p class="gw-modal-blurb">{{ __('messages.gateway_modal_blurb') }}</p>

          <form wire:submit="submit" class="gw-modal-form" novalidate>
            <div style="position:absolute;left:-9999px;opacity:0;pointer-events:none" aria-hidden="true" tabindex="-1">
              <input type="text" wire:model="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="gw-modal-field">
              <label class="gw-modal-label" for="gw-name">{{ __('messages.field_name') }} <span class="rq-required">*</span></label>
              <input
                id="gw-name"
                type="text"
                wire:model="name"
                class="gw-modal-input @error('name') is-invalid @enderror"
                placeholder="{{ __('messages.field_name') }}"
                autocomplete="name"
              >
              @error('name')<span class="rq-error">{{ $message }}</span>@enderror
            </div>

            <div class="gw-modal-field">
              <label class="gw-modal-label" for="gw-phone">{{ __('messages.field_phone') }} <span class="rq-required">*</span></label>
              <input
                id="gw-phone"
                type="tel"
                wire:model="phone"
                class="gw-modal-input @error('phone') is-invalid @enderror"
                placeholder="{{ __('messages.field_phone') }}"
                autocomplete="tel"
              >
              @error('phone')<span class="rq-error">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="btn btn-primary gw-modal-submit" wire:loading.attr="disabled">
              <span wire:loading.remove>{{ __('messages.send_request') }}</span>
              <span wire:loading>{{ __('messages.sending') }}</span>
            </button>
          </form>
        @endif
      </div>
    </div>
  @endif
</div>
