<?php

return [
    App\Providers\AppServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    OwenIt\Auditing\AuditingServiceProvider::class,
    Kyslik\ColumnSortable\ColumnSortableServiceProvider::class,
    \ESolution\DBEncryption\Providers\DBEncryptionServiceProvider::class,
];
