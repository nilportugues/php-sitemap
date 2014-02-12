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

    protected $max_video_tag_tags = 32;


    protected $iso_3166 = array
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

    //I need to remove the duplicates
    protected $iso_4217 = array
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
     * @param string $url URL is used to append to the <url> the videoData added by $videoData
     * @param array $videoData
     *
     * @return $this
     */
    public function addVideo($url,array $videoData)
    {
        //Validate all required fields first.
        $url = $this->validateUrlLoc($url);
        $playerLoc = (!empty($videoData['player_loc'])) ? $this->validateUrlLoc($videoData['player_loc']) : '';
        $contentLoc = (!empty($videoData['content_loc'])) ? $this->validateUrlLoc($videoData['content_loc']) : '';
        $thumbnail_loc = (!empty($videoData['player_loc'])) ? $this->validateUrlLoc($videoData['thumbnail_loc']) : '';
        $title = (!empty($videoData['title'])) ? $this->validateTitle($videoData['title']) : '';

        //Validate all remaining data.
        if( (!empty($url) && (!empty($playerLoc) || !empty($contentLoc)) && !empty($thumbnail_loc) && !empty($title)) )
        {
            //Date validation
            $expiration_date = $this->validateVideoDate($videoData['expiration_date']);
            $publication_date = $this->validateVideoDate($videoData['publication_date']);

            $dataSet = array
            (
                'thumbnail_loc'         => $thumbnail_loc,
                'title'                 => $title,
                'description'           => (!empty($videoData['description'])) ? $this->validateDescription($videoData['description']) : '',
                'content_loc'           => $contentLoc,
                'player_loc'            => $playerLoc,
                'duration'              => (!empty($videoData['duration'])) ? $this->validateDuration($videoData['duration']) : '',
                'expiration_date'       => $expiration_date,
                'rating'                => (!empty($videoData['rating'])) ? $this->validateRating($videoData['rating']) : '',
                'view_count'            => (!empty($videoData['view_count']) && filter_var($videoData['view_count'],FILTER_SANITIZE_NUMBER_INT))? $videoData['view_count'] : '',
                'publication_date'      => $publication_date,
                'family_friendly'       => (!empty($videoData['family_friendly']) && ucfirst(strtolower($videoData['family_friendly'])) == 'No')? 'No' : '',
                'restriction'           => (!empty($videoData['restriction'])) ? $this->validateRestriction($videoData['restriction']) : '',
                'restriction_access'    => (!empty($videoData['restriction_access'])) ? $this->validateRestrictionAccess($videoData['restriction_access']) : '',
                'gallery_loc'           => (!empty($videoData['gallery_loc'])) ? $this->validateUrlLoc($videoData['gallery_loc']) : '',
                'requires_subscription' => (!empty($videoData['requires_subscription'])) ? $this->validateYesNo($videoData['requires_subscription']) : '',
                'uploader'              => (!empty($videoData['uploader'])) ? $videoData['uploader'] : '',
                'uploader_loc'          => (!empty($videoData['uploader_loc'])) ? $this->validateUrlLoc($videoData['uploader_loc']) : '',
                'platform'              => (!empty($videoData['platform'])) ? $this->validatePlatform($videoData['platform']) : '',
                'platform_access'       => (!empty($videoData['platform_access'])) ? $this->validateRestrictionAccess($videoData['platform_access']) : '',
                'live'                  => (!empty($videoData['live'])) ? $this->validateYesNo($videoData['live']) : '',
                
                //are arrays
                'tag'                   => (!empty($videoData['tag'])) ? $this->validateTags($videoData['tag']) : array(),
                'price'                 => (!empty($videoData['price'])) ? $this->validatePrices($videoData['price']) : array(),
            );

            $dataSet = array_filter($dataSet);


        }
        return $this;
    }

    protected function validatePrices(array $prices)
    {
        foreach($prices as &$value)
        {
            if(is_array($value))
            {
                $value['price'];
                $value['currency'];
                $value['resolution'];
                $value['type'];

                $value = array_filter($value);
            }
        }
    }

    /**
     * @param $platform
     * @return string
     */
    protected function validatePlatform($platform)
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

            default:
                return '';
                break;
        }
    }

    protected function validateYesNo($value)
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
     * @param $countries
     * @return string
     */
    protected function validateRestriction($countries)
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
            if(in_array($country,$this->iso_3166,true))
            {
                $valid[] = $country;
            }
        }

        return implode(" ",$valid);
    }

    /**
     * For <video:restriction> and <video:platform>, attribute "relationship" specifies whether the video is restricted or permitted.
     * Allowed values are allow or deny.
     *
     * @param $access
     * @return string
     */
    protected function validateRestrictionAccess($access)
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
     * Create a new <video:tag> element for each tag associated with a video. A maximum of 32 tags is permitted.
     *
     * @param $tags
     * @return array
     */
    protected function validateTags($tags)
    {
        if(is_array($tags))
        {
            if(count($tags) <= 32)
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
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     * @return string
     */
    protected function validateRating($rating)
    {
        preg_match('/([0-9].[0-9])/', $rating, $matches);

        if (!empty($matches[0]) && ($matches[0]<=0.50) && ($matches[0]>=0.1) )
        {
            return $matches[1];
        }
        return '';
    }

    /**
     * The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
     *
     * @param $seconds
     * @return string
     */
    protected function validateDuration($seconds)
    {
        if($seconds <= 28800 && $seconds >= 0)
        {
            return $seconds;
        }
        return '';
    }

    /**
     * @param $title
     * @return string
     */
    protected function validateTitle($title)
    {
        if(mb_strlen($title, 'UTF-8') > 97)
        {
            $title = mb_substr($title, 0, 97, 'UTF-8') . '...';
        }

        return $title;
    }

    /**
     * @param $date
     * @return string
     */
    protected function validateVideoDate($date)
    {
        $value = $this->validateDate($date,'Y-m-d');
        if( empty($value) )
        {
            $value = $this->validateDate($date,'c');
        }
        return $value;
    }

    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     * @return string
     */
    protected function validateDescription($description)
    {
        if(mb_strlen($description, 'UTF-8') > 2048)
        {
            $description = mb_substr($description, 0, 2045, 'UTF-8') . '...';
        }

        return $description;
    }

} 