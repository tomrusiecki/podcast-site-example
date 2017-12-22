<?php

use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $show = \App\Show::create([
            'name' => 'Example Podcast',
            'description' => 'This is a new podcast that is generate as an example for create a podcast site and feed!'
        ]);

        $episodes = [
            [
                'date' => '2017-12-21 12:00:02',
                'number' => 3184,
                'title' => 'DTNS 3184 Lost MP3s in the Amazon',
                'subtitle' => '',
                'author' => 'Tom Merritt',
                'summary' => 'Facebook changes its fact-checking program, Amazon ends MP3 storage and Keeper sues Ars Technica. With Sarah Lane, Tom Merritt, Roger Chang and Justin Robert Young.',
                'filepath' => 'podcasts/SampleAudio_0.7mb.mp3'
            ],
            [
                'date' => '2017-12-20 16:15:02',
                'number' => 3183,
                'title' => 'Daily Tech Headlines',
                'subtitle' => 'Headlines for December 20th 2017',
                'summary' => 'Apple admits slowing down old iPhones to protect battery life, Facebook changes fact-checking program and Windows Hello spoofed.',
                'author' => 'Tom Merritt',
                'filepath' => 'podcasts/SampleAudio2.mp3'
            ],
            [
                'date' => '2017-12-19 14:20:02',
                'number' => 3182,
                'title' => 'Daily Tech Headlines',
                'subtitle' => 'Headlines for December 19th 2017',
                'summary' => 'Magic Leap announces it really will ship next year, Apple may be throttling old phones in order to save batteries and we check in on the health of wearables. With Tom Merritt, Sarah Lane, Roger Chang, and Scott Johnson.',
                'author' => 'Tom Merritt',
                'filepath' => 'podcasts/SampleAudio3.mp3'
            ]
        ];

        foreach($episodes as $data) {
            $episode = new \App\Episode($data);
            $episode->show_id = $show->getKey();
            $episode->save();
        }
    }
}
