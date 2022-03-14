<?php

use App\Controllers\AuthorController;

return [
    '/hi' => ['POST', [AuthorController::class, 'add']],
];