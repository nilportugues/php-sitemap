<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item\Video;

/**
 * Class VideoItem
 * @package NilPortugues\Sitemap\Items
 */
class VideoItem extends AbstractItem
{
    /**
     * @var
     */
    protected $validator;

    /**
     * @param string $title
     * @param string $playerLoc
     * @param string $contentLoc
     */
    public function __construct($title, $playerLoc, $contentLoc)
    {
        $this->validator = VideoValidator::getInstance();

        $this->setTitle($title);
        $this->setPlayerLoc($playerLoc);
        $this->setContentLoc($contentLoc);
    }

    /**
     * @param $title
     *
     * @return $this
     */
    protected function setTitle($title)
    {
        return $this->setField('title', $title);
    }

    /**
     * @param $loc
     *
     * @return $this
     */
    protected function setPlayerLoc($loc)
    {
        return $this->setField('player_loc', $loc);
    }

    /**
     * @param $loc
     *
     * @return $this
     */
    protected function setContentLoc($loc)
    {
        return $this->setField('content_loc', $loc);
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">';
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return (!empty($this->data['title'])) ? $this->data['title'] : '';
    }

    /**
     * @return string
     */
    public function getPlayerLoc()
    {
        return (!empty($this->data['player_loc'])) ? $this->data['player_loc'] : '';
    }

    /**
     * @return string
     */
    public function getContentLoc()
    {
        return (!empty($this->data['content_loc'])) ? $this->data['content_loc'] : '';
    }

    /**
     * @param $loc
     *
     * @return $this
     */
    public function setThumbnailLoc($loc)
    {
        return $this->setField('thumbnail_loc', $loc);
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setField('description', $description);
    }

    /**
     * @param $embedded
     *
     * @return $this
     */
    public function setPlayerLocAllowEmbedded($embedded)
    {
        return $this->setField('allow_embed', $embedded);
    }

    /**
     * @param $autoplay
     *
     * @return $this
     */
    public function setPlayerLocAutoplay($autoplay)
    {
        return $this->setField('autoplay', $autoplay);
    }

    /**
     * @param $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        return $this->setField('duration', $duration);
    }

    /**
     * @param $expirationDate
     *
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        return $this->setField('expiration_date', $expirationDate);
    }

    /**
     * @param $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        return $this->setField('rating', $rating);
    }

    /**
     * @param $viewCount
     *
     * @return $this
     */
    public function setViewCount($viewCount)
    {
        return $this->setField('view_count', $viewCount);
    }

    /**
     * @param $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate($publicationDate)
    {
        return $this->setField('publication_date', $publicationDate);
    }

    /**
     * @param $familyFriendly
     *
     * @return $this
     */
    public function setFamilyFriendly($familyFriendly)
    {
        return $this->setField('family_friendly', $familyFriendly);
    }

    /**
     * @param $restriction
     *
     * @return $this
     */
    public function setRestriction($restriction)
    {
        return $this->setField('restriction', $restriction);
    }

    /**
     * @param $relationship
     *
     * @return $this
     */
    public function setRestrictionRelationship($relationship)
    {
        return $this->setField('restriction_relationship', $relationship);
    }

