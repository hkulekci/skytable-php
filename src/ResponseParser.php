<?php
/**
 * @since     Jul 2022
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Skytable;


use Skytable\Response\BinaryStringResponse;
use Skytable\Response\CodeResponse;
use Skytable\Response\IntResponse;
use Skytable\Response\JsonResponse;
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
        if (isset($lines[0]) && str_starts_with($lines[0], '*')) {
            $numberOfActions = (int) substr($lines[0], 1);
            for ($i = 1; $i < $numberOfActions * 2; $i += 2) {
                $data = [$lines[$i], $lines[$i + 1]];
                $responses[] = match ($lines[$i][0]) {
                    ':' => new IntResponse($data),
                    '+' => new StringResponse($data),
                    '!' => new CodeResponse($data),
                    '?' => new BinaryStringResponse($data),
                    '$' => new JsonResponse($data),
                    default => new Response($data),
                };
            }
        }

        return $responses;
    }
}
