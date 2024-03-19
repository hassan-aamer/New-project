<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return '<script>window.location.href = "' . url('https://github.com/hassan-aamer') . '";</script>';
});
