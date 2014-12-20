<?php

namespace NilPortugues\Sitemap\Item\Video\Validator;

final class TagValidator
{
    /**
     * @var int
     */
    protected static $maxVideoTagTags = 32;

    /**
     * Create a new <video:tag> element for each tag associated with a video. A maximum of 32 tags is permitted.
     *
     * @param $tags
     *
     * @return bool|array
     */
    public static function validate($tags)
    {
        if (count($tags) > self::$maxVideoTagTags || 0 === count($tags)) {
            return false;
        }

        return $tags;
    }
}
