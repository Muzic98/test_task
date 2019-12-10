<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JsonRPC\Server;
use App\User;
use App\Gallery;

class jsonrpc extends Controller
{
    public function index()
    {
        $callbacks = [
            'getUsers' => [$this, 'getUsers'],
            'getGallery'  => [$this, 'getGallery'],
        ];

        $server = new Server();
        $server->getProcedureHandler()->withClassAndMethodArray($callbacks);

        echo $server->execute();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getGallery()
    {
        return Gallery::all();
    }
}
