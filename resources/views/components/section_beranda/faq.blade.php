@props(['homeFaqs'])

<section class="relative bg-[#d8ffe5] py-10 px-6 overflow-hidden min-h-screen font-sans" x-data="{
    activeIdx: null,
    faqs: @js($homeFaqs)
}">
    {{-- BACKGROUND DECORATION --}}
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0 opacity-[0.05]"
            style="background-image: radial-gradient(#059669 0.8px, transparent 0.8px); background-size: 30px 30px;">
        </div>
        <div class="absolute -top-24 -left-24 w-[500px] h-[500px] bg-emerald-100 rounded-full blur-[120px] opacity-60">
        </div>
        <div class="absolute bottom-0 -right-24 w-[400px] h-[400px] bg-yellow-100 rounded-full blur-[100px] opacity-60">
        </div>
    </div>

    <div class="max-w-4xl mx-auto relative z-10">
        {{-- HEADING --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2e7d32]">
                FAQ <span class="text-[#f4b400]">Agroptimal</span>
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-[#2e7d32]/80">
                Temukan jawaban atas pertanyaan yang paling sering diajukan seputar layanan digital kami.
            </p>
        </div>

        {{-- FAQ LIST --}}
        <div class="grid gap-5">
            <template x-for="(faq, index) in faqs" :key="faq.id">
                <div @click="activeIdx === index ? activeIdx = null : activeIdx = index"
                    class="group relative p-6 rounded-2xl transition-all duration-500 cursor-pointer border border-white
                           hover:-translate-y-2 hover:shadow-[0_30px_60px_-15px_rgba(16,185,129,0.12)] hover:border-emerald-200"
                    :class="activeIdx === index ?
                        'bg-white shadow-2xl ring-2 ring-emerald-500/10' :
                        'bg-white/60 backdrop-blur-md'">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-emerald-50/0 via-transparent to-yellow-50/40
                               opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-5">
                                <div :class="activeIdx === index ?
                                    'bg-emerald-600 text-white rotate-6 scale-110' :
                                    'bg-yellow-400 text-emerald-950'"
                                    class="w-12 h-12 rounded-xl flex items-center justify-center font-black
                                           transition-all duration-500 shadow-sm"
                                    x-text="String(index + 1).padStart(2, '0')">
                                </div>

                                <h3 class="text-lg font-bold text-slate-800 transition-colors
                                           group-hover:text-emerald-700 pr-4"
                                    x-text="faq.q">
                                </h3>
                            </div>

                            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center
                                       transition-all duration-500"
                                :class="activeIdx === index ?
                                    'bg-emerald-100 text-emerald-600 rotate-180' :
                                    'bg-slate-100 text-slate-400'">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <div x-show="activeIdx === index" x-collapse x-cloak>
                            <div
                                class="mt-6 pt-6 border-t border-emerald-50 text-slate-600 leading-relaxed text-[1.05rem]">
                                <span x-text="faq.a"></span>

                                <div x-show="faq.verified"
                                    class="mt-4 flex items-center gap-2 text-emerald-600 text-sm font-semibold">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z">
                                        </path>
                                    </svg>
                                    Terverifikasi oleh Tim Agronom Agroptimal
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
