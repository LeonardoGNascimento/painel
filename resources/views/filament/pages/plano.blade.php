<x-filament-panels::page>
    <div class="fi-wi-stats-overview-stats-ctn grid gap-6 md:grid-cols-3">
        @foreach ($this->getData() as $item)
            <div
                class="relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 w-full">
                <div class="flex flex-col items-center justify-center text-center">
                    <h1 class="text-2xl">R$ {{ $item['price'] }}</h1>
                    <p> {{ $item['name'] }}</p>
                </div>
                <div class="py-8">
                    <ul class="space-y-2">
                        <li class="flex justify-between border-dotted border-b-2 border-sky-500">
                            <p>GGR (API Fee)</p>
                            <p class="text-success">{{ $item['ggr'] }}%</p>
                        </li>
                        <li class="flex justify-between border-dotted border-b-2 border-sky-500">
                            <p>Bonus</p>
                            <p class="text-success">{{ $item['bonus'] }}%</p>
                        </li>
                        <li class="flex justify-between border-dotted border-b-2 border-sky-500">
                            <p>Rate</p>
                            <p class="text-success">{{ $item['rate'] }}</p>
                        </li>
                        <li class="flex justify-between border-dotted border-b-2 border-sky-500">
                            <p>Deposit Amount</p>
                            <p class="text-success">R$ {{ $item['depositAmount'] }}</p>
                        </li>
                        <li class="flex justify-between border-dotted border-b-2 border-sky-500">
                            <p>Bonus Amount</p>
                            <p class="text-success">R$ {{ $item['bonusAmount'] }}</p>
                        </li>
                        <li class="flex justify-between border-dotted border-b-2 border-sky-500">
                            <p>Total</p>
                            <p class="text-primary-500">R$ {{ $item['total'] }}</p>
                        </li>
                    </ul>
                </div>
                <div class="mt-6 flex flex-col justify-center items-center text-center p-4">
                    <p>Your balance is increased by</p>
                    <h2 class="text-2xl font-bold text-primary-500">R$ {{ $item['total'] }}</h2>
                    <div class="mt-3">
                        <a href="#"
                            class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-gray fi-btn-color-gray fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm sm:inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20">
                            Comprar agora
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
