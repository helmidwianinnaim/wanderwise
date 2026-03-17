@extends('layouts.app')

@section('title', 'About WanderWise — We\'re Travelers Who Write Honestly')
@section('meta_description', 'WanderWise was born out of frustration with travel content that was outdated, vague, and clearly written by people who\'d never actually been there.')

@section('content')
@php
    use App\Models\SiteSetting;
    $heroTitle    = SiteSetting::get('about_hero_title',    "We're Travelers<br>Who Write Honestly");
    $heroSubtitle = SiteSetting::get('about_hero_subtitle', "WanderWise was born out of frustration with travel content that was outdated, vague, and clearly written by people who'd never actually been there.");
    $heroImage    = SiteSetting::get('about_hero_image');
    $storyTitle   = SiteSetting::get('about_story_title',   'Our Story');
    $storyText    = SiteSetting::get('about_story_text',    "We built the travel resource we wished existed — honest, practical, and genuinely useful for real trips. Every guide is researched firsthand, every tip is tested, and every itinerary actually works.\n\nOur focus is simple: the best destinations in the USA and Europe, covered with the depth and honesty they deserve.");
    $missionTitle = SiteSetting::get('about_mission_title', 'Making Every Trip Count');
    $missionText  = SiteSetting::get('about_mission_text',  "We believe that good travel planning doesn't require a travel agent or an impersonal automation. It just requires honest, well-sourced information — freely available to everyone.");
    $teamTitle    = SiteSetting::get('about_team_title',    'The People Behind WanderWise');
    $stat1Num     = SiteSetting::get('about_stat1_number');
    $stat1Lab     = SiteSetting::get('about_stat1_label');
    $stat2Num     = SiteSetting::get('about_stat2_number');
    $stat2Lab     = SiteSetting::get('about_stat2_label');
    $stat3Num     = SiteSetting::get('about_stat3_number');
    $stat3Lab     = SiteSetting::get('about_stat3_label');
    $photo1       = SiteSetting::get('about_photo1_image');
    $photo2       = SiteSetting::get('about_photo2_image');
    $photo3       = SiteSetting::get('about_photo3_image');
@endphp

{{-- ===== HERO ===== --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-sky-500 text-xs font-bold uppercase tracking-widest mb-3">{{ $storyTitle }}</p>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight tracking-tight mb-5">
                {!! $heroTitle !!}
            </h1>
            <p class="text-gray-500 text-base leading-relaxed mb-4">{{ $heroSubtitle }}</p>
            @if($storyText)
            <p class="text-gray-500 text-base leading-relaxed">{{ $storyText }}</p>
            @else
            <p class="text-gray-500 text-base leading-relaxed mb-4">
                We built the travel resource we wished existed — honest, practical, and genuinely useful for real trips. Every guide is researched firsthand, every tip is tested, and every itinerary actually works.
            </p>
            <p class="text-gray-500 text-base leading-relaxed">
                Our focus is simple: the best destinations in the USA and Europe, covered with the depth and honesty they deserve.
            </p>
            @endif
        </div>
        <div class="relative">
            @if($heroImage)
            <img src="{{ $heroImage }}" alt="About WanderWise" class="w-full h-72 object-cover rounded-2xl shadow-lg">
            @else
            <div class="bg-gradient-to-br from-sky-100 to-blue-50 rounded-2xl p-8 text-center">
                <div class="text-6xl mb-4">🌍</div>
                <div class="text-gray-600 font-medium">Exploring since</div>
                <div class="text-4xl font-extrabold text-gray-900 mt-1">2019</div>
                <div class="text-gray-500 text-sm mt-1">Countries & still exploring</div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ===== STATS ===== --}}
