<?php

return [
    'uploadPath' => ROOT . '/public' . env('UPLOADS_DIR', '/uploads/'),
    'maxSize' => '8M',
    'mimeType' => ['image/png', 'image/jpeg', 'image/gif'],
    'resizeTo' => [320, 240],
    'minWidth' => 64,
    'minHeight' => 64,
    'maxWidth' => 1920,
    'maxHeight' => 1200,
];