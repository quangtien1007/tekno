<div>
<a id="bubble-chat" onclick="openChat();">
    <i class="fa-regular fa-message fa-bounce fa-2xl"></i>
</a>
<div id="chat-area">
    <div id="header_chat">
        <div class="card-header header-item">
            @if(isset($clicked_user)) {{ $clicked_user->name }}

            @elseif($admin->is_online)
                <i class="fa fa-circle text-success"></i>  Nhân viên đang online
            @else
                Chăm sóc khách hàng
            @endif
            <a onclick="hideChat()"><i class="fa-solid fa-xmark fa-lg" style="color: #ffffff;"></i></a>
        </div>
    </div>
    <div id="content_chat">
        <div>
            <div class="card">
                <div class="card-body message-box">
                    @if(!$messages)
                        No messages to show
                    @else
                        @if(isset($messages))
                            @foreach($messages as $message)
                                <div class="single-message @if($message->user_id !== auth()->id()) received @else sent @endif">
                                    <p class="font-weight-bolder my-0">{{ $message->user->name }}</p>
                                    <p class="my-0">{{ $message->message }}</p>
                                    @if (isPhoto($message->file))
                                        <div class="w-100 my-2">
                                            <img class="img-fluid rounded" loading="lazy" style="height: 250px" src="{{ $message->file }}">
                                        </div>
                                    @elseif (isVideo($message->file))
                                        <div class="w-100 my-2">
                                            <video style="height: 250px" class="img-fluid rounded" controls>
                                                <source src="{{ $message->file }}">
                                            </video>
                                        </div>
                                    @elseif ($message->file)
                                        <div class="w-100 my-2">
                                            <a href="{{ $message->file}}" class="bg-light p-2 rounded-pill" target="_blank"><i class="fa fa-download"></i>
                                                {{ $message->file_name }}
                                            </a>
                                        </div>
                                    @endif
                                    <small class="text-muted w-100">Đã gửi <em>{{ $message->created_at }}</em></small>
                                </div>
                            @endforeach
                        @else
                            Chưa có tin nhắn nào
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="footer_chat" wire:poll.20s="mountComponent()">
        <form wire:submit.prevent="SendMessage" enctype="multipart/form-data">
            <div wire:loading wire:target='SendMessage'>
                Đang gửi tin nhắn . . .
            </div>
            <div wire:loading wire:target="file">
                Đang upload tập tin . . .
            </div>
            @if($file)
                <div class="mb-2">
                   Bạn đã upload 1 file <button type="button" wire:click="resetFile" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Gỡ {{ $file->getClientOriginalName() }}</button>
                </div>
            @else
                Không có tập tin nào được upload.
            @endif
            <div class="row footer_chat">
                <div class="col-md-7">
                    <input wire:model="message" class="form-control input shadow-none w-100 d-inline-block input-message" placeholder="Nhập tin nhắn..." @if(!$file) required @endif>
                </div>
                @if(empty($file))
                <div class="col-md-1">
                    <button type="button" class="border" id="file-area">
                        <label>
                            <i class="fa fa-file-upload"></i>
                            <input type="file" wire:model="file">
                        </label>
                    </button>
                </div>
                @endif
                <div class="col-md-4">
                    <button class="btn btn-send btn-danger d-inline-block w-100"><i class="far fa-paper-plane"></i> Gửi</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
