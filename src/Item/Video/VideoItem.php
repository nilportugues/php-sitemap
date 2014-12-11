<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class VideoItem
 * @package NilPortugues\Sitemap\Items
 */
class VideoItem extends AbstractItem
{
    /**
     * @var VideoItemValidator
     */
    protected $validator;

    /**
     * @param string $title
     * @param string $playerLoc
     * @param string $contentLoc
     */
    public function __construct($title, $playerLoc, $contentLoc)
    {
        $this->validator = VideoItemValidator::getInstance();
        $this->xml = $this->reset();
        $this->setTitle($title);
        $this->setPlayerLoc($playerLoc);
        $this->setContentLoc($contentLoc);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [

        ];
    }

    /**
     * @param $title
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setTitle($title)
    {
        $title = $this->validator->validateTitle($title);
        if(false === $title) {
            throw new VideoItemException(
                sprintf('', $title)
            );
        }
        $this->xml['title'] = '';

        return $this;
    }

    /**
     * @param $loc
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlayerLoc($loc)
    {
        $loc = $this->validator->validatePlayerLoc($loc);
        if(false === $loc) {
            throw new VideoItemException(
                sprintf('', $loc)
            );
        }
        $this->xml['player_loc'] = '';

        return $this;
    }

    /**
     * @param $loc
     *
     * @return $this
     */
    protected function setContentLoc($loc)
    {
        return $this;
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n"
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
        .' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">'."\n";
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @param $loc
     *
     * @return $this
     */
    public function setThumbnailLoc($loc)
    {
        return $this;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        return $this;
    }

    /**
     * @param $embedded
     *
     * @return $this
     */
    public function setPlayerLocAllowEmbedded($embedded)
    {
        return $this;
    }

    /**
     * @param $autoplay
     *
     * @return $this
     */
    public function setPlayerLocAutoplay($autoplay)
    {
        return $this;
    }

    /**
     * @param $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        return $this;
    }

    /**
     * @param $expirationDate
     *
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        return $this;
    }

    /**
     * @param $rating
     *
     * @return $this
     */
    public function setRating($rating)
    {
        return $this;
    }

    /**
     * @param $viewCount
     *
     * @return $this
     */
    public function setViewCount($viewCount)
    {
        return $this;
    }

    /**
     * @param $publicationDate
     *
     * @return $this
     */
    public function setPublicationDate($publicationDate)
    {
        return $this;
    }

    /**
     * @param $familyFriendly
     *
     * @return $this
     */
    public function setFamilyFriendly($familyFriendly)
    {
        return $this;
    }

    /**
     * @param $restriction
     *
     * @return $this
     */
    public function setRestriction($restriction)
    {
        return $this;
    }

    /**
     * @param $relationship
     *
     * @return $this
     */
    public function setRestrictionRelationship($relationship)
    {
        return $this;
    }

    /**
     * @param $galleryLoc
     *
     * @return $this
     */
    public function setGalleryLoc($galleryLoc)
    {
        return $this;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setGalleryTitle($title)
    {
        return $this;
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
        return $this;
    }

    /**
     * @param array $tag
     *
     * @return $this
     */
    public function setTag(array $tag)
    {
        return $this;
    }

    /**
     * @param $requires
     *
     * @return $this
     */
    public function setRequiresSubscription($requires)
    {
        return $this;
    }

    /**
     * @param $uploader
     *
     * @return $this
     */
    public function setUploader($uploader)
    {
        return $this;
    }

    /**
     * @param $info
     *
     * @return $this
     */
    public function setUploaderInfo($info)
    {
        return $this;
    }

    /**
     * @param $platform
     *
     * @return $this
     */
    public function setPlatform($platform)
    {
        return $this;
    }

    /**
     * @param $relationship
     *
     * @return $this
     */
    public function setPlatformRelationship($relationship)
    {
        return $this;
    }

    /**
     * @param $live
     *
     * @return $this
     */
    public function setLive($live)
    {
        return $this;
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {

        $xml[] = "\t\t".'<video:video>';
        $xml['thumbnail_loc'] = "\t\t\t".'<video:thumbnail_loc><![CDATA['.$this->data['thumbnail_loc'].']]></video:thumbnail_loc>';
        $xml['title'] = "\t\t\t".'<video:title><![CDATA['.$this->data['title'].']]></video:title>';
        $xml['description'] = "\t\t\t".'<video:description><![CDATA['.$this->data['description'].']]></video:description>';
        $xml['content_loc'] = "\t\t\t".'<video:content_loc><![CDATA['.$this->data['content_loc'].']]></video:content_loc>';




        if (!empty($this->data['player_loc']) && !empty($this->data['allow_embed']) && !empty($this->data['autoplay'])) {
            $xml[] = "\t\t\t".'<video:player_loc allow_embed="'.$this->data['allow_embed'].'" autoplay="'.$this->data['autoplay'].'">'.$this->data['player_loc'].'</video:player_loc>';
        } elseif (!empty($this->data['player_loc']) && !empty($this->data['allow_embed'])) {
            $xml[] = "\t\t\t".'<video:player_loc allow_embed="'.$this->data['allow_embed'].'">'.$this->data['player_loc'].'</video:player_loc>';
        } elseif (!empty($this->data['player_loc']) && !empty($this->data['autoplay'])) {
            $xml[] = "\t\t\t".'<video:player_loc autoplay="'.$this->data['autoplay'].'">'.$this->data['player_loc'].'</video:player_loc>';
        }

        $xml['duration'] = "\t\t\t".'<video:duration><![CDATA['.$this->data['duration'].']]></video:duration>';
        $xml['expiration_date'] = "\t\t\t".'<video:expiration_date><![CDATA['.$this->data['expiration_date'].']]></video:expiration_date>';
        $xml['rating'] = "\t\t\t".'<video:rating><![CDATA['.$this->data['rating'].']]></video:rating>';
        $xml['view_count'] = "\t\t\t".'<video:view_count><![CDATA['.$this->data['view_count'].']]></video:view_count>';
        $xml['publication_date'] = "\t\t\t".'<video:publication_date><![CDATA['.$this->data['publication_date'].']]></video:publication_date>';


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
                    $xml['price'] .= "\t\t\t".'<video:price currency="'.$price['price_currency'].'" type="'.$price['type'].'" resolution="'.$price['resolution'].'">'.$price['price'].'</video:price>';
                } elseif (!empty($price['price']) && !empty($price['price_currency']) && !empty($price['resolution'])) {
                    $xml['price'] .= "\t\t\t".'<video:price currency="'.$price['price_currency'].'" resolution="'.$price['resolution'].'">'.$price['price'].'</video:price>';
                } elseif (!empty($price['price']) && !empty($price['price_currency']) && !empty($price['type'])) {
                    $xml['price'] .= "\t\t\t".'<video:price currency="'.$price['price_currency'].'" type="'.$price['type'].'">'.$price['price'].'</video:price>';
                } elseif (!empty($price['price']) && !empty($price['price_currency'])) {
                    $xml['price'] .= "\t\t\t".'<video:price currency="'.$price['price_currency'].'">'.$price['price'].'</video:price>';
                }
            }
        }




        $xml['category'] = "\t\t\t".'<video:category><![CDATA['.$this->data['category'].']]></video:category>';




        //Loop tag array
        if (!empty($this->data['tag'])) {
            foreach ($this->data['tag'] as &$tag) {
                $xml['tag'] .= "\t\t\t".'<video:tag>'.$tag.'</video:tag>'."\n";
            }
        }

        $xml['requires_subscription'] = "\t\t\t".'<video:requires_subscription><![CDATA['.$this->data['requires_subscription'].']]></video:requires_subscription>';




        if (!empty($this->data['uploader']) && !empty($this->data['uploader_info'])) {
            $xml['uploader'] = "\t\t\t".'<video:uploader info="'.$this->data['uploader_info'].'">'.$this->data['uploader'].'</video:uploader>';
        } elseif (!empty($this->data['uploader'])) {
            $xml['uploader'] = "\t\t\t".'<video:uploader>'.$this->data['uploader'].'</video:uploader>';
        }



        //platform
        if (!empty($this->data['platform']) && !empty($this->data['platform_relationship'])) {
            $xml['platform'] = "\t\t\t".'<video:platform relationship="'.$this->data['platform_relationship'].'">'.$this->data['platform'].'</video:platform>';
        } elseif (!empty($this->data['platform'])) {
            $xml['platform'] = "\t\t\t".'<video:platform>'.$this->data['platform'].'</video:platform>';
        }



        $xml['live'] = "\t\t\t".'<video:live><![CDATA['.$this->data['live'].']]></video:live>';

        $xml[] = "\t\t".'</video:video>';
    }
}
