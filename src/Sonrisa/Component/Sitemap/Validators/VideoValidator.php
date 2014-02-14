<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Validators;

/**
 * Class VideoValidator
 * @package Sonrisa\Component\Sitemap\Validators
 */
class VideoValidator extends AbstractValidator
{
    /**
     * @var int
     */
    protected static $max_video_tag_tags = 32;

    /**
     * @var array
     */
    protected static $iso_3166 = array
    (
        //ISO 3166-1 ALPHA 2
        'AD','AE','AF','AG','AI','AL','AM','AO','AQ','AR','AS','AT','AU','AW','AX','AZ','BA','BB','BD','BE','BF',
        'BG','BH','BI','BJ','BL','BM','BN','BO','BQ','BR','BS','BT','BV','BW','BY','BZ','CA','CC','CD','CF','CG',
        'CH','CI','CK','CL','CM','CN','CO','CR','CU','CV','CW','CX','CY','CZ','DE','DJ','DK','DM','DO','DZ','EC',
        'EE','EG','EH','ER','ES','ET','FI','FJ','FK','FM','FO','FR','GA','GB','GD','GE','GF','GG','GH','GI','GL',
        'GM','GN','GP','GQ','GR','GS','GT','GU','GW','GY','HK','HM','HN','HR','HT','HU','ID','IE','IL','IM','IN',
        'IO','IQ','IR','IS','IT','JE','JM','JO','JP','KE','KG','KH','KI','KM','KN','KP','KR','KW','KY','KZ','LA',
        'LB','LC','LI','LK','LR','LS','LT','LU','LV','LY','MA','MC','MD','ME','MF','MG','MH','MK','ML','MM','MN',
        'MO','MP','MQ','MR','MS','MT','MU','MV','MW','MX','MY','MZ','NA','NC','NE','NF','NG','NI','NL','NO','NP',
        'NR','NU','NZ','OM','PA','PE','PF','PG','PH','PK','PL','PM','PN','PR','PS','PT','PW','PY','QA','RE','RO',
        'RS','RU','RW','SA','SB','SC','SD','SE','SG','SH','SI','SJ','SK','SL','SM','SN','SO','SR','SS','ST','SV',
        'SX','SY','SZ','TC','TD','TF','TG','TH','TJ','TK','TL','TM','TN','TO','TR','TT','TV','TW','TZ','UA','UG',
        'UM','US','UY','UZ','VA','VC','VE','VG','VI','VN','VU','WF','WS','YE','YT','ZA','ZM','ZW',

        //ISO 3166-1 ALPHA 3
        'ABW','AFG','AGO','AIA','ALA','ALB','AND','ARE','ARG','ARM','ASM','ATA','ATF','ATG','AUS','AUT','AZE','BDI',
        'BEL','BEN','BES','BFA','BGD','BGR','BHR','BHS','BIH','BLM','BLR','BLZ','BMU','BOL','BRA','BRB','BRN','BTN',
        'BVT','BWA','CAF','CAN','CCK','CHE','CHL','CHN','CIV','CMR','COD','COG','COK','COL','COM','CPV','CRI','CUB',
        'CUW','CXR','CYM','CYP','CZE','DEU','DJI','DMA','DNK','DOM','DZA','ECU','EGY','ERI','ESH','ESP','EST','ETH',
        'FIN','FJI','FLK','FRA','FRO','FSM','GAB','GBR','GEO','GGY','GHA','GIB','GIN','GLP','GMB','GNB','GNQ','GRC',
        'GRD','GRL','GTM','GUF','GUM','GUY','HKG','HMD','HND','HRV','HTI','HUN','IDN','IMN','IND','IOT','IRL','IRN',
        'IRQ','ISL','ISR','ITA','JAM','JEY','JOR','JPN','KAZ','KEN','KGZ','KHM','KIR','KNA','KOR','KWT','LAO','LBN',
        'LBR','LBY','LCA','LIE','LKA','LSO','LTU','LUX','LVA','MAC','MAF','MAR','MCO','MDA','MDG','MDV','MEX','MHL',
        'MKD','MLI','MLT','MMR','MNE','MNG','MNP','MOZ','MRT','MSR','MTQ','MUS','MWI','MYS','MYT','NAM','NCL','NER',
        'NFK','NGA','NIC','NIU','NLD','NOR','NPL','NRU','NZL','OMN','PAK','PAN','PCN','PER','PHL','PLW','PNG','POL',
        'PRI','PRK','PRT','PRY','PSE','PYF','QAT','REU','ROU','RUS','RWA','SAU','SDN','SEN','SGP','SGS','SHN','SJM',
        'SLB','SLE','SLV','SMR','SOM','SPM','SRB','SSD','STP','SUR','SVK','SVN','SWE','SWZ','SXM','SYC','SYR','TCA',
        'TCD','TGO','THA','TJK','TKL','TKM','TLS','TON','TTO','TUN','TUR','TUV','TWN','TZA','UGA','UKR','UMI','URY',
        'USA','UZB','VAT','VCT','VEN','VGB','VIR','VNM','VUT','WLF','WSM','YEM','ZAF','ZMB','ZWE'
    );

