<?php

use App\Http\Controllers\NotificationsController;
use App\Http\Livewire\Channels\AllChannels;
use App\Http\Livewire\Channels\CreateChannel;
use App\Http\Livewire\Channels\EditChannel;
use App\Http\Livewire\Discussions\CreateDiscussion;
use App\Http\Livewire\Discussions\EditDiscussion;
use App\Http\Livewire\Discussions\ShowDiscussion;
use App\Http\Livewire\Home;
use App\Http\Livewire\Replies\EditReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // home
    Route::redirect('/', '/home');
    Route::get('/home', Home::class)->name('home');

    // discussions
    Route::get('discussions/create', CreateDiscussion::class)->name('discussions.create');
    Route::get('discussions/{id}/edit', EditDiscussion::class)->name('discussions.edit');
    Route::get('discussions/{id}/show', ShowDiscussion::class)->name('discussions.show');

    // channels
    Route::middleware('admin')->group(function () {

        Route::get('channels', AllChannels::class)->name('channels.index');
        Route::get('channels/create', CreateChannel::class)->name('channels.create');
        Route::get('channels/{id}/edit', EditChannel::class)->name('channels.edit');

    });

    // replies
    Route::get('/replies/{reply}/edit', EditReply::class)->name('replies.edit');

    Route::get('notifications/mark-all-as-read', [NotificationsController::class, 'markAllAsRead'])->name('markAllAsRead');

    // Route::get('notifications/mark-as-read', [NotificationsController::class, 'markAsRead'])->name('markAsRead');
});






