<?php

namespace App\Http\Livewire;

use \App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Test extends Component
{
    use WithFileUploads;

    public $message = '';
    public $users;
    public $clicked_user;
    public $messages;
    public $file;
    public $admin;

    public function render()
    {
        return view('livewire.usermessage', [
            'users' => $this->users,
            'admin' => $this->admin
        ]);
    }

    public function mount()
    {
        $this->mountComponent();
    }

    public function mountComponent()
    {
        $this->messages = \App\Models\Message::where('user_id', auth()->id())
            ->orWhere('receiver', auth()->id())
            ->orderBy('id', 'DESC')
            ->get();

        $this->admin = \App\Models\User::where('is_admin', true)->first();
    }

    public function SendMessage()
    {
        if (Auth::check()) {
            $new_message = new \App\Models\Message();
            $new_message->message = $this->message;
            $new_message->user_id = auth()->id();
            //neu khong phai admin thi send toi admin

            $admin = User::where('is_admin', true)->first();
            $this->user_id = $admin->id;

            $new_message->receiver = $this->user_id;

            // Deal with the file if uploaded
            if ($this->file) {
                $file = $this->file->store('public/files');
                $path = url(Storage::url($file));
                $new_message->file = $path;
                $new_message->file_name = $this->file->getClientOriginalName();
            }
            $new_message->save();

            // Clear the message after it's sent
            $this->reset(['message']);
            $this->file = '';
        } else {
            return redirect()->route('user.dangnhap')->with('success', 'Hãy đăng nhập để được tư vấn');
        }
    }

    public function getUser($user_id)
    {
        $this->clicked_user = User::find($user_id);
        $this->messages = \App\Models\Message::where('user_id', $user_id)->get();
    }

    public function resetFile()
    {
        $this->reset('file');
    }
}