    /**
     * @var array
     */
    protected static $iso_4217 = array
    (
        'AFN','EUR','ALL','DZD','USD','EUR','AOA','XCD','XCD','ARS','AMD','AWG','AUD','EUR','AZN','BSD','BHD','BDT',
        'BBD','BYR','EUR','BZD','XOF','BMD','BTN','INR','BOB','BOV','USD','BAM','BWP','NOK','BRL','USD','BND','BGN',
        'XOF','BIF','KHR','XAF','CAD','CVE','KYD','XAF','XAF','CLF','CLP','CNY','AUD','AUD','COP','COU','KMF','XAF',
        'CDF','NZD','CRC','XOF','HRK','CUC','CUP','ANG','EUR','CZK','DKK','DJF','XCD','DOP','USD','EGP','SVC','USD',
        'XAF','ERN','EUR','ETB','EUR','FKP','DKK','FJD','EUR','EUR','EUR','XPF','EUR','XAF','GMD','GEL','EUR','GHS',
        'GIP','EUR','DKK','XCD','EUR','USD','GTQ','GBP','GNF','XOF','GYD','HTG','USD','AUD','EUR','HNL','HKD','HUF',
        'ISK','INR','IDR','XDR','IRR','IQD','EUR','GBP','ILS','EUR','JMD','JPY','GBP','JOD','KZT','KES','AUD','KPW',
        'KRW','KWD','KGS','LAK','EUR','LBP','LSL','ZAR','LRD','LYD','CHF','LTL','EUR','MOP','MKD','MGA','MWK','MYR',
        'MVR','XOF','EUR','USD','EUR','MRO','MUR','EUR','XUA','MXN','MXV','USD','MDL','EUR','MNT','EUR','XCD','MAD',
        'MZN','MMK','NAD','ZAR','AUD','NPR','EUR','XPF','NZD','NIO','XOF','NGN','NZD','AUD','USD','NOK','OMR','PKR',
        'USD','PAB','USD','PGK','PYG','PEN','PHP','NZD','PLN','EUR','USD','QAR','EUR','RON','RUB','RWF','EUR','SHP',
        'XCD','XCD','EUR','EUR','XCD','WST','EUR','STD','SAR','XOF','RSD','SCR','SLL','SGD','ANG','XSU','EUR','EUR',
        'SBD','SOS','ZAR','SSP','EUR','LKR','SDG','SRD','NOK','SZL','SEK','CHE','CHF','CHW','SYP','TWD','TJS','TZS',
        'THB','USD','XOF','NZD','TOP','TTD','TND','TRY','TMT','USD','AUD','UGX','UAH','AED','GBP','USD','USN','USS',
        'USD','UYI','UYU','UZS','VUV','EUR','VEF','VND','USD','USD','XPF','MAD','YER','ZMW','ZWL','XBA','XBB','XBC',
        'XBD','XTS','XXX','XAU','XPD','XPT','XAG'
    );

    /**
     * @param $loc
     * @return string
     */
    public static function validateThumbnailLoc($loc)
    {
        return self::validateLoc($loc);
    }

    /**
     * @param $title
     * @return string
     */
    public static function validateTitle($title)
    {
        if(mb_strlen($title, 'UTF-8') > 97)
        {
            $title = mb_substr($title, 0, 97, 'UTF-8') . '...';
        }

        return $title;
    }

    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     * @return string
     */
    public function validateDescription($description)
    {
        if(mb_strlen($description, 'UTF-8') > 2048)
        {
            $description = mb_substr($description, 0, 2045, 'UTF-8') . '...';
        }

        return $description;
    }

    /**
     * @param $content_loc
     * @return mixed
     */
    public static function validateContentLoc($content_loc)
    {
        return self::validateLoc($content_loc);
    }

    /**
     * @param $player_loc
     * @return string
     */
    public static function validatePlayerLoc($player_loc)
    {
        return self::validateLoc($player_loc);
    }


    /**
     * The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
     *
     * @param $seconds
     * @return string
     */
    public static function validateDuration($seconds)
    {
        if($seconds <= 28800 && $seconds >= 0)
        {
            return $seconds;
        }
        return '';
    }

    /**
     * @param $expiration_date
     * @return string
     */
    public static function validateExpirationDate($expiration_date)
    {
        return self::validateDate($expiration_date);
    }

    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     * @return string
     */
    public static function validateRating($rating)
    {
        preg_match('/([0-9].[0-9])/', $rating, $matches);

        if (!empty($matches[0]) && ($matches[0]<=0.50) && ($matches[0]>=0.1) )
        {
            return $matches[1];
        }
        return '';
    }

    /**
     * @param $view_count
     * @return string
     */
    public static function validateViewCount($view_count)
    {
        if(is_integer($view_count) && $view_count > 0 )
        {
            return $view_count;
        }
        return '';
    }

    /**
     * @param $publication_date
     * @return string
     */
    public static function validatePublicationDate($publication_date)
    {
        return self::validateDate($publication_date);
    }

    /**
     * @param $family_friendly
     * @return string
     */
    public static function validateFamilyFriendly($family_friendly)
    {
        if(ucfirst(strtolower($family_friendly)) == 'No')
        {
            return 'No';
        }
        return '';
    }

