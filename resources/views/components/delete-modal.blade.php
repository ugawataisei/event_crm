<?php

use Illuminate\Console\Scheduling\Event;

/** @var Event $model */
/** @var string $title */

?>
<div class="modal fade" id="delete{{ $model->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    本当に削除しても大丈夫ですか？？
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::open(['route' => 'manager.event.delete', 'method' => 'post']) }}
                @method('POST')
                @csrf

                {{ Form::hidden('id', $model->id) }}

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i>{{ __('message.btn_labels.close') }}</button>
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i>{{ __('message.btn_labels.delete') }}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


