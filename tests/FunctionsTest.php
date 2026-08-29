<?php

/**
 * Unit tests for WordPress functions
 */

require_once dirname(__DIR__) . '/wp-includes/functions-formatting.php';

class FunctionsTest extends PHPUnit\Framework\TestCase
{
    /**
     * Test wptexturize function with basic text
     */
    public function testWptexturizeBasicText()
    {
        $input = 'Hello world';
        $expected = 'Hello world';
        $this->assertEquals($expected, wptexturize($input));
    }

    /**
     * Test wptexturize with dashes
     */
    public function testWptexturizeDashes()
    {
        // Test triple dash
        $input = 'test---dash';
        $result = wptexturize($input);
        $this->assertStringContainsString('&#8212;', $result);

        // Test double dash
        $input = 'test--dash';
        $result = wptexturize($input);
        $this->assertStringContainsString('&#8211;', $result);
    }

    /**
     * Test wptexturize with ellipsis
     */
    public function testWptexturizeEllipsis()
    {
        $input = 'Wait...';
        $result = wptexturize($input);
        $this->assertStringContainsString('&#8230;', $result);
    }

    /**
     * Test wptexturize with quotes
     */
    public function testWptexturizeQuotes()
    {
        // Test opening quote
        $input = '"Hello"';
        $result = wptexturize($input);
        $this->assertStringContainsString('&#8220;', $result);
        $this->assertStringContainsString('&#8221;', $result);
    }

    /**
     * Test clean_pre function
     */
    public function testCleanPre()
    {
        $input = '<p>Test<br />content</p>';
        $expected = "\nTestcontent";
        $this->assertEquals($expected, clean_pre($input));
    }

    /**
     * Test seems_utf8 function with valid UTF-8
     */
    public function testSeemsUtf8Valid()
    {
        $input = 'Hello World';
        $this->assertTrue(seems_utf8($input));
    }

    /**
     * Test wp_specialchars function
     */
    public function testWpSpecialchars()
    {
        $input = '<script>alert("XSS")</script>';
        $result = wp_specialchars($input);
        $this->assertStringContainsString('&lt;', $result);
        $this->assertStringContainsString('&gt;', $result);
    }

    /**
     * Test wp_specialchars with quotes
     */
    public function testWpSpecialcharsWithQuotes()
    {
        $input = 'He said "Hello"';
        $result = wp_specialchars($input, 1);
        $this->assertStringContainsString('&quot;', $result);
    }

    /**
     * Test remove_accents function
     */
    public function testRemoveAccents()
    {
        $input = 'ÀÁÂÃÄÅ';
        $result = remove_accents($input);
        $this->assertStringContainsString('A', $result);
    }

    /**
     * Test sanitize_title_with_dashes function
     */
    public function testSanitizeTitleWithDashes()
    {
        $input = 'Hello World!';
        $result = sanitize_title_with_dashes($input);
        $this->assertEquals('hello-world', $result);
    }

    /**
     * Test utf8_uri_encode function
     */
    public function testUtf8UriEncode()
    {
        $input = 'Hello';
        $result = utf8_uri_encode($input);
        $this->assertEquals('Hello', $result);
    }

    /**
     * Test convert_chars function
     */
    public function testConvertChars()
    {
        $input = 'Test & more';
        $result = convert_chars($input);
        $this->assertStringContainsString('&#038;', $result);
    }

    /**
     * Test wpautop function
     */
    public function testWpautop()
    {
        $input = "Line 1\nLine 2";
        $result = wpautop($input);
        $this->assertStringContainsString('<p>', $result);
        $this->assertStringContainsString('</p>', $result);
    }
}
