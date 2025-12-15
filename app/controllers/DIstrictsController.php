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
                'desc' => 'Once an industrial and corporate hub, Watson is now a bustling district filled with street markets, nightclubs, and gang activity. Home to Maelstrom and Tyger Claws, it’s chaotic, alive, and the starting point of V’s journey.'
            ],
            [
                'title' => 'Westbrook',
                'bg' => '/img/12.webp',
                'icon' => '/img/122.webp',
                'desc' => 'A glamorous district known for entertainment and luxury living. Includes Japantown with its neon-lit streets, Charter Hill for the upper-middle class, and North Oak—home to Night City’s elite residents.'
            ],
            [
                'title' => 'City Center',
                'bg' => '/img/13.webp',
                'icon' => '/img/133.webp',
                'desc' => 'The heart of Night City’s economy and politics. Packed with skyscrapers, corporate headquarters, and decision-making power. Main areas: Corpo Plaza (corporate-heavy) and Downtown (business & finance hub).'
            ],
            [
                'title' => 'Heywood',
                'bg' => '/img/14.webp',
                'icon' => '/img/144.webp',
                'desc' => 'A sprawling urban district with a strong Latino community. A mix of residential areas, street culture, and mid-level crime. The Valentinos gang holds significant influence here.'
            ],
            [
                'title' => 'Pacifica',
                'bg' => '/img/15.webp',
                'icon' => '/img/155.webp',
                'desc' => 'Originally intended as a luxury resort area but left abandoned after investor collapse. Now a lawless, gang-controlled region, dominated by the Voodoo Boys and Animals. Dangerous, isolated, and full of hidden stories.'
            ],
            [
                'title' => 'Santo Domingo',
                'bg' => '/img/16.webp',
                'icon' => '/img/166.webp',
                'desc' => 'One of Night City’s oldest and most industrial districts. Home to factories, power plants, and corporate experiments. Arroyo is an industrial zone, while Rancho Coronado houses working-class families.'
            ],
            [
                'title' => 'Badlands',
                'bg' => '/img/17.webp',
                'icon' => null,
                'desc' => 'The vast desert outside Night City. Filled with Nomad outposts, ruins, hidden facilities, and open roads for convoys or chases. Base of operations for the Aldecaldos and Wraiths.'
            ]
        ];

        $this->view('districts/index', compact('districts'));
    }
}
