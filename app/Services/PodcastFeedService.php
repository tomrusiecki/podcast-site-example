<?php
namespace App\Services;

use App\Episode;
use App\Show;
use DOMDocument;
use getID3;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Class PodcastFeedService
 *
 * Service class for generating podcast rss feeds
 *
 * @package App\Services
 */
class PodcastFeedService
{
    /**
     * Returns an XML string for the given show and episodes
     *
     * @param Request $request
     * @param Show $show
     * @param Collection $episodes
     * @return string
     */
    public static function createFeedXml(Request $request, Show $show, Collection $episodes)
    {
        $xml = new DOMDocument();
        $root = $xml->appendChild($xml->createElement('rss'));
        $root->setAttribute('xmlns:itunes', 'http://www.itunes.com/dtds/podcast-1.0.dtd');
        $root->setAttribute('xmlns:media', 'http://search.yahoo.com/mrss/');
        $root->setAttribute('xmlns:feedburner', 'http://rssnamespace.org/feedburner/ext/1.0');
        $root->setAttribute('version', '2.0');

        $link = sprintf(
            '%s://%s/podcast',
            $request->getScheme(),
            $request->getHost()
        );

        $chan = $root->appendChild($xml->createElement('channel'));
        $chan->appendChild($xml->createElement('title', $show->title));
        $chan->appendChild($xml->createElement('link', $link));
        $chan->appendChild($xml->createElement('generator', 'Example Podcast site'));
        $chan->appendChild($xml->createElement('language', 'en'));

        foreach ($episodes as $episode) {
            $audioURL = sprintf(
                '%s://%s/uploads/%s',
                $request->getScheme(),
                $request->getHost(),
                basename($episode->filepath)
            );

            $item = $chan->appendChild($xml->createElement('item'));
            $item->appendChild($xml->createElement('title', $episode->title));
            $item->appendChild($xml->createElement('link', $audioURL));
            $item->appendChild($xml->createElement('itunes:author', $episode->author));
            $item->appendChild($xml->createElement('itunes:subtitle', $episode->subtitle));
            $item->appendChild($xml->createElement('itunes:summary', $episode->summary));
            $item->appendChild($xml->createElement('itunes:episodeType', 'full'));
            $item->appendChild($xml->createElement('itunes:episode', $episode->number));
            $item->appendChild($xml->createElement('guid', $audioURL));

            if ($episode->filepath) {
                $publicPath = public_path($episode->filepath);

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $enclosure = $item->appendChild($xml->createElement('enclosure'));
                $enclosure->setAttribute('url', $audioURL);
                $enclosure->setAttribute('length', filesize($publicPath));
                $enclosure->setAttribute('type', finfo_file($finfo, $publicPath));
            }

            $date = new \DateTimeImmutable($episode->date);
            $item->appendChild($xml->createElement('pubDate', $date->format('D, d M Y H:i:s O')));

            if ($episode->filepath) {
                $getID3 = new getID3();
                $fileinfo = $getID3->analyze($publicPath);
                $item->appendChild($xml->createElement('itunes:duration', $fileinfo['playtime_string']));
            }
        }

        $xml->formatOutput = true;

        return $xml->saveXML();
    }
}