<section id="team" class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="grid lg:grid-cols-2 gap-10 items-end mb-12">
      <div data-reveal="left">
        <span class="eyebrow">{{ __('messages.team_eyebrow') }}</span>
        <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.team_title') }}</h2>
      </div>
      <p class="lead" data-reveal="right">{{ __('messages.team_blurb') }}</p>
    </div>
    <div class="team-grid" data-stagger>
      @foreach($members as $m)
        <div class="team-card @if($m->is_featured)is-featured @endif">
          <span class="team-badge">{{ $m->role }}</span>
          <div class="team-avatar" @if($m->badge_color) style="background:{{ $m->badge_color }}" @endif>{{ $m->initials }}</div>
          <div class="team-role">{{ $m->role }}</div>
          <h3 class="team-name">{{ $m->name }}</h3>
          <p class="team-desc">{{ $m->description }}</p>
          <div class="team-contact">
            @if($m->phone)
              <a href="tel:{{ $m->phone }}" class="team-action">
                <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                <span dir="ltr">{{ $m->phone }}</span>
              </a>
            @endif
            @if($m->whatsapp)
              <a href="{{ $m->getWhatsappLink() }}" class="team-action wa">
                <i data-lucide="message-circle" class="w-3.5 h-3.5"></i> WhatsApp
              </a>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
