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
     * @param $title
     * @param $contentLoc
     * @param $playerLoc
     * @param $playerEmbedded
     * @param $playerAutoplay
     */
    public function __construct($title, $contentLoc, $playerLoc, $playerEmbedded = null, $playerAutoplay = null)
    {
        $this->validator = VideoItemValidator::getInstance();
        $this->xml       = $this->reset();
        $this->setTitle($title);
        $this->setContentLoc($contentLoc);
        $this->setPlayerLoc($playerLoc, $playerEmbedded, $playerAutoplay);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "\t\t" . '<video:video>',
            'thumbnail_loc'         => '',
            'title'                 => '',
            'description'           => '',
            'content_loc'           => '',
            'player_loc'            => '',
            'duration'              => '',
            'expiration_date'       => '',
            'rating'                => '',
            'view_count'            => '',
            'publication_date'      => '',
            'family_friendly'       => '',
            'restriction'           => '',
            'gallery_loc'           => '',
            'price'                 => '',
            'category'              => '',
            'tag'                   => '',
            'requires_subscription' => '',
            'uploader'              => '',
            'platform'              => '',
            'live'                  => '',
            "\t\t" . '</video:video>',
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
        if (false === $title) {
            throw new VideoItemException(
                sprintf('', $title)
            );
        }
        $this->xml['title'] = "\t\t\t" . '<video:title><![CDATA[' . $title . ']]></video:title>';

        return $this;
    }

    /**
     * @param $loc
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setContentLoc($loc)
    {
        $loc = $this->validator->validateLoc($loc);
        if (false === $loc) {
            throw new VideoItemException(
                sprintf('', $loc)
            );
        }

        $this->xml['content_loc'] = "\t\t\t" . '<video:content_loc><![CDATA[' . $loc . ']]></video:content_loc>';
        return $this;
    }

    /**
     * @param $loc
     *
     * @param $playerEmbedded
     * @param $playerAutoplay
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlayerLoc($loc, $playerEmbedded, $playerAutoplay)
    {
        $loc = $this->validator->validatePlayerLoc($loc);
        if (false === $loc) {
            throw new VideoItemException(
                sprintf('', $loc)
            );
        }
        $this->xml['player_loc'] = '';


        if (!empty($this->data['player_loc']) && !empty($this->data['allow_embed']) && !empty($this->data['autoplay'])) {
            $this->xml[] = "\t\t\t" . '<video:player_loc allow_embed="' . $this->data['allow_embed'] . '" autoplay="' . $this->data['autoplay'] . '">' . $this->data['player_loc'] . '</video:player_loc>';
        } elseif (!empty($this->data['player_loc']) && !empty($this->data['allow_embed'])) {
            $this->xml[] = "\t\t\t" . '<video:player_loc allow_embed="' . $this->data['allow_embed'] . '">' . $this->data['player_loc'] . '</video:player_loc>';
        } elseif (!empty($this->data['player_loc']) && !empty($this->data['autoplay'])) {
            $this->xml[] = "\t\t\t" . '<video:player_loc autoplay="' . $this->data['autoplay'] . '">' . $this->data['player_loc'] . '</video:player_loc>';
        }

        return $this;
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
        . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
        . ' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n";
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
     * @throws VideoItemException
     * @return $this
     */
    public function setThumbnailLoc($loc)
    {
        $loc = $this->validator->validateThumbnailLoc($loc);
        if (false === $loc) {
            throw new VideoItemException(
                sprintf('', $loc)
            );
        }

        $this->xml['thumbnail_loc'] = "\t\t\t" .
            '<video:thumbnail_loc><![CDATA[' . $loc . ']]></video:thumbnail_loc>';

        return $this;
    }

    /**
     * @param $description
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setDescription($description)
    {
        $description = $this->validator->validateDescription($description);
        if (false === $description) {
            throw new VideoItemException(
                sprintf('', $description)
            );
        }

        $this->xml['description'] = "\t\t\t" .
            '<video:description><![CDATA[' . $description . ']]></video:description>';
        return $this;
    }

    /**
     * @param $duration
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setDuration($duration)
    {
        $duration = $this->validator->validateDuration($duration);
        if (false === $duration) {
            throw new VideoItemException(
                sprintf('', $duration)
            );
        }

        $this->xml['duration'] = "\t\t\t" .
            '<video:duration><![CDATA[' . $duration . ']]></video:duration>';

        return $this;
    }

    /**
     * @param $expirationDate
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        $expirationDate = $this->validator->validateExpirationDate($expirationDate);
        if (false === $expirationDate) {
            throw new VideoItemException(
                sprintf('', $expirationDate)
            );
        }

        $this->xml['expiration_date'] = "\t\t\t" .
            '<video:expiration_date><![CDATA[' . $expirationDate . ']]></video:expiration_date>';

        return $this;
    }

    /**
     * @param $rating
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRating($rating)
    {
        $rating = $this->validator->validateRating($rating);
        if (false === $rating) {
            throw new VideoItemException(
                sprintf('', $rating)
            );
        }

        $this->xml['rating'] = "\t\t\t" .
            '<video:rating><![CDATA[' . $rating . ']]></video:rating>';

        return $this;
    }

    /**
     * @param $viewCount
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setViewCount($viewCount)
    {
        $viewCount = $this->validator->validateViewCount($viewCount);
        if (false === $viewCount) {
            throw new VideoItemException(
                sprintf('', $viewCount)
            );
        }

        $this->xml['view_count'] = "\t\t\t" .
            '<video:view_count><![CDATA[' . $viewCount . ']]></video:view_count>';

        return $this;
    }

    /**
     * @param $publicationDate
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setPublicationDate($publicationDate)
    {
        $publicationDate = $this->validator->validatePublicationDate($publicationDate);
        if (false === $publicationDate) {
            throw new VideoItemException(
                sprintf('', $publicationDate)
            );
        }

        $this->xml['publication_date'] = "\t\t\t" .
            '<video:publication_date><![CDATA[' . $publicationDate . ']]></video:publication_date>';
        return $this;
    }

    /**
     * @param $familyFriendly
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setFamilyFriendly($familyFriendly)
    {
        $familyFriendly = $this->validator->validateFamilyFriendly($familyFriendly);
        if (false === $familyFriendly) {
            throw new VideoItemException(
                sprintf('', $familyFriendly)
            );
        }

        $this->xml['family_friendly'] = "\t\t\t" .
            '<video:family_friendly><![CDATA[' . $familyFriendly . ']]></video:family_friendly>';

        return $this;
    }

    /**
     * @param      $restriction
     * @param null $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRestriction($restriction, $relationship = null)
    {
        $restriction = $this->validator->validateRestriction($restriction);
        if (false === $restriction) {
            throw new VideoItemException(
                sprintf('', $restriction)
            );
        }

        $this->xml['restriction'] = "\t\t\t" . '<video:restriction';

        if (null !== $relationship) {
            $this->setRestrictionRelationship($relationship);
        }

        $this->xml['restriction'] .= '>' . $restriction . '</video:restriction>';
        return $this;
    }

    /**
     * @param $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRestrictionRelationship($relationship)
    {
        $relationship = $this->validator->validateRestriction($relationship);
        if (false === $relationship) {
            throw new VideoItemException(
                sprintf('', $relationship)
            );
        }

        $this->xml['restriction'] .= ' relationship="' . $relationship . '">';
        return $this;
    }

    /**
     * @param      $galleryLoc
     * @param null $title
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setGalleryLoc($galleryLoc, $title = null)
    {
        $galleryLoc = $this->validator->validateGalleryLoc($galleryLoc);
        if (false === $galleryLoc) {
            throw new VideoItemException(
                sprintf('', $galleryLoc)
            );
        }
        $this->xml['gallery_loc'] = "\t\t\t" . '<video:gallery_loc';

        if (null !== $title) {
            $this->setGalleryTitle($title);
        }
        $this->xml['gallery_loc'] .= '>' . $galleryLoc . '</video:gallery_loc>';

        return $this;
    }

    /**
     * @param $title
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setGalleryTitle($title)
    {
        $title = $this->validator->validateGalleryLocTitle($title);
        if (false === $title) {
            throw new VideoItemException(
                sprintf('', $title)
            );
        }

        $this->xml['gallery_loc'] .= ' title="' . $title . '"';
        return $this;
    }

    /**
     * @param        $price
     * @param        $currency
     * @param string $type
     * @param string $resolution
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setPrice($price, $currency, $type = null, $resolution = null)
    {
        $this->xml['price'] .= "\t\t\t" . '<video:price';

        $this->setPriceValue($price);
        $this->setPriceCurrency($currency);
        $this->setPriceType($type);
        $this->setPriceResolution($resolution);

        $this->xml['price'] .= '>' . $price . '</video:price>' . "\n";

        return $this;
    }

    /**
     * @param $price
     *
     * @throws VideoItemException
     */
    protected function setPriceValue($price)
    {
        $price = $this->validator->validatePrice($price);
        if (false === $price) {
            throw new VideoItemException(
                sprintf('', $price)
            );
        }
    }

    /**
     * @param       $currency
     *
     * @throws VideoItemException
     */
    protected function setPriceCurrency($currency)
    {
        $currency = $this->validator->validatePrice($currency);
        if (false === $currency) {
            throw new VideoItemException(
                sprintf('', $currency)
            );
        }
        $this->xml['price'] .= ' currency="' . $currency . '"';
    }

    /**
     * @param       string|null $type
     *
     * @throws VideoItemException
     */
    protected function setPriceType($type)
    {
        if (null !== $type) {
            $type = $this->validator->validatePriceType($type);
            if (false === $type) {
                throw new VideoItemException(
                    sprintf('', $type)
                );
            }
            $this->xml['price'] .= ' type="' . $type . '"';
        }
    }

    /**
     * @param       string|null $resolution
     *
     * @throws VideoItemException
     */
    protected function setPriceResolution($resolution)
    {
        if (null !== $resolution) {
            $resolution = $this->validator->validatePriceResolution($resolution);
            if (false === $resolution) {
                throw new VideoItemException(
                    sprintf('', $resolution)
                );
            }
            $this->xml['price'] .= ' resolution="' . $resolution . '"';
        }
    }

    /**
     * @param $category
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setCategory($category)
    {
        $category = $this->validator->validateCategory($category);

        if (false === $category) {
            throw new VideoItemException(
                sprintf('', implode(',', $category))
            );
        }

        $this->xml['category'] = "\t\t\t" . '<video:category><![CDATA[' . $category . ']]></video:category>';

        return $this;
    }

    /**
     * @param array $tag
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setTag(array $tag)
    {
        $tag = $this->validator->validateTag($tag);
        if (false === $tag) {
            throw new VideoItemException(
                sprintf('', implode(',', $tag))
            );
        }


        //Loop tag array
        if (!empty($this->data['tag'])) {
            foreach ($this->data['tag'] as &$tag) {
                $this->xml['tag'] .= "\t\t\t" . '<video:tag>' . $tag . '</video:tag>' . "\n";
            }
        }

        return $this;
    }

    /**
     * @param $requires
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setRequiresSubscription($requires)
    {
        $requires = $this->validator->validateRequiresSubscription($requires);
        if (false === $requires) {
            throw new VideoItemException(
                sprintf('', $requires)
            );
        }

        $this->xml['requires_subscription'] = "\t\t\t" .
            '<video:requires_subscription><![CDATA[' . $requires . ']]></video:requires_subscription>';

        return $this;
    }

    /**
     * @param      $uploader
     * @param null $info
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setUploader($uploader, $info = null)
    {
        $uploader = $this->validator->validateUploader($uploader);
        if (false === $uploader) {
            throw new VideoItemException(
                sprintf('', $uploader)
            );
        }

        $this->xml['uploader'] = "\t\t\t" . '<video:uploader';

        if (null !== $info) {
            $this->setUploaderInfo($info);
        }

        $this->xml['uploader'] .= '>' . $uploader . '</video:uploader>';

        return $this;
    }

    /**
     * @param $info
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setUploaderInfo($info)
    {
        $info = $this->validator->validateUploaderInfo($info);
        if (false === $info) {
            throw new VideoItemException(
                sprintf('', $info)
            );
        }
        $this->xml['uploader'] .= ' info="' . $info;

        return $this;
    }

    /**
     * @param      $platform
     * @param null $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setPlatform($platform, $relationship = null)
    {
        $platform = $this->validator->validatePlatform($platform);
        if (false === $platform) {
            throw new VideoItemException(
                sprintf('', $platform)
            );
        }

        $this->xml['platform'] = "\t\t\t" . '<video:platform';

        if (null !== $relationship) {
            $this->setPlatformRelationship($relationship);
        }

        $this->xml['platform'] .= '>' . $platform . '</video:platform>';
        return $this;
    }

    /**
     * @param $relationship
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlatformRelationship($relationship)
    {
        $relationship = $this->validator->validatePlatformRelationship($relationship);
        if (false === $relationship) {
            throw new VideoItemException(
                sprintf('', $relationship)
            );
        }
        $this->xml['platform'] .= ' relationship="' . $relationship . '"';

        return $this;
    }

    /**
     * @param $live
     *
     * @throws VideoItemException
     * @return $this
     */
    public function setLive($live)
    {
        $live = $this->validator->validateLive($live);
        if (false === $live) {
            throw new VideoItemException(
                sprintf('', $live)
            );
        }
        $this->xml['live'] = "\t\t\t" . '<video:live><![CDATA[' . $live . ']]></video:live>';

        return $this;
    }

    /**
     * @param $embedded
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlayerLocAllowEmbedded($embedded)
    {
        $embedded = $this->validator->validateAllowEmbed($embedded);
        if (false === $embedded) {
            throw new VideoItemException(
                sprintf('', $embedded)
            );
        }
        return $this;
    }

    /**
     * @param $autoPlay
     *
     * @throws VideoItemException
     * @return $this
     */
    protected function setPlayerLocAutoPlay($autoPlay)
    {
        $autoPlay = $this->validator->validateAutoPlay($autoPlay);
        if (false === $autoPlay) {
            throw new VideoItemException(
                sprintf('', $autoPlay)
            );
        }

        return $this;
    }
}