    /**
     * @param $galleryLoc
     *
     * @return $this
     */
    public function setGalleryLoc($galleryLoc)
    {
        return $this->setField('gallery_loc', $galleryLoc);
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setGalleryTitle($title)
    {
        return $this->setField('gallery_loc_title', $title);
    }

    /**
     * @param        $price
     * @param        $currency
     * @param string $type
     * @param string $resolution
     *
     * @return $this
     */
    public function setPrice($price, $currency, $type = '', $resolution = '')
    {
        $data = array(
            'price' => $price,
            'price_currency' => $currency,
            'type' => $type,
            'resolution' => $resolution,
        );
        $data = array_filter($data);
        $data = $this->validator->validatePrice($data);

        if (!empty($data)) {
            $this->data['price'][] = $data;
        }

        return $this;
    }

    /**
     * @param $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        return $this->setField('category', $category);
    }

    /**
     * @param array $tag
     *
     * @return $this
     */
    public function setTag(array $tag)
    {
        return $this->setField('tag', $tag);
    }

    /**
     * @param $requires
     *
     * @return $this
     */
    public function setRequiresSubscription($requires)
    {
        return $this->setField('requires_subscription', $requires);
    }

    /**
     * @param $uploader
     *
     * @return $this
     */
    public function setUploader($uploader)
    {
        return $this->setField('uploader', $uploader);
    }

    /**
     * @param $info
     *
     * @return $this
     */
    public function setUploaderInfo($info)
    {
        return $this->setField('uploader_info', $info);
    }

    /**
     * @param $platform
     *
     * @return $this
     */
    public function setPlatform($platform)
    {
        return $this->setField('platform', $platform);
    }

    /**
     * @param $relationship
     *
     * @return $this
     */
    public function setPlatformRelationship($relationship)
    {
        return $this->setField('platform_relationship', $relationship);
    }

    /**
     * @param $live
     *
     * @return $this
     */
    public function setLive($live)
    {
        return $this->setField('live', $live);
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     * @throws \NilPortugues\Sitemap\Exceptions\SitemapException
     */
    public function build()
    {
        $xml = array();

        $xml[] = "\t\t".'<video:video>';
        $xml[] = (!empty($this->data['thumbnail_loc'])) ? "\t\t\t".'<video:thumbnail_loc><![CDATA['.$this->data['thumbnail_loc'].']]></video:thumbnail_loc>' : '';
        $xml[] = (!empty($this->data['title'])) ? "\t\t\t".'<video:title><![CDATA['.$this->data['title'].']]></video:title>' : '';
        $xml[] = (!empty($this->data['description'])) ? "\t\t\t".'<video:description><![CDATA['.$this->data['description'].']]></video:description>' : '';
        $xml[] = (!empty($this->data['content_loc'])) ? "\t\t\t".'<video:content_loc><![CDATA['.$this->data['content_loc'].']]></video:content_loc>' : '';

        if (!empty($this->data['player_loc']) && !empty($this->data['allow_embed']) && !empty($this->data['autoplay'])) {
            $xml[] = "\t\t\t".'<video:player_loc allow_embed="'.$this->data['allow_embed'].'" autoplay="'.$this->data['autoplay'].'">'.$this->data['player_loc'].'</video:player_loc>';
        } elseif (!empty($this->data['player_loc']) && !empty($this->data['allow_embed'])) {
            $xml[] = "\t\t\t".'<video:player_loc allow_embed="'.$this->data['allow_embed'].'">'.$this->data['player_loc'].'</video:player_loc>';
        } elseif (!empty($this->data['player_loc']) && !empty($this->data['autoplay'])) {
            $xml[] = "\t\t\t".'<video:player_loc autoplay="'.$this->data['autoplay'].'">'.$this->data['player_loc'].'</video:player_loc>';
        }

        $xml[] = (!empty($this->data['duration'])) ? "\t\t\t".'<video:duration><![CDATA['.$this->data['duration'].']]></video:duration>' : '';
        $xml[] = (!empty($this->data['expiration_date'])) ? "\t\t\t".'<video:expiration_date><![CDATA['.$this->data['expiration_date'].']]></video:expiration_date>' : '';
        $xml[] = (!empty($this->data['rating'])) ? "\t\t\t".'<video:rating><![CDATA['.$this->data['rating'].']]></video:rating>' : '';
        $xml[] = (!empty($this->data['view_count'])) ? "\t\t\t".'<video:view_count><![CDATA['.$this->data['view_count'].']]></video:view_count>' : '';

        $xml[] = (!empty($this->data['publication_date'])) ? "\t\t\t".'<video:publication_date><![CDATA['.$this->data['publication_date'].']]></video:publication_date>' : '';

        if (!empty($this->data['family_friendly']) && $this->data['family_friendly'] == 'No') {
            $xml[] = "\t\t\t".'<video:family_friendly><![CDATA['.$this->data['family_friendly'].']]></video:family_friendly>';
        }

        if (!empty($this->data['restriction']) && !empty($this->data['restriction_relationship'])) {
            $xml[] = "\t\t\t".'<video:restriction relationship="'.$this->data['restriction_relationship'].'">'.$this->data['restriction'].'</video:restriction>';
        } elseif (!empty($this->data['restriction'])) {
            $xml[] = "\t\t\t".'<video:restriction>'.$this->data['restriction'].'</video:restriction>';
        }

        if (!empty($this->data['gallery_loc']) && !empty($this->data['gallery_loc_title'])) {
            $xml[] = "\t\t\t".'<video:gallery_loc title="'.$this->data['gallery_loc_title'].'">'.$this->data['gallery_loc'].'</video:gallery_loc>';
        } elseif (!empty($this->data['gallery_loc'])) {
            $xml[] = "\t\t\t".'<video:gallery_loc>'.$this->data['gallery_loc'].'</video:gallery_loc>';
        }

        if (!empty($this->data['price'])) {
            //Loop price array
            foreach ($this->data['price'] as &$price) {
                if (!empty($price['price']) && !empty($price['price_currency']) && !empty($price['type']) && !empty($price['resolution'])) {
                    $xml[] = "\t\t\t".'<video:price currency="'.$price['price_currency'].'" type="'.$price['type'].'" resolution="'.$price['resolution'].'">'.$price['price'].'</video:price>';
                } elseif (!empty($price['price']) && !empty($price['price_currency']) && !empty($price['resolution'])) {
                    $xml[] = "\t\t\t".'<video:price currency="'.$price['price_currency'].'" resolution="'.$price['resolution'].'">'.$price['price'].'</video:price>';
                } elseif (!empty($price['price']) && !empty($price['price_currency']) && !empty($price['type'])) {
                    $xml[] = "\t\t\t".'<video:price currency="'.$price['price_currency'].'" type="'.$price['type'].'">'.$price['price'].'</video:price>';
                } elseif (!empty($price['price']) && !empty($price['price_currency'])) {
                    $xml[] = "\t\t\t".'<video:price currency="'.$price['price_currency'].'">'.$price['price'].'</video:price>';
                }
            }
        }

        $xml[] = (!empty($this->data['category'])) ? "\t\t\t".'<video:category><![CDATA['.$this->data['category'].']]></video:category>' : '';

        //Loop tag array
        if (!empty($this->data['tag'])) {
            foreach ($this->data['tag'] as &$tag) {
                $xml[] = "\t\t\t".'<video:tag>'.$tag.'</video:tag>';
            }
        }

        $xml[] = (!empty($this->data['requires_subscription'])) ? "\t\t\t".'<video:requires_subscription><![CDATA['.$this->data['requires_subscription'].']]></video:requires_subscription>' : '';

        if (!empty($this->data['uploader']) && !empty($this->data['uploader_info'])) {
            $xml[] = "\t\t\t".'<video:uploader info="'.$this->data['uploader_info'].'">'.$this->data['uploader'].'</video:uploader>';
        } elseif (!empty($this->data['uploader'])) {
            $xml[] = "\t\t\t".'<video:uploader>'.$this->data['uploader'].'</video:uploader>';
        }

        //platform
        if (!empty($this->data['platform']) && !empty($this->data['platform_relationship'])) {
            $xml[] = "\t\t\t".'<video:platform relationship="'.$this->data['platform_relationship'].'">'.$this->data['platform'].'</video:platform>';
        } elseif (!empty($this->data['platform'])) {
            $xml[] = "\t\t\t".'<video:platform>'.$this->data['platform'].'</video:platform>';
        }

        $xml[] = (!empty($this->data['live'])) ? "\t\t\t".'<video:live><![CDATA['.$this->data['live'].']]></video:live>' : '';

        $xml[] = "\t\t".'</video:video>';

        //Clean up and return
        $xml = array_filter($xml);
        $data = implode("\n", $xml);

        return $data;
    }
}
