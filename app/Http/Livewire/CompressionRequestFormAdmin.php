<?php

namespace App\Http\Livewire;

use App\Models\PressingRequest;
use App\Models\PressingRequestTransaction;
use Livewire\Component;

class CompressionRequestFormAdmin extends Component
{
    public function render()
    {
        $pressing_requests = PressingRequest::where('status','!=','complete')->where('quantity','!=','0')->latest()->paginate(10);
        return view('livewire.compression-request-form-admin',compact('pressing_requests'));
    }
}
