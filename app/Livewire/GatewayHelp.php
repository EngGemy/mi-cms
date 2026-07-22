<?php

namespace App\Livewire;

use App\Models\ContactSubmission;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GatewayHelp extends Component
{
    /** @var list<string> */
    public array $selected = [];

    public bool $showModal = false;

    public bool $submitted = false;

    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('required|string|max:30')]
    public string $phone = '';

    /** Honeypot — must stay empty */
    public string $website = '';

    /** @var array<string, string> */
    private const CHIP_KEYS = [
        'layers' => 'gateway_chip_layers',
        'broilers' => 'gateway_chip_broilers',
        'turnkey' => 'gateway_chip_turnkey',
        'consult' => 'gateway_chip_consult',
    ];

    public function toggle(string $key): void
    {
        if (! array_key_exists($key, self::CHIP_KEYS)) {
            return;
        }

        if (in_array($key, $this->selected, true)) {
            $this->selected = array_values(array_diff($this->selected, [$key]));
        } else {
            $this->selected[] = $key;
        }
    }

    public function openModal(): void
    {
        if ($this->selected === []) {
            return;
        }

        $this->showModal = true;
        $this->submitted = false;
        $this->js('document.body.classList.add("gw-modal-open")');
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->js('document.body.classList.remove("gw-modal-open")');
    }

    public function submit(): void
    {
        if ($this->website !== '') {
            return;
        }

        if ($this->selected === []) {
            return;
        }

        $this->validate();

        $labels = collect($this->selected)
            ->map(fn (string $key) => __('messages.'.self::CHIP_KEYS[$key]))
            ->implode(app()->getLocale() === 'ar' ? '، ' : ', ');

        ContactSubmission::create([
            'name' => $this->name,
            'email' => '',
            'phone' => $this->phone,
            'company' => 'Gateway Help',
            'message' => __('messages.gateway_message_prefix').' '.$labels,
            'locale' => app()->getLocale(),
            'ip_address' => request()->ip(),
            'status' => 'new',
        ]);

        $this->submitted = true;
        $this->reset('name', 'phone', 'selected');
    }

    public function render()
    {
        return view('livewire.gateway-help', [
            'chips' => self::CHIP_KEYS,
        ]);
    }
}
