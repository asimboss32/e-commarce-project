<?php

use App\Http\Controllers\frontendcontroller;
use Illuminate\Support\Facades\Route;



Route:: get('/',[frontendcontroller::class,'index']);

Route:: get('/shop',[frontendcontroller::class,'shop']);