<div class="bg-gray-950 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @php
                $destCount = \App\Models\Destination::count();
                $postCount = \App\Models\Post::count();
                $avgRating = \App\Models\Destination::where('rating', '>', 0)->avg('rating') ?? 4.9;
                $formattedRating = number_format($avgRating, 1);
                $totalSearchCount = \App\Models\Destination::sum('search_count') ?? 0;
                $monthlyReaders = $totalSearchCount > 0 ? number_format(($totalSearchCount * 12) / 1000, 1) . 'K+' : '15K+';
            @endphp
            @foreach([
                [$destCount, 'Destinations Covered'],
                [$postCount, 'Articles Published'],
                [$monthlyReaders, 'Monthly Readers'],
                [$formattedRating . '★', 'Average Reader Rating']
            ] as $stat)
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-white mb-1">{{ $stat[0] }}</div>
                <div class="text-gray-500 text-sm">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ===== MISSION ===== --}}
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative bg-gradient-to-br from-violet-50 to-sky-50 rounded-2xl h-72 flex items-center justify-center">
                <div class="text-center">
                    <div class="text-6xl mb-3">✈️</div>
                    <p class="text-gray-600 font-medium text-lg">Making Every Trip Count</p>
                </div>
            </div>
            <div>
                <p class="text-sky-500 text-xs font-bold uppercase tracking-widest mb-3">Our Mission</p>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Making Every Trip Count</h2>
                <p class="text-gray-500 leading-relaxed mb-5">
                    We believe that good travel planning doesn't require a travel agent or an impersonal automation. It just requires honest, well-sourced information — freely available to everyone.
                </p>
                <p class="text-gray-500 leading-relaxed mb-6 text-sm">Our mission is to help travelers make the most of every trip, whether it's your first budget adventure or your hundredth business flight.</p>
                <ul class="space-y-3">
                    @foreach([
                        ['🔍','Firsthand research only','Every guide is written from personal experience. No copies from other websites.'],
                        ['🔄','Updated regularly','We actively refresh guides as cities change. Our guides are as useful as today.'],
                        ['📖','Always free to read','No paywalls, no subscriptions, no ad-gate. Our guides are free, forever.'],
                    ] as $point)
                    <li class="flex items-start gap-3">
                        <span class="text-xl shrink-0 mt-0.5">{{ $point[0] }}</span>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">{{ $point[1] }}</div>
                            <div class="text-gray-500 text-xs mt-0.5 leading-relaxed">{{ $point[2] }}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- ===== TEAM ===== --}}
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <p class="text-sky-500 text-xs font-bold uppercase tracking-widest mb-2">Meet the Writers</p>
            <h2 class="text-3xl font-extrabold text-gray-900">The People Behind WanderWise</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['SR','Sarah Reynolds','New York & Europe Expert','Based in New York, Sarah has visited 34 countries and written guides on NYC, Paris, Rome and dozens of other cities.','#0EA5E9'],
                ['MK','Mike Kowalski','Pacific & Mountain West','From the redwoods of California to the canyons of Utah, Mike covers the American West from personal experience.','#8B5CF6'],
                ['AL','Anna Lopez','Mediterranean & Iberian Cuisine','Anna\'s obsession with good food has taken her through the kitchens and street stalls of all our Mediterranean guides.','#10B981'],
                ['JD','James Decker','Budget Travel Specialist','James is convinced that amazing travel doesn\'t require a luxury budget — he\'s written dozens of guides proving it.','#F59E0B'],
            ] as $member)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-extrabold text-xl mb-4"
                     style="background-color: {{ $member[4] }};">
                    {{ $member[0] }}
                </div>
                <h3 class="font-bold text-gray-900 mb-0.5">{{ $member[1] }}</h3>
                <p class="text-xs font-semibold mb-3" style="color: {{ $member[4] }};">{{ $member[2] }}</p>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $member[3] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ===== WHY WANDERWISE ===== --}}
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sky-500 text-xs font-bold uppercase tracking-widest mb-3">Why WanderWise?</p>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Travel Guides You Can Actually Trust</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @foreach([
                        ['🎒','Real Experience','Written by travelers who\'ve actually visited — never by AI or desk researchers.'],
                        ['🔄','Always Updated','We revisit and refresh our guides. You\'ll never find outdated tips here.'],
                        ['✂️','No Fluff','Designed for the goal: We only add paragraphs that have no spare information.'],
                        ['🆓','Free Forever','No paywalls, no sign-ups, no ads gates. Our guides are always free to read.'],
                    ] as $why)
                    <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-2xl">
                        <span class="text-2xl shrink-0">{{ $why[0] }}</span>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm mb-1">{{ $why[1] }}</div>
                            <div class="text-gray-500 text-xs leading-relaxed">{{ $why[2] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-gradient-to-br from-sky-50 to-violet-50 rounded-2xl h-64 flex items-center justify-center">
                <div class="text-center">
                    <div class="text-5xl mb-3">🗺️</div>
                    <p class="font-semibold text-gray-700">Your next adventure is waiting</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== CTA ===== --}}
<div class="bg-gray-950 py-16 text-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-white mb-3">Ready to Start Exploring?</h2>
        <p class="text-gray-400 text-base mb-8">Dive into our destination guides and learn exactly the trips you've always dreamed about — all for free.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('destinations.index', ['region' => 'usa']) }}"
               class="px-7 py-3.5 bg-white text-gray-900 hover:bg-sky-50 font-semibold rounded-full transition-colors text-sm">
                Browse USA Guides
            </a>
            <a href="{{ route('destinations.index', ['region' => 'europe']) }}"
               class="px-7 py-3.5 border border-white/20 text-white hover:bg-white/10 font-semibold rounded-full transition-colors text-sm">
                Browse Europe Guides
            </a>
        </div>
    </div>
</div>

@endsection
