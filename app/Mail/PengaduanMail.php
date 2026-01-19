<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengaduanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Data ini akan otomatis dikirim ke view

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $email = $this->subject('Pengaduan Baru: ' . $this->data->kategori)
                    ->view('emails.mailpengaduan');

        // Cek jika ada lampiran di database, lalu lampirkan file fisiknya ke email
        if (!empty($this->data->lampiran)) {
            $email->attach(storage_path('app/public/' . $this->data->lampiran));
        }

        return $email;
    }
}
