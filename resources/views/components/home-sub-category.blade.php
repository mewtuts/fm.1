@props(['category'])
@props(['index'])

{{-- <li><div class="mb-8"> --}}

    <!--Parent Folder-->
        @if ($category->parent_id === null)
            {{-- <b>{{ $category->title }}</b> --}}
            <b class="px-10 text-xl">{{ $category->title }}</b>
            <p class="text-justify px-10 pt-5 text-lg">@php
                echo getDescriptions($category->template_id);
            @endphp</p><br>
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
                    <p class="text-green-800 text-lg text-center"><a href="{{ $file->url }}" target="_blank"> {{ $file->alternative_name }} (url)</a></p>
                @break

                @default
                    <p class="text-green-800 text-lg text-center"><a href="{{ '/home/viewFile/'.$category->title.'/'.$file->id }}" target="_blank"> {{ $file->alternative_name }} (file)</a></p>
            @endswitch
        </div>
    @endforeach

    <!--END Uploaded files-->

    <!--Sub folder-->
    <ol class="list-roman px-6 text-xl mb-10">
        @foreach ($category->children as $child)

            <x-home-sub-child :category="$child" />

        @endforeach
    </ol>
    <!--END Sub folder-->

{{-- </div></li> --}}

