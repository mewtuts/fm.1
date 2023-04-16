@props(['category'])
@props(['index'])

<div class="col-span-2 mt-2 p-2 rounded">

    <!--Parent Folder-->
    @if ($category->parent_id != null)

        <div data-id="{{ $category->id }}folder_{{ $category->title }}" class="item w-full ml-2 rounded pl-3 pr-6 py-2 bg-slate-200 cursor-pointer text-zinc-800 text-lg" onclick="getParentID()">
            {{-- <input class="" type="radio" name="id" value="{{ $category->id }}folder" required> --}}
            <i class="bi bi-folder-fill text-orange-300 text-xl pr-2"></i>
        {{ $category->title }}
        </div>

    @endif
    <!--END Parent Folder-->

    <!--Uploaded files-->
    @foreach ($category->getFiles as $file)

        <div data-id="{{ $file->id }}file_{{ $category->title }}" class='item ml-3 mt-1 cursor-pointer p-2 hover:bg-slate-200 rounded w-full text-zinc-600 border-b-2' onclick="getParentID()">
            @if ($file->file_type == 'jpeg' || $file->file_type == 'jpg' || $file->file_type == 'png' || $file->file_type == 'gif' || $file->file_type == 'tif')
                {{-- <input class="radioShow" type="radio" id="image" name="id" value="{{ $file->id }}file" required> --}}
                <i class="bi bi-file-earmark-image text-indigo-800 text-xl pr-2"></i>

            @elseif ($file->file_type == 'docx')
                {{-- <input class="radioShow" type="radio" id="image" name="id" value="{{ $file->id }}file" required> --}}
                <i class="bi bi-file-earmark-word-fill text-blue-800 text-xl pr-2"></i>

            @elseif ($file->file_type == 'xlsx')
                {{-- <input class="radioShow" type="radio" id="image" name="id" value="{{ $file->id }}file" required> --}}
                <i class="bi bi-file-earmark-excel-fill text-green-800 text-xl pr-2"></i>

            @elseif ($file->file_type == 'ppt' || $file->file_type == 'pptx')
                {{-- <input class="radioShow" type="radio" id="image" name="id" value="{{ $file->id }}file" required> --}}
                <i class="bi bi-file-earmark-ppt-fill text-orange-800 text-xl pr-2"></i>

            @elseif ($file->file_type == 'pdf')
                {{-- <input class="radioShow" type="radio" id="image" name="id" value="{{ $file->id }}file" required> --}}
                <i class="bi bi-file-earmark-pdf-fill text-red-800 text-xl pr-2"></i>
            @else
                {{-- <input class="radioShow" type="radio" name="id" value="{{ $file->id }}file" required> --}}
                <i class="bi bi-file-earmark-fill text-green-800 text-xl pr-2"></i>
            @endif

            @switch($file->file_type)
                @case('url')
                    <a href="{{ $file->url }}" target="_blank"> {{ $file->alternative_name }} (url)</a>
                @break

                @default
                    <a href="{{ '/users/viewFile/'.$category->title.'/'.$file->id }}" target="_blank"> {{ $file->alternative_name }} (file)</a>
            @endswitch

        </div>

    @endforeach
    <!--END Uploaded files-->

    <!--Sub folder-->
    @foreach ($category->children as $index => $child)

        <div class="ml-2">

            <x-sub-category :category="$child" :index="$index" />

        </div>

    @endforeach
    <!--END Sub folder-->

</div>
