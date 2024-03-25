<?php

namespace App\Http\Controllers;

use App\Events\PostCreatedEvent;
use App\Events\PostCreatedOtherEvent;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $event = new PostCreatedEvent(['name' => 'Titre']);
        event($event);
    }

    public function index_2() {
        $event2 = new PostCreatedEvent(['name' => 'Titre2']);
        broadcast($event2)->toOthers();
    }
}
