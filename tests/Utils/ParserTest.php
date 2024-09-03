<?php

namespace MRP\Puzzle\Utils;

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{

    public function testBasicFunctionality()
    {
        $text = '[TAG_NAME:description]data[/TAG_NAME]';
        $expected = [
            'TAG_NAME' => [
                'description' => 'description',
                'data' => 'data'
            ]
        ];
        $this->assertEquals($expected, Parser::splitWithTags($text));
    }

    public function testMultipleTags()
    {
        $text = '[TAG1:desc1]data1[/TAG1][TAG2:desc2]data2[/TAG2]';
        $expected = [
            'TAG1' => [
                'description' => 'desc1',
                'data' => 'data1'
            ],
            'TAG2' => [
                'description' => 'desc2',
                'data' => 'data2'
            ]
        ];
        $this->assertEquals($expected, Parser::splitWithTags($text));
    }

    public function testMultipleTagsWithGarbage()
    {
        $text = '[TAG1:desc1]data1[/TAG1]-----[TAG2:desc2]data2[/TAG2]';
        $expected = [
            'TAG1' => [
                'description' => 'desc1',
                'data' => 'data1'
            ],
            'TAG2' => [
                'description' => 'desc2',
                'data' => 'data2'
            ]
        ];
        $this->assertEquals($expected, Parser::splitWithTags($text));
    }

    public function testEmptyDescription()
    {
        $text = '[TAG_NAME:]data[/TAG_NAME]';
        $expected = [
            'TAG_NAME' => [
                'description' => '',
                'data' => 'data'
            ]
        ];
        $this->assertEquals($expected, Parser::splitWithTags($text));
    }

    public function testEmptyData()
    {
        $text = '[TAG_NAME:description][/TAG_NAME]';
        $expected = [
            'TAG_NAME' => [
                'description' => 'description',
                'data' => ''
            ]
        ];
        $this->assertEquals($expected, Parser::splitWithTags($text));
    }

    public function testNoTags()
    {
        $text = 'No tags here';
        $expected = [];
        $this->assertEquals($expected, Parser::splitWithTags($text));
    }

    public function testSpecialCharacters()
    {
        $text = '[TAG_NAME:desc]data with special characters !@#$%^&*()_+[/TAG_NAME]';
        $expected = [
            'TAG_NAME' => [
                'description' => 'desc',
                'data' => 'data with special characters !@#$%^&*()_+'
            ]
        ];
        $this->assertEquals($expected, Parser::splitWithTags($text));
    }

}