    /**
     * @param $countries
     * @return string
     */
    public static function validateRestriction($countries)
    {
        $valid = array();

        //If data is not passed as an array, do so.
        if(!is_array($countries))
        {
            $countries = explode(' ',$countries);
            $countries = array_filter($countries);
        }

        //Foreach value, check if it is a valid $this->iso_3166 value
        foreach($countries as $country)
        {
            $country = preg_replace('/[^a-z]/i', '', $country);
            $country = strtoupper($country);
            if(in_array($country,self::$iso_3166,true))
            {
                $valid[] = $country;
            }
        }

        return implode(" ",$valid);
    }

    /**
     * @param $restriction_relationship
     * @return string
     */
    public static function validateRestrictionRelationship($restriction_relationship)
    {
        return self::validateAllowDeny($restriction_relationship);
    }

    /**
     * @param $gallery_loc
     * @return string
     */
    public static function validateGalleryLoc($gallery_loc)
    {
        return self::validateLoc($gallery_loc);
    }

    /**
     * @param $title
     * @return string
     */
    public static function validateGalleryLocTitle($title)
    {
        return $title;
    }


    /**
     * @param $requires_subscription
     * @return string
     */
    public static function validateRequiresSubscription($requires_subscription)
    {
        return self::validateYesNo($requires_subscription);
    }

    /**
     * @param $uploader
     * @return mixed
     */
    public static function validateUploader($uploader)
    {
        return $uploader;
    }

    /**
     * @param $uploader_loc
     * @return string
     */
    public static function validateUploaderLoc($uploader_loc)
    {
        return self::validateLoc($uploader_loc);
    }


    /**
     * @param $platform
     * @return string
     */
    public static function validatePlatform($platform)
    {
        switch( strtolower($platform) )
        {
            case 'tv':
                return 'tv';
                break;

            case 'mobile':
                return 'mobile';
                break;

            case 'web':
                return 'web';
                break;
        }
        return '';
    }

    /**
     * @param $platform_access
     * @return string
     */
    public static function validatePlatformAccess($platform_access)
    {
        return self::validateAllowDeny($platform_access);
    }

    /**
     * @param $live
     * @return string
     */
    public static function validateLive($live)
    {
        return self::validateYesNo($live);
    }

    /**
     * Create a new <video:tag> element for each tag associated with a video. A maximum of 32 tags is permitted.
     *
     * @param $tags
     * @return array
     */
    public static function validateTag($tags)
    {
        if(is_array($tags))
        {
            if(count($tags) <= self::$max_video_tag_tags )
            {
                return array_slice($tags, 0, 32);
            }
            return $tags;
        }
        elseif(is_string($tags))
        {
            return array($tags);
        }
        return array();
    }


    /**
     * @param array $prices
     * @return array
     */
    public static function validatePrice(array $prices)
    {
        $valid = array();

        foreach($prices as &$value)
        {
            if(is_array($value))
            {
                if
                (
                    !empty($value['price']) && !empty($value['price_currency']) &&
                    ( filter_var($value['price'], FILTER_VALIDATE_FLOAT) || filter_var($value['price'], FILTER_VALIDATE_INT) ) &&
                    array_search(strtoupper($value['price_currency']),array_unique(self::$iso_4217),true)
                )
                {
                    $value['price_currency'] = strtoupper($value['price_currency']);

                    if(!empty($value['resolution']))
                    {
                        $value['resolution'] = self::validatePriceResolution($value['resolution']);
                    }

                    if(!empty($value['type']))
                    {
                        $value['type'] = self::validatePriceType($value['type']);
                    }

                    $value = array_filter($value);
                    $valid = $value;
                }

            }
        }
        return $valid;
    }

    /**
     * For <video:restriction> and <video:platform>, attribute "relationship" specifies whether the video is restricted or permitted.
     * Allowed values are allow or deny.
     *
     * @param $access
     * @return string
     */
    protected static function validateAllowDeny($access)
    {
        $access = strtolower($access);

        if($access == 'allow')
        {
            return 'allow';
        }

        if($access == 'deny')
        {
            return 'deny';
        }
        return '';
    }

    /**
     * @param $value
     * @return string
     */
    protected static function validateYesNo($value)
    {
        $value = strtolower($value);
        if($value == 'yes')
        {
            return 'yes';
        }

        if($value == 'no')
        {
            return 'no';
        }
        return '';
    }

    /**
     * @param $resolution
     * @return string
     */
    protected static function validatePriceResolution($resolution)
    {
        $resolution = strtoupper($resolution);
        if(strtoupper($resolution) == 'HD')
        {
            return 'HD';
        }

        if(strtoupper($resolution) == 'SD')
        {
            return 'SD';
        }

        return '';
    }

    /**
     * @param $type
     * @return string
     */
    protected static function validatePriceType($type)
    {
        $type = strtolower($type);
        if(strtolower($type) == 'rent')
        {
            return 'rent';
        }

        if(strtolower($type) == 'own')
        {
            return 'own';
        }

        return 'own';
    }
} 