<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/10/14
 * Time: 1:59 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\ValidatorTrait;
use NilPortugues\Sitemap\Item\Video\Validator\PriceCurrencyValidator;
use NilPortugues\Sitemap\Item\Video\Validator\RestrictionValidator;
use NilPortugues\Sitemap\Item\Video\Validator\TagValidator;

/**
 * Class VideoItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class VideoItemValidator
{
    use ValidatorTrait;

    /**
     * @param $value
     *
     * @return string|false
     */
    public function validateAllowEmbed($value)
    {
        return $this->validateYesNo($value);
    }

    /**
     * @param $value
     *
     * @return string|false
     */
    protected function validateYesNo($value)
    {
        switch (strtolower($value)) {
            case 'yes':
                return 'yes';

            case 'no':
                return 'no';

        }

        return false;
    }

    /**
     * @param $string
     *
     * @return string|false
     */
    public function validateAutoPlay($string)
    {
        return $this->validateString($string);
    }

    /**
     * @param $loc
     *
     * @return string|false
     */
    public function validateThumbnailLoc($loc)
    {
        return $this->validateLoc($loc);
    }

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateTitle($title)
    {
        if (is_string($title) && strlen($title)>0 && strlen($title) < 97) {
            return $title;
        }

        return false;
    }

    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     *
     * @return string|false
     */
    public function validateDescription($description)
    {
        if (mb_strlen($description, 'UTF-8') > 2048) {
            return mb_substr($description, 0, 2045, 'UTF-8').'...';
        }

        return false;
    }

    /**
     * @param $contentLoc
     *
     * @return string|false
     */
    public function validateContentLoc($contentLoc)
    {
        return $this->validateLoc($contentLoc);
    }

    /**
     * @param $playerLoc
     *
     * @return string|false
     */
    public function validatePlayerLoc($playerLoc)
    {
        return $this->validateLoc($playerLoc);
    }

    /**
     * The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
     *
     * @param $seconds
     *
     * @return bool|string
     */
    public function validateDuration($seconds)
    {
        if ($seconds <= 28800 && $seconds >= 0) {
            return $seconds;
        }

        return false;
    }

    /**
     * @param $expirationDate
     *
     * @return string|false
     */
    public function validateExpirationDate($expirationDate)
    {
        return $this->validateDate($expirationDate);
    }

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     *
     * @return string|false
     */
    public function validateRating($rating)
    {
        if (is_numeric($rating) && $rating > -0.01 && $rating < 5.01) {
            preg_match('/([0-9].[0-9])/', $rating, $matches);
            $matches[0] = floatval($matches[0]);

            if (!empty($matches[0]) && $matches[0] <= 5.0 && $matches[0] >= 0.0) {
                return $matches[0];
            }
        }

        return false;
    }

    /**
     * @param $viewCount
     *
     * @return bool|string
     */
    public function validateViewCount($viewCount)
    {
        if (is_integer($viewCount) && $viewCount > 0) {
            return $viewCount;
        }

        return false;
    }

    /**
     * @param $publicationDate
     *
     * @return string|false
     */
    public function validatePublicationDate($publicationDate)
    {
        return $this->validateDate($publicationDate);
    }

    /**
     * @param $familyFriendly
     *
     * @return string|false
     */
    public function validateFamilyFriendly($familyFriendly)
    {
        if (strtolower($familyFriendly) == 'no') {
            return 'No';
        } elseif (strtolower($familyFriendly) == 'yes') {
            return 'Yes';
        }

        return false;
    }

    /**
     * @param $countries
     *
     * @return string|false
     */
    public function validateRestriction($countries)
    {
        return RestrictionValidator::validate($countries);
    }

    /**
     * @param $restrictionRelationship
     *
     * @return string|false
     */
    public function validateRestrictionRelationship($restrictionRelationship)
    {
        return $this->validateAllowDeny($restrictionRelationship);
    }

    /**
     * For <video:restriction> and <video:platform>, attribute "relationship"
     * specifies whether the video is restricted or permitted. Allowed values are allow or deny.
     *
     * @param $access
     *
     * @return string|false
     */
    protected function validateAllowDeny($access)
    {
        switch (strtolower($access)) {
            case 'allow':
                return 'allow';

            case 'deny':
                return 'deny';

        }

        return false;
    }

    /**
     * @param $galleryLoc
     *
     * @return string|false
     */
    public function validateGalleryLoc($galleryLoc)
    {
        return $this->validateLoc($galleryLoc);
    }

    /**
     * @param $category
     *
     * @return string|false
     */
    public function validateCategory($category)
    {
        return $this->validateString($category);
    }

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateGalleryLocTitle($title)
    {
        return $this->validateString($title);
    }

    /**
     * @param $requiresSubscription
     *
     * @return string|false
     */
    public function validateRequiresSubscription($requiresSubscription)
    {
        return $this->validateYesNo($requiresSubscription);
    }

    /**
     * @param $uploader
     *
     * @return string|false
     */
    public function validateUploader($uploader)
    {
        return $this->validateString($uploader);
    }

    /**
     * @param $uploaderLoc
     *
     * @return string|false
     */
    public function validateUploaderInfo($uploaderLoc)
    {
        return $this->validateLoc($uploaderLoc);
    }

    /**
     * @param $platform
     *
     * @return string|false
     */
    public function validatePlatform($platform)
    {
        $platforms = explode(" ", $platform);
        array_filter($platforms);

        foreach ($platforms as $key => $platform) {
            if (strtolower($platform) != 'tv' && strtolower($platform) != 'mobile' && strtolower($platform) != 'web') {
                unset($platforms[$key]);
            }
        }

        $data = implode(' ', $platforms);

        return (strlen($data) > 0) ? $data : false;
    }

    /**
     * @param $platform_access
     *
     * @return string|false
     */
    public function validatePlatformRelationship($platform_access)
    {
        return $this->validateAllowDeny($platform_access);
    }

    /**
     * @param $live
     *
     * @return string|false
     */
    public function validateLive($live)
    {
        return $this->validateYesNo($live);
    }

    /**
     * Create a new <video:tag> element for each tag associated with a video. A maximum of 32 tags is permitted.
     *
     * @param $tags
     *
     * @return bool|array
     */
    public function validateTag($tags)
    {
        return TagValidator::validate($tags);
    }

    /**
     * @param $price
     *
     * @return bool
     */
    public function validatePrice($price)
    {
        if (filter_var($price, FILTER_VALIDATE_FLOAT) || filter_var($price, FILTER_VALIDATE_INT)) {
            return $price;
        }

        return false;
    }

    /**
     * @param $currency
     *
     * @return bool
     */
    public function validatePriceCurrency($currency)
    {
        return PriceCurrencyValidator::validate($currency);
    }

    /**
     * @param string $resolution
     *
     * @return string|false
     */
    public function validatePriceResolution($resolution)
    {
        switch (strtoupper($resolution)) {
            case 'HD':
                return 'HD';

            case 'SD':
                return 'SD';

        }

        return false;
    }

    /**
     * @param string $type
     *
     * @return string|false
     */
    public function validatePriceType($type)
    {
        switch (strtolower($type)) {
            case 'own':
                return 'own';

            case 'rent':
                return 'rent';

        }

        return false;
    }
}
