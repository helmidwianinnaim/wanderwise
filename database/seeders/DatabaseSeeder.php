<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Post;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categories = [
            ['name' => 'Travel Tips',   'slug' => 'travel-tips',   'color' => '#0EA5E9'],
            ['name' => 'City Guides',   'slug' => 'city-guides',   'color' => '#8B5CF6'],
            ['name' => 'Food & Culture','slug' => 'food-culture',  'color' => '#F59E0B'],
            ['name' => 'Itineraries',   'slug' => 'itineraries',   'color' => '#10B981'],
            ['name' => 'Budget Travel', 'slug' => 'budget-travel', 'color' => '#EF4444'],
        ];
        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Destinations - USA
        $usaDestinations = [
            [
                'name'         => 'New York City',
                'slug'         => 'new-york-city',
                'country'      => 'United States',
                'region'       => 'usa',
                'description'  => 'Experience the pulse of one of the world\'s greatest cities. From vibrant Manhattan skylines to artsy Brooklyn neighborhoods, NYC is a world unto itself — always alive, always electric.',
                'image'        => 'https://images.unsplash.com/photo-1534430480872-3498386e7856?w=800&q=80',
                'tag'          => '#1 Most Visited',
                'guides_count' => 54,
                'rating'       => 5,
                'featured'     => true,
                'search_count' => 1280,
            ],
            [
                'name'         => 'Los Angeles',
                'slug'         => 'los-angeles',
                'country'      => 'United States',
                'region'       => 'usa',
                'description'  => 'Sun, surf, and stars — explore Hollywood\'s Walk of Fame, the world-class Getty Museum, Venice Beach boardwalk, and the culinary melting pot of LA\'s diverse neighborhoods.',
                'image'        => 'https://images.unsplash.com/photo-1613052823609-5d7e11b3fe02?w=800&q=80',
                'tag'          => 'West Coast Icon',
                'guides_count' => 41,
                'rating'       => 5,
                'featured'     => true,
                'search_count' => 830,
            ],
            [
                'name'         => 'San Francisco',
                'slug'         => 'san-francisco',
                'country'      => 'United States',
                'region'       => 'usa',
                'description'  => 'Fog-draped hills, Victorian painted ladies, and the iconic Golden Gate Bridge. SF blends tech innovation with old-world charm, great coffee culture, and some of America\'s finest seafood.',
                'image'        => 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=800&q=80',
                'tag'          => 'Iconic Views',
                'guides_count' => 35,
                'rating'       => 4,
                'featured'     => true,
                'search_count' => 650,
            ],
            [
                'name'         => 'Miami',
                'slug'         => 'miami',
                'country'      => 'United States',
                'region'       => 'usa',
                'description'  => 'Art Deco architecture, pristine white sand beaches, Latin-infused cuisine, and a nightlife scene that runs until dawn. Miami is where cultures collide beautifully under the Florida sun.',
                'image'        => 'https://images.unsplash.com/photo-1571721295242-db8a39bb40cf?w=800&q=80',
                'tag'          => 'Beach Paradise',
                'guides_count' => 28,
                'rating'       => 4,
                'featured'     => true,
                'search_count' => 490,
            ],
            [
                'name'         => 'Las Vegas',
                'slug'         => 'las-vegas',
                'country'      => 'United States',
                'region'       => 'usa',
                'description'  => 'Beyond the neon casino floors lies a gateway to breathtaking nature. Las Vegas is your base for the Grand Canyon, Zion, and Hoover Dam — plus world-class shows and dining on the Strip.',
                'image'        => 'https://images.unsplash.com/photo-1581351721010-8cf859cb14a4?w=800&q=80',
                'tag'          => 'Entertainment Hub',
                'guides_count' => 32,
                'rating'       => 4,
                'featured'     => false,
                'search_count' => 580,
            ],
        ];

        // Destinations - Europe
        $europeDestinations = [
            [
                'name'         => 'Paris',
                'slug'         => 'paris',
                'country'      => 'France',
                'region'       => 'europe',
                'description'  => 'The City of Light enchants with the Eiffel Tower at golden hour, world-class art at the Louvre, charming café culture in Le Marais, and cuisine that has shaped the culinary world for centuries.',
                'image'        => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800&q=80',
                'tag'          => 'Top Pick',
                'guides_count' => 42,
                'rating'       => 5,
                'featured'     => true,
                'search_count' => 1150,
            ],
            [
                'name'         => 'Rome',
                'slug'         => 'rome',
                'country'      => 'Italy',
                'region'       => 'europe',
                'description'  => 'Walk through millennia in the Eternal City — the Colosseum, Vatican Museums, Trevi Fountain, and Trastevere\'s cobblestone lanes. And the pasta? The best you\'ll ever have.',
                'image'        => 'https://images.unsplash.com/photo-1525874684015-58379d421a52?w=800&q=80',
                'tag'          => 'Historic',
                'guides_count' => 38,
                'rating'       => 5,
                'featured'     => true,
                'search_count' => 980,
            ],
            [
                'name'         => 'Barcelona',
                'slug'         => 'barcelona',
                'country'      => 'Spain',
                'region'       => 'europe',
                'description'  => 'Gaudí\'s surreal masterpieces, a vibrant tapas culture, sun-soaked Mediterranean beaches at Barceloneta, and a nightlife that really gets going after midnight. Barcelona is pure joy.',
                'image'        => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=800&q=80',
                'tag'          => 'Art & Beach',
                'guides_count' => 31,
                'rating'       => 5,
                'featured'     => true,
                'search_count' => 870,
            ],
            [
                'name'         => 'Amsterdam',
                'slug'         => 'amsterdam',
                'country'      => 'Netherlands',
                'region'       => 'europe',
                'description'  => 'Iconic canal rings, world-class museums like the Rijksmuseum and Anne Frank House, tulip fields in spring, and a wonderfully progressive, bicycle-friendly culture that makes the city endlessly livable.',
                'image'        => 'https://images.unsplash.com/photo-1512470876302-972faa2aa9a4?w=800&q=80',
                'tag'          => 'Canal City',
                'guides_count' => 25,
                'rating'       => 4,
                'featured'     => true,
                'search_count' => 760,
            ],
            [
                'name'         => 'London',
                'slug'         => 'london',
                'country'      => 'United Kingdom',
                'region'       => 'europe',
                'description'  => 'World-class theater in the West End, royal palaces, free world-class museums, and a pub on every corner. London\'s incredible diversity means every neighborhood tells a completely different story.',
                'image'        => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=800&q=80',
                'tag'          => 'Classic',
                'guides_count' => 45,
                'rating'       => 5,
                'featured'     => true,
                'search_count' => 720,
            ],
            [
                'name'         => 'Prague',
                'slug'         => 'prague',
                'country'      => 'Czech Republic',
                'region'       => 'europe',
                'description'  => 'A medieval old town so preserved it feels like a film set, a gothic castle on the hill, the best beer in Europe, and prices that make Western Europe-weary travelers weep with relief.',
                'image'        => 'https://images.unsplash.com/photo-1541849546-216549ae216d?w=800&q=80',
                'tag'          => 'Hidden Gem',
                'guides_count' => 19,
                'rating'       => 4,
                'featured'     => false,
                'search_count' => 510,
            ],
        ];

        foreach (array_merge($usaDestinations, $europeDestinations) as $dest) {
            Destination::updateOrCreate(['slug' => $dest['slug']], $dest);
        }

        // Posts
        $cat1 = Category::where('slug', 'travel-tips')->first()->id;
        $cat2 = Category::where('slug', 'city-guides')->first()->id;
        $cat3 = Category::where('slug', 'food-culture')->first()->id;
        $cat4 = Category::where('slug', 'itineraries')->first()->id;
        $cat5 = Category::where('slug', 'budget-travel')->first()->id;

        $posts = [
            [
                'category_id'  => $cat4,
                'title'        => '10 Days in Europe: The Ultimate First-Timer Itinerary',
                'slug'         => '10-days-europe-itinerary',
                'excerpt'      => 'Paris, Rome, Barcelona — cover three iconic cities in 10 days without the tourist trap stress. Our real-traveler itinerary shows you exactly what to do, where to eat, and how to get between cities.',
                'content'      => '<p>Embarking on your first European adventure? This carefully crafted 10-day itinerary takes you through three of the continent\'s most beloved cities — without the chaos that usually comes with trying to do too much too fast.</p>

<h2>Days 1–3: Paris, France</h2>
<p>Start your journey in the City of Light. On <strong>Day 1</strong>, beat the crowds and visit the <strong>Eiffel Tower at dawn</strong> — the line is virtually non-existent and the golden morning light is magical. Spend the morning in Le Marais for breakfast at a traditional boulangerie, then head to the <strong>Louvre in the afternoon</strong> (book skip-the-line tickets in advance).</p>
<p><strong>Day 2</strong> belongs to Montmartre and the Sacré-Cœur, followed by an evening stroll along the Seine. On <strong>Day 3</strong>, take a day trip to the Palace of Versailles — just 40 minutes by RER train, and absolutely worth it. That evening, splurge on a classic French dinner near the Palais-Royal.</p>

<h2>Days 4–6: Rome, Italy</h2>
<p>A quick EasyJet or Ryanair flight (around €40–80) takes you to Rome in just 2 hours. On arrival, check into a hotel near Trastevere — the neighborhood has far more charm than the tourist center, and pasta carbonara here is life-changing.</p>
<p><strong>Day 4</strong>: The Vatican. Book the Vatican Museums and Sistine Chapel in advance — this is non-negotiable. <strong>Day 5</strong>: the ancient core — Colosseum, Roman Forum, and Palatine Hill (one ticket covers all three). End the day at the Trevi Fountain and toss your coin. <strong>Day 6</strong>: A slow morning in Campo de\' Fiori market, followed by an afternoon at the Borghese Gallery (advance booking required).</p>

<h2>Days 7–10: Barcelona, Spain</h2>
<p>Take an overnight train or morning Vueling flight to Barcelona. The city\'s energy is completely different — louder, sunnier, more chaotic in the best possible way.</p>
<p><strong>Day 7</strong>: La Sagrada Família in the morning (book tickets 2+ weeks ahead), then the Gothic Quarter for the afternoon. <strong>Day 8</strong>: Park Güell and the Gràcia neighborhood for lunch. <strong>Day 9</strong>: Barceloneta beach in the morning, La Boqueria market, and an evening in El Born. <strong>Day 10</strong>: A slow morning before your flight home.</p>

<h2>Getting Around & Practical Tips</h2>
<ul>
<li>Book all inter-city transport (flights or trains) at least 3 weeks ahead for best prices</li>
<li>Museum tickets for the Louvre, Vatican, Colosseum, and Sagrada Família all sell out — book online before you leave home</li>
<li>Get a local SIM card on arrival in Paris — it\'ll work across all three countries (EU roaming)</li>
<li>Budget approximately €150–200/day per person including accommodation, food, transport, and entry fees</li>
</ul>',
                'author'       => 'Sarah Mitchell',
                'image'        => 'https://images.unsplash.com/photo-1499856871958-5b9357976b82?w=1200&q=80',
                'read_time'    => 8,
                'featured'     => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'category_id'  => $cat2,
                'title'        => 'New York City on a Budget: 5 Days for Under $500',
                'slug'         => 'nyc-budget-guide',
                'excerpt'      => 'Yes, NYC can be affordable. Here\'s how to experience the best of the Big Apple — Central Park, world-class art, incredible food, and iconic views — without emptying your wallet.',
                'content'      => '<p>New York City has a reputation for being expensive, and while it certainly can be, the city also rewards smart travelers with an extraordinary range of free and cheap experiences. We spent 5 days in NYC on a real $500 budget (flights not included) and documented exactly how.</p>

<h2>Accommodation: $150 Total (5 Nights)</h2>
<p>The key is staying in a hostel in Brooklyn — specifically Williamsburg or Bushwick — where dorm beds go for $25–35/night. The L train gets you to Manhattan in under 20 minutes, and the neighborhoods themselves are far cooler than midtown anyway. <strong>Recommended</strong>: Pod Brooklyn, HI NYC Hostel, or The Local NYC.</p>

<h2>Free Things That Are Actually Amazing</h2>
<ul>
<li><strong>The Staten Island Ferry</strong> — Free, runs 24/7, gives you some of the best views of the Statue of Liberty and Manhattan skyline you can get</li>
<li><strong>Central Park</strong> — 843 acres of perfection. Free concerts happen regularly in summer</li>
<li><strong>The High Line</strong> — Elevated park on a former rail line, completely free, incredible views</li>
<li><strong>Brooklyn Bridge Walk</strong> — Walk across from Manhattan side to DUMBO for one of the city\'s iconic photo opportunities</li>
<li><strong>Museum Mile</strong> — The Met (pay-what-you-wish for non-NY residents, suggested $30 but not required), MoMA is $25 but worth it</li>
<li><strong>Smorgasburg</strong> — Brooklyn\'s massive outdoor food market (weekends, April–November). Free to enter, amazing food for $8–14/dish</li>
</ul>

<h2>Eating Well for Almost Nothing</h2>
<p>Dollar pizza slices are real and they\'re available all over Manhattan. Joe\'s Pizza in the Village is the classic, but honestly any slice joint will do. For more substantial meals, Chinatown in Manhattan offers incredible dumplings and noodles for under $10. Halal carts throughout midtown give you a massive chicken-and-rice plate for $6–8.</p>
<p>For coffee, skip Starbucks and look for any of the city\'s excellent indie coffee shops — many offer specialty coffee for the same price as the chain.</p>

<h2>Budget Breakdown: 5 Days</h2>
<ul>
<li>Accommodation: $150 (hostel dorm)</li>
<li>Food: $120 ($24/day including one sit-down meal)</li>
<li>Transport: $60 (7-day MetroCard)</li>
<li>Activities & Museums: $80</li>
<li>Miscellaneous: $90</li>
<li><strong>Total: $500 ✓</strong></li>
</ul>',
                'author'       => 'James Park',
                'image'        => 'https://images.unsplash.com/photo-1534430480872-3498386e7856?w=1200&q=80',
                'read_time'    => 6,
                'featured'     => false,
                'published_at' => now()->subDays(7),
            ],
            [
                'category_id'  => $cat3,
                'title'        => 'The Best Food Neighborhoods in Barcelona',
                'slug'         => 'barcelona-food-guide',
                'excerpt'      => 'From El Born\'s tapas bars to the hidden gems of Gràcia — a foodie\'s complete guide to Barcelona\'s incredible culinary scene. Skip the tourist traps and eat where locals eat.',
                'content'      => '<p>Barcelona is one of Europe\'s great food cities, but too many visitors make the mistake of eating near the main tourist attractions where quality is low and prices are high. Here\'s where locals actually eat.</p>

<h2>El Born: The Best Tapas Triangle</h2>
<p>The El Born neighborhood, just east of the Gothic Quarter, is where Barcelona\'s food scene truly thrives. The narrow medieval streets hide dozens of excellent tapas bars. <strong>Bar del Pla</strong> on Carrer de la Montcada serves what might be the best <em>patatas bravas</em> in the city — crispy outside, fluffy inside, with a sauce that has the right amount of heat. A glass of cava alongside costs €2.</p>
<p>For something more substantial, <strong>El Xampanyet</strong> (also on Montcada) has been serving anchovies, house cava, and charcuterie since 1929. Cash only, no reservations, and absolutely worth it.</p>

<h2>Gràcia: The Local Neighborhood</h2>
<p>Take the metro to Diagonal or Fontana and walk into Gràcia — this leafy residential neighborhood is where actual Barcelona residents go for coffee, vermouth, and dinner. The plaças (squares) fill up with locals on weekend afternoons for <em>vermut</em> (vermouth, typically served with olives and chips around midday). <strong>Plaça de la Vila de Gràcia</strong> is a great starting point.</p>

<h2>La Boqueria: Go Right, Skip the Tourist Stalls</h2>
<p>La Boqueria market on La Rambla is a must-see, but the stalls facing the entrance are almost all tourist traps with inflated prices and mediocre quality. Walk to the back-right corner where you\'ll find fruit vendors, cheese stalls, and the legendary <strong>Bar Pinotxo</strong> — a tiny counter bar where you\'ll get a glass of cava and a plate of chickpeas with blood sausage for €6. The owner, Juanito, is a Barcelona institution.</p>

<h2>Where to Eat Seafood</h2>
<p>For fresh seafood, skip Barceloneta\'s beachfront restaurants (tourist prices) and head instead to <strong>La Barceloneta Market</strong> on a weekday morning when the locals shop. Several market stalls prepare simple, fresh seafood dishes on-site. Grilled razor clams and gambas a la planxa (grilled prawns) are the moves.</p>

<h2>The Best Brunch Spot: Federal Café</h2>
<p>Australian-inspired brunch has landed in Barcelona and it\'s excellent. <strong>Federal Café</strong> in Sant Antoni serves avocado toast that actually deserves its reputation, plus strong flat whites and the best eggs in the city. Queue on weekends — it\'s worth it.</p>',
                'author'       => 'Maria Santos',
                'image'        => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1200&q=80',
                'read_time'    => 5,
                'featured'     => false,
                'published_at' => now()->subDays(10),
            ],
            [
                'category_id'  => $cat1,
                'title'        => 'How to Get Around Europe by Train: A Complete Guide',
                'slug'         => 'europe-train-travel-guide',
                'excerpt'      => 'Eurail passes, booking tips, scenic routes — everything you need to know about European rail travel. Whether you\'re planning a grand tour or a weekend hop, trains are almost always the best choice.',
                'content'      => '<p>European train travel is one of life\'s great pleasures. Comfortable seats, scenic countryside, city-center arrivals, and often better value than flying once you account for airport hassle. Here\'s everything you need to navigate the rails like a local.</p>

<h2>Eurail Pass vs. Point-to-Point Tickets: The Real Answer</h2>
<p>The internet is full of conflicting advice on this. Here\'s the simple truth: <strong>for most trips, point-to-point tickets booked in advance are cheaper than a Eurail pass</strong>. The Eurail Global Pass makes sense if you\'re doing 10+ train journeys across many countries spontaneously. For most planned trips of 3–5 segments, buy tickets individually.</p>
<p>Book through <strong>Trainline.eu</strong> for a single platform covering most European operators, or go directly to national rail sites (SNCF for France, Trenitalia for Italy, Deutsche Bahn for Germany, Renfe for Spain) for often slightly cheaper fares.</p>

<h2>The Fastest Routes: High-Speed Rail</h2>
<ul>
<li><strong>Paris → London</strong>: Eurostar through the Channel Tunnel, 2h15m, from £44 each way</li>
<li><strong>Paris → Brussels</strong>: Thalys/Eurostar, 1h22m — often faster than flying door-to-door</li>
<li><strong>Madrid → Barcelona</strong>: AVE high-speed, 2h30m, from €25 booked ahead</li>
<li><strong>Rome → Florence</strong>: Frecciarossa, just 1h30m, from €19</li>
<li><strong>Amsterdam → Paris</strong>: Thalys, 3h20m, from €29</li>
</ul>

<h2>The Most Scenic Routes</h2>
<p>If you have time, these routes are worth taking for the views alone:</p>
<ul>
<li><strong>Glacier Express</strong> (Switzerland): Zermatt to St. Moritz through the Alps — stunning. Book the observation car.</li>
<li><strong>Cinque Terre coastal train</strong> (Italy): Short but spectacular between the five villages</li>
<li><strong>Bergen Railway</strong> (Norway): Oslo to Bergen over Hardangervidda plateau — one of the world\'s most beautiful train journeys</li>
<li><strong>Prague → Český Krumlov</strong>: Small regional train through Bohemian countryside</li>
</ul>

<h2>Practical Tips</h2>
<ul>
<li>Book 90 days ahead for the cheapest fares on high-speed routes</li>
<li>Always validate your ticket before boarding in France, Italy, and Spain (stamp it at the yellow machines)</li>
<li>Night trains are making a comeback — the European Sleeper from Brussels to Prague is excellent value and saves a night\'s accommodation</li>
<li>Download the national rail app for offline access to your tickets</li>
</ul>',
                'author'       => 'Tom Edwards',
                'image'        => 'https://images.unsplash.com/photo-1474487548417-781cb71495f3?w=1200&q=80',
                'read_time'    => 7,
                'featured'     => false,
                'published_at' => now()->subDays(14),
            ],
            [
                'category_id'  => $cat2,
                'title'        => 'San Francisco Neighborhoods: Where to Stay & Explore',
                'slug'         => 'san-francisco-neighborhoods',
                'excerpt'      => 'From the Mission\'s taquerias to Pacific Heights\' Victorian mansions — a neighborhood-by-neighborhood breakdown of San Francisco to help you find your perfect base.',
                'content'      => '<p>San Francisco is a city of microclimates, microcultures, and micro-neighborhoods. Choosing where to stay shapes your entire experience. Here\'s a guide to the main neighborhoods — what they\'re like, who they\'re for, and what you shouldn\'t miss.</p>

<h2>The Mission District: Food, Art & Energy</h2>
<p>The Mission is where SF\'s Latino heritage meets a thriving arts scene, excellent restaurants, and buzzy bars. It\'s warmer than most of the city (the hills block the fog) and has the best street food. The Mission\'s taquerias are legendary — <strong>La Taqueria</strong> on Mission Street has been serving the city\'s finest burrito for decades. The murals along Balmy Alley are a genuine cultural treasure.</p>
<p><strong>Best for</strong>: Foodies, night-owls, and culture-seekers. <strong>Avoid</strong>: If you\'re bothered by urban grit — some blocks are rough.</p>

<h2>The Castro: History & Community</h2>
<p>One of America\'s most iconic LGBTQ+ neighborhoods, the Castro combines rich history (Harvey Milk\'s camera shop still exists as a museum) with excellent restaurants, the beautiful Castro Theatre cinema, and a warm, welcoming community atmosphere.</p>

<h2>Hayes Valley: Chic & Walkable</h2>
<p>Boutique shops, acclaimed restaurants, and proximity to the opera — Hayes Valley is SF\'s most polished neighborhood. <strong>Sightglass Coffee</strong> roasts some of the city\'s best beans here, and <strong>Zuni Café</strong> is a San Francisco institution. Stay here and the entire city is walkable or a short Muni ride away.</p>

<h2>Fisherman\'s Wharf: Tourist Central (In the Best Way)</h2>
<p>Skip the hotel names that position themselves as "upscale" near Fisherman\'s Wharf — the food at Pier 39 is mediocre and overpriced. But the area is excellent for: the SF Maritime National Park, renting a bike for the Golden Gate ride to Sausalito, and watching the sea lions. Just eat elsewhere.</p>

<h2>The Fog Factor</h2>
<p>Karl the Fog (as locals call it) rolls in most afternoons, particularly in the Sunset and Richmond districts near the ocean. The Mission and downtown areas stay significantly warmer. Plan accordingly and pack a layer regardless of the season.</p>',
                'author'       => 'Lily Chen',
                'image'        => 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=1200&q=80',
                'read_time'    => 6,
                'featured'     => false,
                'published_at' => now()->subDays(18),
            ],
            [
                'category_id'  => $cat5,
                'title'        => 'Packing List for a 2-Week USA Road Trip',
                'slug'         => 'usa-road-trip-packing-list',
                'excerpt'      => 'Don\'t leave home without these 25 essentials for the ultimate American road trip adventure. From essential tech to comfort items, this list covers everything you actually need.',
                'content'      => '<p>A road trip across the USA is on almost everyone\'s bucket list. The open highway, the changing landscapes, the freedom — it\'s genuinely one of life\'s great experiences. But packing wrong can make it miserable. Here\'s what you actually need.</p>

<h2>Navigation & Technology</h2>
<ul>
<li><strong>Phone mount</strong> for the dashboard — essential for safe navigation</li>
<li><strong>Car charger with multiple USB ports</strong> — you\'ll use it constantly</li>
<li>Download <strong>Google Maps offline maps</strong> for your entire route before you leave — cell coverage in national parks can be non-existent</li>
<li>A portable <strong>power bank</strong> (20,000mAh minimum) for hiking days when you\'re away from the car</li>
</ul>

<h2>Comfort Essentials</h2>
<ul>
<li><strong>Seat cushion</strong> — after Day 3 of long drives, you\'ll understand</li>
<li><strong>Neck pillow</strong> for passengers</li>
<li>A <strong>small cooler</strong> is transformative. Stock it with drinks and snacks at each town and avoid highway service station prices ($5 for a bottle of water is the American road trip tax)</li>
<li><strong>Reusable water bottles</strong> — absolutely essential, especially in desert states</li>
</ul>

<h2>Clothing Strategy</h2>
<p>The biggest mistake is overpacking clothes. Wear each item 2–3 times and use laundromats (they\'re everywhere, cheap, and a genuine road trip experience). Focus on layering — desert mornings can be 5°C even in summer, afternoons 38°C. Quick-dry fabrics are your friends.</p>

<h2>National Park Essentials</h2>
<ul>
<li>Get an <strong>America the Beautiful Pass</strong> ($80) at the first national park you visit — it covers all of them for 12 months</li>
<li><strong>Hiking boots</strong> — even light trails in places like the Grand Canyon can be treacherous in sneakers</li>
<li><strong>Sunscreen SPF50+</strong> — the US Southwest sun is brutal</li>
<li><strong>Headlamp</strong> for camping and dawn hikes</li>
</ul>',
                'author'       => 'WanderWise Team',
                'image'        => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1200&q=80',
                'read_time'    => 4,
                'featured'     => false,
                'published_at' => now()->subDays(21),
            ],
            [
                'category_id'  => $cat2,
                'title'        => 'Paris Beyond the Eiffel Tower: 7 Hidden Gems',
                'slug'         => 'paris-hidden-gems',
                'excerpt'      => 'Paris rewards those who wander off the beaten tourist path. From secret passages to neighborhood libraries, here are seven places that most visitors completely miss.',
                'content'      => '<p>Paris is one of the world\'s most visited cities, and with those numbers come crowds at every famous spot. But the city has an extraordinary parallel reality — quieter, more authentic, and frankly more interesting than the tourist circuit. Here are seven hidden gems worth seeking out.</p>

<h2>1. The Covered Passages of Paris</h2>
<p>In the 19th century, Paris was home to hundreds of these glass-roofed shopping arcades. Most were demolished, but around 20 survive and are largely forgotten by tourists. <strong>Galerie Vivienne</strong> near the Palais-Royal is the most beautiful, with its mosaic floors and classical décor. <strong>Passage des Panoramas</strong> is the oldest and home to several excellent stamp dealers and the fantastic Stern brasserie.</p>

<h2>2. Musée de la Chasse et de la Nature</h2>
<p>Tucked in the Marais, this hunting and nature museum is one of Paris\'s strangest and most captivating. It\'s part natural history museum, part contemporary art installation, with taxidermied animals sharing rooms with modern art in ways that are genuinely thought-provoking. Rarely busy. Entry: €12.</p>

<h2>3. The Petite Ceinture</h2>
<p>An abandoned railway that once circled Paris, sections of the Petite Ceinture have been opened as urban nature trails. The 15th arrondissement section is exceptionally atmospheric — wild grass growing through tracks, street art, and the strange quiet of being underground in the middle of a city of 2 million.</p>

<h2>4. Square du Vert-Galant</h2>
<p>At the tip of the Île de la Cité, just below the Pont-Neuf, is a small triangular park at water level. Most visitors walk across the bridge without noticing the stairs down. Sit here with a baguette and watch the Seine flow by — it\'s one of the most peaceful spots in the city.</p>',
                'author'       => 'Sarah Mitchell',
                'image'        => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=1200&q=80',
                'read_time'    => 5,
                'featured'     => false,
                'published_at' => now()->subDays(25),
            ],
            [
                'category_id'  => $cat4,
                'title'        => '7 Days in London: The Perfect First Visit Itinerary',
                'slug'         => '7-days-london-itinerary',
                'excerpt'      => 'A week in London is just enough to see the essential sights, discover a few great neighborhoods, and understand why this endlessly complex city gets under everyone\'s skin.',
                'content'      => '<p>Seven days in London is genuinely the minimum needed to scratch the surface. But with the right structure, you can cover the iconic landmarks, discover brilliant neighborhoods, and eat embarrassingly well — all while staying sane and avoiding the worst of the tourist crowds.</p>

<h2>Day 1–2: Central London Foundations</h2>
<p>Start at <strong>The British Museum</strong> (free, remarkable — budget at least 3 hours). Walk through Bloomsbury to Covent Garden for lunch, then South to the Thames Embankment. Cross the Millennium Bridge to the <strong>Tate Modern</strong> (also free). Evening: a pub dinner in Borough Market area.</p>
<p>Day 2: <strong>Westminster</strong> — the Houses of Parliament exterior, Westminster Abbey (worth the £27 entry), St James\'s Park, and Buckingham Palace. Afternoon at the <strong>National Gallery</strong> on Trafalgar Square (free). Evening walk along the South Bank.</p>

<h2>Day 3: East London</h2>
<p><strong>Columbia Road Flower Market</strong> (Sunday mornings only — plan accordingly) followed by Shoreditch street art and independent coffee shops. <strong>Boxpark</strong> for lunch. Afternoon in <strong>Brick Lane</strong> for vintage shops and the best bagels of your life at Beigel Bake (open 24/7, cash only, €1.20 for a salt beef bagel).</p>

<h2>Day 4: Royal Greenwich & Southeast</h2>
<p>Take the river boat from Westminster Pier to Greenwich (the journey itself is worth it — the Thames views of Canary Wharf are excellent). Visit the <strong>Royal Observatory</strong>, stand on the Prime Meridian, and get the classic skyline photo. The market in Greenwich is excellent on weekends.</p>',
                'author'       => 'Tom Edwards',
                'image'        => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=1200&q=80',
                'read_time'    => 7,
                'featured'     => false,
                'published_at' => now()->subDays(30),
            ],
            [
                'category_id'  => $cat1,
                'title'        => 'The Best Travel Apps for 2025 (Actually Useful Ones)',
                'slug'         => 'best-travel-apps-2025',
                'excerpt'      => 'We tested dozens of travel apps so you don\'t have to. These are the ones that actually made a difference — from offline navigation to finding the best local restaurants.',
                'content'      => '<p>Every travel publication has a "best apps" list. Most of them include apps nobody uses. This is a list of apps that real travelers actually rely on, tested across multiple trips in 2024 and 2025.</p>

<h2>Navigation: Maps.me & Google Maps Offline</h2>
<p><strong>Google Maps offline</strong> is the standard — download the offline map for your destination (requires WiFi) and you have full navigation without data. The coverage and accuracy remain unmatched. But <strong>Maps.me</strong> is excellent as a backup for hiking and rural areas, with detailed topographic data that Google Maps doesn\'t always show.</p>

<h2>Finding Good Food: TheFork & Yelp</h2>
<p>In Europe, <strong>TheFork</strong> (called ElTenedor in Spain) has better restaurant coverage than Google and often offers 20–50% discount deals for off-peak bookings. In the US, <strong>Yelp</strong> remains the gold standard despite its critics — the review quality for restaurants is generally reliable, and you can filter meaningfully.</p>

<h2>Transport: Trainline & Google Flights</h2>
<p><strong>Trainline</strong> covers 270+ train operators across Europe with a clean, fast booking experience. For flights, no app beats <strong>Google Flights</strong> for finding the best fares — the price calendar view alone is worth it. Set price alerts for routes you\'re considering.</p>

<h2>Language: DeepL (Not Google Translate)</h2>
<p><strong>DeepL</strong> consistently produces more natural translations than Google Translate, particularly for European languages. The camera translation feature (point your phone at a menu) works extremely well. The free tier is sufficient for travel use.</p>

<h2>Packing & Planning: TripIt</h2>
<p>Forward your booking confirmations to <strong>TripIt</strong> and it automatically builds a master itinerary with flight times, hotel addresses, and booking references. When you\'re standing at an airport at 5am trying to remember what terminal you\'re flying from, TripIt makes it effortless.</p>',
                'author'       => 'Lily Chen',
                'image'        => 'https://images.unsplash.com/photo-1583394293214-c99cff45bf39?w=1200&q=80',
                'read_time'    => 5,
                'featured'     => false,
                'published_at' => now()->subDays(35),
            ],
            [
                'category_id'  => $cat3,
                'title'        => 'Roman Food Guide: What to Eat, Where to Eat It',
                'slug'         => 'rome-food-guide',
                'excerpt'      => 'Roman cuisine is one of Italy\'s most distinctive — and most misunderstood by tourists. Here\'s an honest guide to eating brilliantly in Rome, from cacio e pepe to supplì.',
                'content'      => '<p>Roman food is not the same as "Italian food." The cuisine of Rome is specific, ancient, and deeply local — and most tourists miss the best of it by eating near the major attractions where quality is guaranteed to disappoint.</p>

<h2>The Four Essential Roman Pasta Dishes</h2>
<p>Roman culinary identity rests on four pasta dishes. Master finding good versions of these and you\'ve conquered the cuisine.</p>
<ul>
<li><strong>Cacio e Pepe</strong>: Spaghetti or tonnarelli, pecorino romano, black pepper. No cream. Nothing else. Finding a restaurant that makes it without cream is the first test.</li>
<li><strong>Carbonara</strong>: Guanciale (cured cheek, not bacon), egg yolk, pecorino, black pepper. Again: no cream.</li>
<li><strong>Amatriciana</strong>: Guanciale, San Marzano tomatoes, pecorino. Simple and extraordinary when done right.</li>
<li><strong>Gricia</strong>: The base of all Roman pasta — guanciale and pecorino, no tomato. The simplest and often the most revealing of a restaurant\'s quality.</li>
</ul>

<h2>Where to Eat: Skip the Tourist Traps</h2>
<p>Any restaurant with photos on the menu, a host standing outside trying to pull you in, or words like "authentic" or "traditional" prominently displayed is almost certainly a tourist trap. Instead, look for:</p>
<ul>
<li><strong>Trastevere</strong> (western bank of the Tiber): <strong>Da Enzo al 29</strong> is small, unpretentious, and serves the best cacio e pepe we\'ve found</li>
<li><strong>Testaccio</strong>: Rome\'s old slaughterhouse district, now the city\'s most food-forward neighborhood. The market here is excellent for lunch</li>
<li><strong>Prati</strong> (near the Vatican): <strong>Il Sorpasso</strong> for great wine and small plates; escape the Vatican tourist circuit</li>
</ul>

<h2>The Roman Street Food You Must Try</h2>
<p><strong>Supplì</strong> — fried rice balls with a mozzarella center — are Rome\'s answer to the arancino, and they\'re exceptional. The best are at <strong>Supplì Roma</strong> on Via di San Francesco a Ripa in Trastevere (around €2 each). Also: <em>pizza al taglio</em> (pizza by the slice, sold by weight) from any of the city\'s countless <em>forno</em> bakeries.</p>',
                'author'       => 'Maria Santos',
                'image'        => 'https://images.unsplash.com/photo-1525874684015-58379d421a52?w=1200&q=80',
                'read_time'    => 6,
                'featured'     => false,
                'published_at' => now()->subDays(40),
            ],
            [
                'category_id'  => $cat5,
                'title'        => 'How to Fly to Europe for Under $400 Round-Trip',
                'slug'         => 'cheap-flights-to-europe',
                'excerpt'      => 'Transatlantic flights don\'t have to cost a fortune. These are the real strategies — not the gimmicks — that repeatedly land sub-$400 round-trip fares to Europe from the USA.',
                'content'      => '<p>The number of people who\'ve paid $1,200+ for a flight to Europe that I\'ve watched fly for $350 is genuinely distressing. Cheap transatlantic fares exist regularly — you just have to know when and how to look.</p>

<h2>The Core Strategy: Flexible Dates + Fare Alerts</h2>
<p>If you have a specific week you need to travel, you\'ve already given up most of your leverage. The single most powerful thing you can do is decide <em>where</em> you want to go before when you want to go, then let fare alerts tell you when to book.</p>
<p>Set up alerts on <strong>Google Flights</strong> for your origin → destination. When prices drop, you\'ll get an email. The cheapest fares often appear 6–8 weeks out and last 24–48 hours.</p>

<h2>The Best US Departure Cities for Cheap Europe Flights</h2>
<ul>
<li><strong>New York (JFK/EWR)</strong>: Most routes, most competition, frequently the cheapest overall</li>
<li><strong>Boston (BOS)</strong>: Excellent Norwegian Air routes to London and Edinburgh</li>
<li><strong>Philadelphia (PHL)</strong>: American Airlines hub with frequent Europe sales</li>
<li><strong>Chicago (ORD)</strong>: Good LOT Polish Airlines connections via Warsaw</li>
</ul>

<h2>Airlines That Actually Offer Cheap Transatlantic Fares</h2>
<ul>
<li><strong>Norse Atlantic</strong>: The newest entrant, JFK → London and Paris from $189-$350 one-way regularly</li>
<li><strong>Norwegian Air</strong>: Inconsistent but when they have sales, extraordinary value</li>
<li><strong>Icelandair</strong>: Boston/New York → Reykjavik → European cities. Free stopover!</li>
<li><strong>Level</strong>: Iberia\'s budget transatlantic arm, Barcelona and Paris from about €150 one-way</li>
</ul>

<h2>When to Book</h2>
<p>For summer travel (June–August), the sweet spot for bookings is <strong>January–March</strong>. For shoulder season (May, September, October), you can often book 6–8 weeks out. Never book summer Europe flights in April expecting good prices — you\'ve already missed the cheapest fares.</p>',
                'author'       => 'James Park',
                'image'        => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1200&q=80',
                'read_time'    => 6,
                'featured'     => false,
                'published_at' => now()->subDays(45),
            ],
            [
                'category_id'  => $cat4,
                'title'        => 'Amsterdam in 3 Days: The Perfect Long Weekend Guide',
                'slug'         => 'amsterdam-weekend-guide',
                'excerpt'      => 'Three days is enough to see Amsterdam\'s best — the canals, the Rijksmuseum, Anne Frank House, and the perfect Indonesian dinner — if you plan it right.',
                'content'      => '<p>Amsterdam is one of Europe\'s most walkable cities and nearly perfect for a long weekend. Three days covers the highlights comfortably without rushing. Here\'s how to do it right.</p>

<h2>Day 1: Canal Ring & Museums</h2>
<p>Start early — the <strong>Rijksmuseum</strong> opens at 9am and the first hour is significantly quieter. Budget 2–3 hours for the collection (Rembrandt\'s Night Watch is the obvious focal point, but the Delftware collection is equally extraordinary). Walk north through the canal ring to the <strong>Anne Frank House</strong> — book tickets well in advance, they sell out weeks ahead. The experience is sobering and important.</p>
<p>For lunch, duck into any of the brown cafés (bruine kroegen) that line the canals — these are Amsterdam\'s traditional pubs, and they all do simple, good Dutch food. An <em>uitsmijter</em> (fried eggs on bread with ham) is the classic. End the day with a canal boat tour at golden hour — the light on the water and the facades is genuinely stunning.</p>

<h2>Day 2: Jordaan & Vondelpark</h2>
<p>The <strong>Jordaan</strong> neighborhood, just west of the center, is the most charming part of Amsterdam — narrow streets, independent galleries, specialist shops, and excellent restaurants. The <strong>Noordermarkt</strong> on Saturdays has an excellent organic food market and vintage stalls.</p>
<p>Rent a bike (Macbike or StarBikes, around €14/day) and cycle to <strong>Vondelpark</strong> — the city\'s beloved green lung. In summer, street performers and picnickers fill every corner.</p>

<h2>Day 3: Jordindische Buurt & Indonesian Food</h2>
<p>The Netherlands colonized Indonesia for 350 years, and the culinary legacy is one of Amsterdam\'s great gifts. Dutch-Indonesian cuisine (<em>Indo</em>) is extraordinary and almost unknown outside the Netherlands. For the full experience, order a <strong>rijsttafel</strong> (rice table) — dozens of small dishes served with rice. <strong>Sama Sebo</strong> on PC Hooftstraat is excellent; book ahead.</p>',
                'author'       => 'WanderWise Team',
                'image'        => 'https://images.unsplash.com/photo-1512470876302-972faa2aa9a4?w=1200&q=80',
                'read_time'    => 5,
                'featured'     => false,
                'published_at' => now()->subDays(50),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
