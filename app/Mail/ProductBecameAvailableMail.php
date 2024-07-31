<?php

namespace App\Mail;

use App\Models\Product;
use App\Services\SiteConfigService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductBecameAvailableMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $content;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $name, public Product $product)
    {
        $this->content = \Str::replace([
            '{name}',
            '{product_title}'
        ], [
            $this->name,
            $this->product->title,
        ], SiteConfigService::getParamValue('product_became_available_email_content'));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Товар снова в наличии',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.product_became_available',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
