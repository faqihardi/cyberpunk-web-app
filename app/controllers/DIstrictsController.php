<?php

class DistrictsController extends Controller
{
    public function index()
    {
        $districts = [
            [
                'title' => 'Watson',
                'bg' => '/img/11.webp',
                'icon' => '/img/111.webp',
                'desc' => 'Once an industrial and corporate hub, Watson is now a district defined by urban decay, diverse communities, and thriving underground markets. From the neon-lit streets of Kabuki to the gritty industrial zones, Watson offers a mix of cultures and conflicts that define Night City\'s working-class struggles.'
            ],
            [
                'title' => 'Westbrook',
                'bg' => '/img/12.webp',
                'icon' => '/img/122.webp',
                'desc' => 'Westbrook is the entertainment and luxury capital of Night City, home to Japantown\'s neon-soaked streets and the opulent corporate district. This is where the wealthy elite live, play, and conduct business.'
            ],
            [
                'title' => 'City Center',
                'bg' => '/img/13.webp',
                'icon' => '/img/133.webp',
                'desc' => 'The heart of Night City\'s corporate power, City Center is dominated by towering skyscrapers and mega-corporation headquarters.'
            ],
            [
                'title' => 'Heywood',
                'bg' => '/img/14.webp',
                'icon' => '/img/144.webp',
                'desc' => 'Heywood is a district of contrasts, where suburban homes stand alongside gang-controlled territories.'
            ],
            [
                'title' => 'Pacifica',
                'bg' => '/img/15.webp',
                'icon' => '/img/155.webp',
                'desc' => 'Abandoned by corporations and left to decay, Pacifica is Night City\'s most dangerous district.'
            ],
            [
                'title' => 'Santo Domingo',
                'bg' => '/img/16.webp',
                'icon' => '/img/166.webp',
                'desc' => 'The industrial powerhouse of Night City, dominated by factories and infrastructure.'
            ],
            [
                'title' => 'Badlands',
                'bg' => '/img/17.webp',
                'icon' => null,
                'desc' => 'Beyond the city limits lies the Badlands, a vast desert wasteland inhabited by nomad clans.'
            ]
        ];

        $this->view('districts/index', compact('districts'));
    }
}
