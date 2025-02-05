<div class="absolute right-0 top-20 w-64 bg-gray-10 shadow-lg" style="height: calc(40vh - 4rem);">
    <div class="p-4">
        <div class="relative h-[calc(100vh-12rem)] overflow-hidden">
            <div class="transition-transform duration-500"
                 wire:poll.3s="nextAd"
                 style="transform: translateY(-{{ $currentIndex * 100 }}%)">
                @foreach($ads as $ad)
                    <div class="h-[calc(100vh-12rem)] p-2">
                        @if($ad['type'] === 'image')
                            <a href="{{ $ad['link'] }}" class="block">
                                <div class="bg-white rounded-lg shadow-lg p-2">
                                    <img src="{{ asset($ad['content']) }}" 
                                         alt="{{ $ad['title'] }}"
                                         class="w-full h-36 object-cover rounded">
                                    <h3 class="text-xs font-semibold mt-1 truncate">{{ $ad['title'] }}</h3>
                                </div>
                            </a>
                        @elseif($ad['type'] === 'text')
                            <a href="{{ $ad['link'] }}" class="block">
                                <div class="bg-white rounded-lg shadow-lg p-3 text-center">
                                    <h3 class="text-sm font-bold text-purple-800 mb-1">{{ $ad['title'] }}</h3>
                                    <p class="text-xs text-gray-600 line-clamp-2">{{ $ad['content'] }}</p>
                                </div>
                            </a>
                        @elseif($ad['type'] === 'video')
                            <div class="bg-white rounded-lg shadow-lg p-2">
                                <video controls class="w-full h-36 object-cover rounded">
                                    <source src="{{ asset($ad['content']) }}" type="video/mp4">
                                </video>
                                <h3 class="text-xs font-semibold mt-1 truncate">{{ $ad['title'] }}</h3>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>