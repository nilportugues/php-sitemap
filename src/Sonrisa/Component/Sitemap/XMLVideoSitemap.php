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
     * @return mixed
     */
    public function build()
    {
        $files = array();
        $xmlImages='';
        $generatedFiles = $this->buildUrlSetCollection();

        if(!empty($this->data['videos']))
        {
            $xmlImages.=' xmlns:image="http://www.google.com/schemas/sitemap-video/1.1"';
        }

        if (!empty($generatedFiles)) {
            foreach ($generatedFiles as $fileNumber => $urlSet) {
                $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'.$xmlImages.'>'."\n".
                        $urlSet."\n".
                        '</urlset>';

                $files[$fileNumber] = $xml;
            }
        }
        else
        {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'.$xmlImages.'>'."\n".
                    '</urlset>';

            $files[0] = $xml;
        }

        //Save files array and empty url buffer
        $this->files = $files;

        return $this;
    }

    /**
     * Loop through $this->data['url'] and build Sitemap.xml
     * taking into account each urlset can hold a max of 50.000 url elements
     *
     * @return array
     */
    protected function buildUrlSetCollection()
    {
        $files = array(0 => '');

        if (!empty($this->data['url'])) {
            $i = 0;
            $url = 0;
            foreach ($this->data['url'] as $prioritySets) {
                foreach ($prioritySets as $urlData) {
                    $xml = array();

                    //Open <url>
                    $xml[] = "\t".'<url>';
                    $xml[] = (!empty($urlData['loc']))?         "\t\t<loc>{$urlData['loc']}</loc>"                      : '';

                    //Append images if any
                    $xml[] = $this->buildUrlVideoCollection($urlData['loc']);

                    //Close <url>
                    $xml[] = "\t".'</url>';

                    //Remove empty fields
                    $xml = array_filter($xml);

                    //Build string
                    $files[$i][] = implode("\n",$xml);

                    //If amount of $url added is above the limit, increment the file counter.
                    if ($url > $this->max_items_per_sitemap) {
                        $files[$i] = implode("\n",$files[$i]);
                        $i++;
                        $url=0;
                    }
                    $url++;
                }
                $files[$i] = implode("\n",$files[$i]);
            }

            return $files;
        }

        return '';

    }

    /**
     * Builds the XML for the video data.
     * @param $url
     * @return string
     */
    protected function buildUrlVideoCollection($url)
    {
        if(!empty( $this->data['videos'][$url]))
        {
            $videos = array();

            foreach( $this->data['videos'][$url] as $videosData )
            {
                $xml = array();

                $xml[] = "\t\t".'<video:video>';

               // $xml[] = (!empty($videosData['loc']))         ? "\t\t\t".'<image:loc><![CDATA['.$videosData['loc'].']]></image:loc>' : '';


                $xml[] = "\t\t".'</video:video>';

                //Remove empty fields
                $xml = array_filter($xml);

                //Build string
                $videos[] = implode("\n",$xml);
            }
            return implode("\n",$videos);
        }
        return '';
    }

    /**
     * @param string $url URL is used to append to the <url> the videoData added by $videoData
     * @param array $videoData
     *
     * @return $this
     */
    public function add($url,array $videoData)
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
            $this->recordUrls[] = $url;

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

            if(empty($this->data['videos'][$url]))
            {
                $this->data['videos'][$url] = array();
            }
            
            // Check if there are less than 1001 videos for this url
            if(count($this->data['videos'][$url]) <= $this->max_images_per_url)
            {
                //Let the data array know that for a URL there are videos
                $this->data['videos'][$url][] = $dataSet;
            }

        }
        return $this;
    }





} 