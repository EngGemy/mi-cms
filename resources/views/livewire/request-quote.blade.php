<div>
  @if($submitted)
    {{-- Success state --}}
    <div class="rq-success" data-reveal>
      <div class="rq-success-icon">
        <i data-lucide="check-circle" class="w-8 h-8"></i>
      </div>
      <h3 class="rq-success-title">{{ __('messages.contact_ok_title') }}</h3>
      <p class="rq-success-body">{{ __('messages.contact_ok') }}</p>
    </div>
  @else
    <form wire:submit="submit" class="rq-form" novalidate>

      {{-- Honeypot --}}
      <div style="position:absolute;left:-9999px;opacity:0;pointer-events:none" aria-hidden="true" tabindex="-1">
        <input type="text" wire:model="website" name="website" tabindex="-1" autocomplete="off">
      </div>

      <div class="rq-grid">
        {{-- Name --}}
        <div class="rq-field">
          <label class="rq-label" for="rq-name">{{ __('messages.field_name') }} <span class="rq-required">*</span></label>
          <input id="rq-name" type="text" wire:model="name" class="rq-input @error('name') is-invalid @enderror"
                 placeholder="{{ __('messages.field_name') }}" autocomplete="name">
          @error('name')<span class="rq-error">{{ $message }}</span>@enderror
        </div>

        {{-- Phone --}}
        <div class="rq-field">
          <label class="rq-label" for="rq-phone">{{ __('messages.field_phone') }} <span class="rq-required">*</span></label>
          <input id="rq-phone" type="tel" wire:model="phone" class="rq-input @error('phone') is-invalid @enderror"
                 placeholder="{{ __('messages.field_phone') }}" autocomplete="tel">
          @error('phone')<span class="rq-error">{{ $message }}</span>@enderror
        </div>

        {{-- Flock size --}}
        <div class="rq-field">
          <label class="rq-label" for="rq-flock">{{ __('messages.field_flock') }}</label>
          <input id="rq-flock" type="text" wire:model="flock_size" class="rq-input"
                 placeholder="{{ __('messages.field_flock_placeholder') }}">
        </div>

        {{-- Message --}}
        <div class="rq-field rq-field--full">
          <label class="rq-label" for="rq-message">{{ __('messages.field_message') }}</label>
          <textarea id="rq-message" wire:model="message" rows="3" class="rq-input rq-textarea"></textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-lg rq-submit" wire:loading.attr="disabled">
        <span wire:loading.remove>{{ __('messages.send_request') }}</span>
        <span wire:loading class="flex items-center gap-2">
          <svg class="animate-spin w-4 h-4" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
          </svg>
          {{ __('messages.sending') }}
        </span>
      </button>

    </form>
  @endif
</div>
