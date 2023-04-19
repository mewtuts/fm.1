@props(['category'])
@props(['index'])

{{-- <li><div class="mb-8"> --}}

    <!--Parent Folder-->
        @if ($category->parent_id === null)
            {{-- <b>{{ $category->title }}</b> --}}
            <b class="px-10 text-xl">{{ $category->title }}</b>
            @php
                $newString = strtolower($category->title);
            @endphp
            @if (Str::contains('transparency seal', $newString))
                {{-- Transparency Seal Description --}}
                <p class="text-xl p-10">
                    <b>National Budget Circular 542</b><br><br>National Budget Circular 542, issued by the Department of Budget and Management on August 29, 2012, reiterates compliance with Section 93 of the General Appropriations Act of FY2012. Section 93 is the Transparency Seal provision, to wit: <br><br> Sec. 93. Transparency Seal. To enhance transparency and enforce accountability, all national government agencies shall maintain a transparency seal on their official websites. The transparency seal shall contain the following information: (i) the agency’s mandates and functions, names of its officials with their position and designation, and contact information; (ii) annual reports, as required under National Budget Circular Nos. 507 and 507-A dated January 31, 2007 and June 12, 2007, respectively, for the last three (3) years; (iii) their respective approved budgets and corresponding targets immediately upon approval of this Act; (iv) major programs and projects categorized in accordance with the five key results areas under E.O. No. 43, s. 2011; (v) the program/projects beneficiaries as identified in the applicable special provisions; (vi) status of implementation and program/project evaluation and/or assessment reports; and (vii) annual procurement plan, contracts awarded and the name of contractors/suppliers/consultants. <br><br> The respective heads of the agencies shall be responsible for ensuring compliance with this section. <br><br> A Transparency Seal, prominently displayed on the main page of the website of a particular government agency, is a certificate that it has complied with the requirements of Section 93. This Seal links to a page within the agency’s website which contains an index of downloadable items of each of the above-mentioned documents. <br><br> <b>Symbolism</b> <br><br> A pearl buried inside a tightly-shut shell is practically worthless. Government information is a pearl, meant to be shared with the public in order to maximize its inherent value. <br><br> The Transparency Seal, depicted by a pearl shining out of an open shell, is a symbol of a policy shift towards openness in access to government information. On the one hand, it hopes to inspire Filipinos in the civil service to be more open to citizen engagement; on the other, to invite the Filipino citizenry to exercise their right to participate in governance. <br><br> This initiative is envisioned as a step in the right direction towards solidifying the position of the Philippines as the Pearl of the Orient – a shining example for democratic virtue in the region. <br><br> <b>DBM Compliance with Sec. 93 (Transparency Seal) R.A. No. 10155 (General Appropriations Act FY 2018)</b>
                </p>
            @else
                <p class="text-justify px-10 pt-5 text-lg">
                    @php
                        echo getDescriptions($category->template_id);
                    @endphp
                </p><br>
            @endif
            {{-- <p class="text-justify px-10 pt-5 text-lg">@php
                echo getDescriptions($category->template_id);
            @endphp</p><br> --}}
        @else
            <b class="">{{ $category->title }}</b>
        @endif
    <!--END Parent Folder-->

    <!--Uploaded files-->
    @foreach ($category->getFiles as $file)

        <div class="text-base ml-10 cursor-pointer flex items-center w-fit justify-center">
            @if ($file->file_type == 'jpeg' || $file->file_type == 'jpg' || $file->file_type == 'png' || $file->file_type == 'gif')
                <i class="bi bi-dot text-3xl text-green-800"></i>
            @elseif ($file->file_type == 'docx')
                <i class="bi bi-dot text-3xl text-green-800"></i>
            @elseif ($file->file_type == 'xlsx')
                <i class="bi bi-dot text-3xl text-green-800"></i>
            @elseif ($file->file_type == 'ppt' || $file->file_type == 'pptx')
                <i class="bi bi-dot text-3xl text-green-800"></i>
            @elseif ($file->file_type == 'pdf')
                <i class="bi bi-dot text-3xl text-green-800"></i>
            @else
                <i class="bi bi-dot text-3xl text-green-800"></i>
            @endif

            @switch($file->file_type)
                @case('url')
                    <p class="text-green-800 text-lg text-center"><a href="{{ $file->url }}" target="_blank"> {{ $file->alternative_name }}</a></p>
                @break

                @default
                    <p class="text-green-800 text-lg text-center"><a href="{{ '/home/viewFile/'.$category->title.'/'.$file->id }}" target="_blank"> {{ $file->alternative_name }}</a></p>
            @endswitch
        </div>
    @endforeach

    <!--END Uploaded files-->

    <!--Sub folder-->
        <ol class="list-roman px-6 text-xl mb-10">
            @foreach ($category->children as $child)

                <div class="" tabindex="1">
                    <x-home-sub-child :category="$child" />
                </div>
            @endforeach
        </ol>
    <!--END Sub folder-->

{{-- </div></li> --}}

