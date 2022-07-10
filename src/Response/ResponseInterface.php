<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable\Response;

interface ResponseInterface
{
    public function getLength(): int;

    public function getContent();
}
