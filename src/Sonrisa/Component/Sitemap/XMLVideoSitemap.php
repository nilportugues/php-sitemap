<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

class XMLVideoSitemap extends XMLSitemap
{
    /**
     * @var array
     */
    protected $data = array
    (
        'videos' => array(),
        'url'   => array(),
    );

    /**
     * @param string $url URL is used to append to the <url> the videoData added by $videoData
     * @param array $videoData
     *
     * @return $this
     */
    public function addVideo($url,array $videoData)
    {
        //Make sure the mandatory values are valid.
        $url = $this->validateUrlLoc($url);

        if(!empty($videoData['player_loc']) && !empty($videoData['content_loc']))
        {
            $playerLoc = $this->validateUrlLoc($videoData['player_loc']);
            $contentLoc = $this->validateUrlLoc($videoData['content_loc']);

            if ( !empty($url) && !empty($playerLoc) && !empty($contentLoc) )
            {
                $dataSet = array
                (

                );

                $dataSet = array_filter($dataSet);
            }
        }
        return $this;
    }
} 