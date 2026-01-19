<div
    class="bg-white rounded-[2rem] p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-green-100 relative overflow-hidden hover:-translate-y-2 hover:shadow-green-500/20 transition-all duration-500 group-hover:border-green-500/30">

    <!-- Decorative Blob -->
    <div
        class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-green-50 to-yellow-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
    </div>

    <!-- Media Section (Video or Image) -->
    <div
        class="mb-6 rounded-2xl overflow-hidden shadow-sm aspect-video relative group-hover:shadow-md transition-all z-10 bg-green-50">
        @if ($tip->video_url)
            @if (Str::contains($tip->video_url, ['youtube.com/embed', 'youtube.com/watch', 'youtu.be']))
                @php
                    $embedUrl = $tip->video_url;
                    if (Str::contains($tip->video_url, 'watch?v=')) {
                        $videoId = explode('v=', $tip->video_url)[1];
                        // Handle potential extra parameters
                        $videoId = explode('&', $videoId)[0];
                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                    } elseif (Str::contains($tip->video_url, 'youtu.be/')) {
                        $videoId = explode('youtu.be/', $tip->video_url)[1];
                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                    }
                @endphp
                <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
            @else
                <!-- Fallback for non-youtube or raw links -->
                <a href="{{ $tip->video_url }}" target="_blank"
                    class="w-full h-full flex flex-col items-center justify-center bg-gray-900 text-white gap-2 hover:bg-green-600 transition-colors">
                    <span class="text-5xl">▶️</span>
                    <span class="font-bold text-lg">Tonton Video</span>
                </a>
            @endif
        @elseif ($tip->image)
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none">
            </div>
            <img src="{{ asset('storage/' . $tip->image) }}" alt="{{ $tip->title }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
        @else
            <div class="w-full h-full flex items-center justify-center text-green-200">
                <span class="text-4xl">📷</span>
            </div>
        @endif
    </div>

    <div class="space-y-4 relative z-10">
        <div class="flex items-start gap-3">
            <h3 class="text-xl font-bold text-gray-800 group-hover:text-green-600 transition-colors">
                {{ $tip->title }}
            </h3>
        </div>
        <p class="text-gray-600 leading-relaxed text-sm">
            {{ $tip->description }}
        </p>

        <!-- Crop Specific Tips -->
        @if ($tip->content_padi || $tip->content_jagung || $tip->content_kedelai || $tip->content_singkong || $tip->content_ubi)
            <div class="mt-4 pt-4 border-t border-green-100">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Tips Khusus Komoditas:</p>
                <div class="space-y-3">
                    @if ($tip->content_padi)
                        <div class="flex gap-3 text-sm">
                            <span class="shrink-0 text-lg" title="Padi">🌾</span>
                            <div class="text-gray-600"><span class="font-bold text-gray-700">Padi:</span>
                                {{ $tip->content_padi }}</div>
                        </div>
                    @endif
                    @if ($tip->content_jagung)
                        <div class="flex gap-3 text-sm">
                            <span class="shrink-0 text-lg" title="Jagung">🌽</span>
                            <div class="text-gray-600"><span class="font-bold text-gray-700">Jagung:</span>
                                {{ $tip->content_jagung }}</div>
                        </div>
                    @endif
                    @if ($tip->content_kedelai)
                        <div class="flex gap-3 text-sm">
                            <span class="shrink-0 text-lg" title="Kedelai">🫘</span>
                            <div class="text-gray-600"><span class="font-bold text-gray-700">Kedelai:</span>
                                {{ $tip->content_kedelai }}</div>
                        </div>
                    @endif
                    @if ($tip->content_singkong)
                        <div class="flex gap-3 text-sm">
                            <span class="shrink-0 text-lg" title="Singkong">🥔</span>
                            <div class="text-gray-600"><span class="font-bold text-gray-700">Singkong:</span>
                                {{ $tip->content_singkong }}</div>
                        </div>
                    @endif
                    @if ($tip->content_ubi)
                        <div class="flex gap-3 text-sm">
                            <span class="shrink-0 text-lg" title="Ubi Jalar">🍠</span>
                            <div class="text-gray-600"><span class="font-bold text-gray-700">Ubi:</span>
                                {{ $tip->content_ubi }}</div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Arrow Decoration -->
    <div
        class="hidden md:block absolute top-1/2 {{ $loop->odd ? '-right-3' : '-left-3' }} w-6 h-6 bg-white border-t {{ $loop->odd ? 'border-r' : 'border-l' }} border-green-100 transform {{ $loop->odd ? 'rotate-45' : '-rotate-45' }} group-hover:border-green-200 transition-colors">
    </div>
</div>
