<?php
namespace Components\Partials\Navbar;

use Viewi\BaseComponent;

class Navbar extends BaseComponent {
    public bool $open = false;

    public function toggle() {
        $this->open = !$this->open;
    }
}
