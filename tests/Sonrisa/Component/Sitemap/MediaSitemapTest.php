<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class MediaSitemapTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->sitemap = new \Sonrisa\Component\Sitemap\MediaSitemap();
    }


    public function testValidMediaSitemapWillAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">
<channel>
\t<title>Media RSS de ejemplo</title>
\t<link>http://www.example.com/ejemplos/mrss/</link>
\t<description>Ejemplo de MRSS</description>
\t<item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">
\t\t<link>http://www.example.com/examples/mrss/example.html</link>
\t\t<media:content type="video/x-flv" duration="120">
\t\t\t<media:player url="http://www.example.com/shows/example/video.swf?flash_params" />
\t\t\t<media:title>Barbacoas en verano</media:title>
\t\t\t<media:description>Consigue que los filetes queden perfectamente hechos siempre</media:description>
\t\t\t<media:thumbnail url="http://www.example.com/examples/mrss/example.png" height="120" width="160"/>
\t\t</media:content>
\t</item>
</channel>
</rss>
XML;
        $this->sitemap->setTitle('Media RSS de ejemplo');
        $this->sitemap->setLink('http://www.example.com/ejemplos/mrss/');
        $this->sitemap->setDescription('Ejemplo de MRSS');
        $this->sitemap->addItem('http://www.example.com/examples/mrss/example.html',array
        (
            'mimetype'      =>  'video/x-flv',
            'player'        =>  'http://www.example.com/shows/example/video.swf?flash_params',
            'duration'      =>  120,
            'title'         =>  'Barbacoas en verano',
            'description'   =>  'Consigue que los filetes queden perfectamente hechos siempre',
            'thumbnail'     =>  'http://www.example.com/examples/mrss/example.png',
            'height'        =>  120,
            'width'         =>  160,
        ));


        $files = $this->sitemap->build()->get();
        $this->assertEquals($expected,$files[0]);
    }
}
