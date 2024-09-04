<?php

namespace MRP\Puzzle\Utils;

class Parser
{
    public static function splitWithTags(string $text): array
    {
        $result = [];
        preg_match_all('/\[(\w+):(\w*)](.*?)\[\/\1]/', $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $result[$match[1]] = [
                'description' => $match[2],
                'data' => $match[3]
            ];
        }

        return $result;
    }

}
