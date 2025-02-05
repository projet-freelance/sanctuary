<div class="relative overflow-hidden top-10 bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="relative overflow-hidden" style="height: 150px;">
            <div class="flex transition-transform duration-500" wire:poll.3s="nextAd"
                 style="transform: translateX(-{{ $currentIndex * 100 }}%)">
                @foreach($ads as $ad)
                    <div class="min-w-full px-4 flex justify-center items-center">
                        @if($ad['type'] === 'image')
                            <a href="{{ $ad['link'] }}" class="block">
                                <div class="bg-white rounded-lg shadow-lg p-4">
                                    <img src="{{ asset($ad['content']) }}" 
                                         alt="{{ $ad['title'] }}"
                                         class="w-full h-48 object-cover rounded">
                                    <h3 class="text-lg font-semibold mt-2">{{ $ad['title'] }}</h3>
                                </div>
                            </a>
                        @elseif($ad['type'] === 'text')
                            <a href="{{ $ad['link'] }}" class="block w-full">
                                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                                    <h3 class="text-xl font-bold text-purple-800 mb-2">{{ $ad['title'] }}</h3>
                                    <p class="text-gray-600">{{ $ad['content'] }}</p>
                                </div>
                            </a>
                        @elseif($ad['type'] === 'video')
                            <div class="bg-white rounded-lg shadow-lg p-4">
                                <video controls class="w-full h-48 object-cover rounded">
                                    <source src="{{ $ad['content'] }}" type="video/mp4">
                                </video>
                                <h3 class="text-lg font-semibold mt-2">{{ $ad['title'] }}</h3>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>