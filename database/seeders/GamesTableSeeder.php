<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'game_name' => 'Catan (Osadnicy z Catanu)',
                'game_desc' => 'Gracze rywalizują o zasoby, handlując i budując osady.',
                'game_players_num' => '3-4',
                'game_players_age' => '10+',
                'game_producer' => 'Catan Studio',
                'game_image' => 'Catan.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Carcassonne',
                'game_desc' => 'Gracze tworzą krajobraz, ustawiając kafelki z miastami i polami.',
                'game_players_num' => '2-5',
                'game_players_age' => '7+',
                'game_producer' => 'Hans im Glück',
                'game_image' => 'carcassonne.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Ticket to Ride',
                'game_desc' => 'Gracze zbierają karty i budują trasę kolejową, łącząc miasta na mapie.',
                'game_players_num' => '2-5',
                'game_players_age' => '8+',
                'game_producer' => 'Days of Wonder',
                'game_image' => 'ticket-to-ride.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Pandemic',
                'game_desc' => 'Współpracujesz z innymi graczami, aby powstrzymać globalną pandemię, odkrywając lekarstwa i zapobiegając rozprzestrzenianiu się choroby.',
                'game_players_num' => '2-4',
                'game_players_age' => '8+',
                'game_producer' => 'Z-Man Games',
                'game_image' => 'pandemic.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Dixit',
                'game_desc' => 'Gracze opisują ilustrowane karty, aby inni mogli je odgadnąć, jednocześnie unikając zbyt oczywistych podpowiedzi.',
                'game_players_num' => '3-6',
                'game_players_age' => '8+',
                'game_producer' => 'Libellud',
                'game_image' => 'dixit.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Codenames',
                'game_desc' => 'Drużyny muszą odgadnąć tajne hasła, korzystając z podpowiedzi w postaci jednego słowa i liczby.',
                'game_players_num' => '2-8+',
                'game_players_age' => '14+',
                'game_producer' => 'Czech Games Edition',
                'game_image' => 'codenames.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Splendor',
                'game_desc' => 'Gracze rywalizują o zdobycie i handlowanie klejnotami, aby zbudować najpotężniejsze imperium.',
                'game_players_num' => '2-4',
                'game_players_age' => '10+',
                'game_producer' => 'Space Cowboys',
                'game_image' => 'splendor.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Dominion',
                'game_desc' => 'Gracze budują swoje własne talie kart, rozbudowując swoje królestwo i zdobywając punkty.',
                'game_players_num' => '2-4',
                'game_players_age' => '13+',
                'game_producer' => 'Rio Grande Games',
                'game_image' => 'dominion.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => '7 Cudów Świata',
                'game_desc' => 'Gracze wcielają się w przywódców starożytnych cywilizacji i budują cudowne budowle, aby zdobyć punkty zwycięstwa.',
                'game_players_num' => '2-7',
                'game_players_age' => '10+',
                'game_producer' => 'Repos Production',
                'game_image' => '7-Cudow-Swiata.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Azul',
                'game_desc' => 'Gracze rywalizują o zdobycie i układanie kafelków na planszy, tworząc najpiękniejsze wzory ceramiczne.',
                'game_players_num' => '2-4',
                'game_players_age' => '8+',
                'game_producer' => 'Next Move Games',
                'game_image' => 'Azul.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Sagrada',
                'game_desc' => 'Gracze są witrażystami, którzy tworzą piękne witraże, układając kolorowe kafelki w odpowiednich wzorach.',
                'game_players_num' => '1-4',
                'game_players_age' => '14+',
                'game_producer' => 'Floodgate Games',
                'game_image' => 'Sagrada.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Scythe',
                'game_desc' => 'Gracze rywalizują o kontrolę nad alternatywną Europą, rozwijając technologię i prowadząc działania militarne.',
                'game_players_num' => '1-5',
                'game_players_age' => '14+',
                'game_producer' => 'Stonemaier Games',
                'game_image' => 'Scythe.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Dead of Winter',
                'game_desc' => 'Gracze muszą przeżyć apokalipsę zombie, pracując razem, ale jednocześnie mając swoje własne tajne cele.',
                'game_players_num' => '2-5',
                'game_players_age' => '14+',
                'game_producer' => 'Plaid Hat Games',
                'game_image' => 'Dead-of-Winter.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Terraforming Mars',
                'game_desc' => 'Gracze próbują terraformować Marsa, poprzez rozwój infrastruktury, rolnictwo i generowanie ciepła.',
                'game_players_num' => '1-5',
                'game_players_age' => '12+',
                'game_producer' => 'Stronghold Games',
                'game_image' => 'terraforming-mars.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Small World',
                'game_desc' => 'Gracze prowadzą swoje rasy fantasy do dominacji nad światem poprzez podbijanie terytoriów.',
                'game_players_num' => '2-5',
                'game_players_age' => '8+',
                'game_producer' => 'Days of Wonder',
                'game_image' => 'small-world.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Codenames: Pictures',
                'game_desc' => 'Podobne do Codenames, ale zamiast słów, używa się obrazów do przekazywania podpowiedzi.',
                'game_players_num' => '2-8+',
                'game_players_age' => '10+',
                'game_producer' => 'Czech Games Edition',
                'game_image' => 'codenames-pictures.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Power Grid',
                'game_desc' => 'Gracze zarządzają sieciami elektroenergetycznymi, rywalizując o kontrolę nad dostawą energii.',
                'game_players_num' => '2-6',
                'game_players_age' => '12+',
                'game_producer' => 'Rio Grande Games',
                'game_image' => 'Power-Grid.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Dominion: Intrigue',
                'game_desc' => 'Samodzielna gra lub rozszerzenie do Dominion, wprowadzające nowe karty i możliwość gry z większą liczbą graczy.',
                'game_players_num' => '2-6',
                'game_players_age' => '13+',
                'game_producer' => 'Rio Grande Games',
                'game_image' => 'Dominion-Intrigue.jpg',
                'game_verified' => true
            ],
            [
                'game_name' => 'Forbidden Island',
                'game_desc' => 'Gracze eksplorują wyspę, starając się zdobyć skarby i uciec przed zalaniem przez wodę.',
                'game_players_num' => '2-4',
                'game_players_age' => '10+',
                'game_producer' => 'Gamewright',
                'game_image' => 'Forbidden-Island.jpg',
                'game_verified' => true
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
