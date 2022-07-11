<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Skytable\Action;

interface ActionInterface
{
    public function getPayload(): string;
}
