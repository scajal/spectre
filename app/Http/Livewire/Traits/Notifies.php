<?php

namespace App\Http\Livewire\Traits;

trait Notifies
{
    /**
     * Emits a notification event to the browser
     * with the given message.
     * 
     * @param string $message
     * @return void
     */
    public function notify($message)
    {
        $this->dispatchBrowserEvent('notification', ['message' => $message]);
    }

    /**
     * Emits both a redirection and a notification event.
     * 
     * @param string $url
     * @param string $message
     * @return void
     */
    public function redirectAndNotify($url, $message)
    {
        $this->dispatchBrowserEvent('notification:redirect', [
            'url' => $url,
            'message' => $message
        ]);
    }
}