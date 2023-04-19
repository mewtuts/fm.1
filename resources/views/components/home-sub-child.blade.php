@props(['category'])

<li><div class="mb-8">

    <!--Parent Folder-->
    @if ($category->parent_id === null)
        <b class="parentClass cursor-pointer">{{ $category->title }}</b>
    @else
        <div tabindex="1" id="parentClass" class="parentClass cursor-pointer w-full font-semibold p-1">{{ $category->title }}</div>
    @endif
    <!--END Parent Folder-->

     <!--Uploaded files-->
     @foreach ($category->getFiles as $file)

        <div class="parentFiles hidden">
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
        </div>
    @endforeach
 <!--END Uploaded files-->

 <!--Sub folder-->
    <ol class="letterClass list-upper-alpha px-10 text-xl mb-10 hidden">

        @foreach ($category->children as $child)

            <div class="">
                <x-home-sub-childrens :category="$child" />
            </div>

        @endforeach

    </ol>
<!--END Sub folder-->


</div></li>
<script>
    // Parent Folder to sub folders
    $(document).ready(function(){
        $(".parentClass").each(function(){
            $(this).on("click", function(){
                $(this).siblings(".letterClass").toggle();
            })
        })
    });

    $(document).ready(function(){
        $(".parentClass").each(function(){
            $(this).on("click", function(){
                $(".letterClass").css("background-color", "#e2e8f0");
            })
        })
    });

    // Main  Folder to siblings
    $(document).ready(function(){
        $(".parentClass").each(function(){
            $(this).on("click", function(){
                $(this).siblings(".parentFiles").toggle();
            })
        })
    });

    $(document).ready(function(){
        $(".parentClass").each(function(){
            $(this).on("click", function(){
                $(".parentFiles").css("background-color", "#e2e8f0");
            })
        })
    });

    // Sub folder to siblings
    $(document).ready(function(){
        $(".subParentClass").each(function(){
            $(this).on("click", function(){
                $(this).siblings(".subParentFiles").toggle();
            })
        })
    });

    //
    // $(document).ready(function(){
    //     $(".parentClass").click(function(){
    //         $(".parentClass").toggle();
    //     });
    // });

    // $(".parentClass").click(function() {
    //     $(this).css("background-color", "yellow");
    // })

    $(document).ready(function() {
        $(".parentClass").click(function() {
            $(this).toggleClass("highlight"); // add highlight class on click
        });
    });

</script>
