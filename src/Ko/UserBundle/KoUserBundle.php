<?php

namespace Ko\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KoUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
