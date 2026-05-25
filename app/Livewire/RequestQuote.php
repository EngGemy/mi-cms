<?php

namespace App\Livewire;

use App\Models\ContactSubmission;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RequestQuote extends Component
{
    public int    $productId   = 0;
    public string $productName = '';

    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('required|string|max:30')]
    public string $phone = '';

    #[Validate('nullable|string|max:30')]
    public string $flock_size = '';

    #[Validate('nullable|string|max:600')]
    public string $message = '';

    // Simple honeypot field — must remain empty
    public string $website = '';

    public bool $submitted = false;

    public function mount(int $productId, string $productName): void
    {
        $this->productId   = $productId;
        $this->productName = $productName;
        $this->message     = __('messages.quote_default_message', ['product' => $productName]);
    }

    public function submit(): void
    {
        // Honeypot check
        if ($this->website !== '') {
            return;
        }

        $this->validate();

        ContactSubmission::create([
            'product_id' => $this->productId ?: null,
            'name'       => $this->name,
            'email'      => '',
            'phone'      => $this->phone,
            'flock_size' => $this->flock_size,
            'message'    => $this->message,
            'locale'     => app()->getLocale(),
            'ip_address' => request()->ip(),
            'status'     => 'new',
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.request-quote');
    }
}
