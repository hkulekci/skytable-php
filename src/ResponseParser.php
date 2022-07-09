<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable;


use Skytable\Response\BinaryStringResponse;
use Skytable\Response\CodeResponse;
use Skytable\Response\IntResponse;
use Skytable\Response\Response;
use Skytable\Response\StringResponse;

class ResponseParser
{
    protected string $response;

    /**
     * @param string $response
     */
    public function __construct(string $response)
    {
        $this->response = $response;
    }

    public function parse(): array
    {
        $responses = [];
        $lines = explode("\n", $this->response);
        if (isset($lines[0]) && strpos($lines[0], '*') === 0) {
            $numberOfActions = (int) substr($lines[0], 1);
            for ($i = 1; $i < $numberOfActions * 2; $i += 2) {
                if (str_starts_with($lines[$i], ':')) {
                    $responses[] = new IntResponse([
                        $lines[$i], $lines[$i + 1]
                    ]);
                } elseif (str_starts_with($lines[$i], '+')) {
                    $responses[] = new StringResponse([
                        $lines[$i], $lines[$i + 1]
                    ]);
                } elseif (str_starts_with($lines[$i], '!')) {
                    $responses[] = new CodeResponse([
                        $lines[$i], $lines[$i + 1]
                    ]);
                } elseif (str_starts_with($lines[$i], '?')) {
                    $responses[] = new BinaryStringResponse([
                        $lines[$i], $lines[$i + 1]
                    ]);
                } elseif (str_starts_with($lines[$i], '$')) {
                    $responses[] = new StringResponse([
                        $lines[$i], $lines[$i + 1]
                    ]);
                } else {
                    $responses[] = new Response([
                        $lines[$i], $lines[$i + 1]
                    ]);
                }

            }
        }

        return $responses;
    }
}
