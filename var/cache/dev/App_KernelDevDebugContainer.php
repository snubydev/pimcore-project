<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerWlildyX\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerWlildyX/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerWlildyX.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerWlildyX\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerWlildyX\App_KernelDevDebugContainer([
    'container.build_hash' => 'WlildyX',
    'container.build_id' => '2ba717fb',
    'container.build_time' => 1673025206,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerWlildyX');