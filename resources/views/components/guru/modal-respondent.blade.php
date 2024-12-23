@props(['data', 'muridId'])

@php
    $defaultClasses = 'flex flex-col border-2 border-gray-100 p-3 md:p-4 rounded-md cursor-pointer';
    $activeClasses = 'bg-gray-800 text-white';
    $hoverClasses = 'hover:bg-gray-800 hover:text-white focus:bg-gray-800';
@endphp

<div x-data="{ isOpen: false }" class="col-span-2">
    <div {{ $attributes->merge(['class' => $defaultClasses]) }}
        :class="{ '{{ $activeClasses }}': isOpen, '{{ $hoverClasses }}': !isOpen }" @click="isOpen = !isOpen"
        @click.outside="isOpen = false" x-cloak>
        <div class="flex justify-between items-center">
            <span class="text-md font-medium">
                {{ $slot }}
            </span>
        </div>

        <!-- Detail Kelompok -->
        <div class="grid items-center gap-2 mt-2" x-show="isOpen" x-transition @click.stop>
            {{-- Level 1 --}}
            <x-guru.respondent-level infoLevel="1">
                @foreach ($data->where('murid_id', $muridId) as $item)
                    <x-guru.respondent-soal infoSoal="{{ $loop->iteration }}">
                        <x-guru.response :number="$loop->iteration" responseType="pilganWithUpload" :question="$item->soal_question_text" :answer="$item->answer" :image_reason="$item->image_reason" :point_reason="$item->point_reason" id="{{ $item->id }}"></x-guru.response>
                    </x-guru.respondent-soal>
                @endforeach
            </x-guru.respondent-level>

            {{-- Level 2 --}}
            <x-guru.respondent-level infoLevel="2">
                <x-guru.respondent-soal infoSoal="1">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="2">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="3">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="4">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
            </x-guru.respondent-level>

            {{-- Level 3 --}}
            <x-guru.respondent-level infoLevel="3">
                <x-guru.respondent-soal infoSoal="1">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="2">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="3">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="4">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
            </x-guru.respondent-level>

            {{-- Level 4 --}}
            <x-guru.respondent-level infoLevel="4">
                <x-guru.respondent-soal infoSoal="1">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="2">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="3">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="4">
                    <x-guru.response responseType="upload" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
            </x-guru.respondent-level>

            {{-- Level 5 --}}
            <x-guru.respondent-level infoLevel="5">
                <x-guru.respondent-soal infoSoal="1">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="2">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="3">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
                <x-guru.respondent-soal infoSoal="4">
                    <x-guru.response responseType="pilgan" question="Berapa hasil dari 2+2?" answer="4"></x-guru.response>
                </x-guru.respondent-soal>
            </x-guru.respondent-level>
        </div>
    </div>
</div>
