<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    @vite('resources//css/app.css')
    <title>Folder and Files</title>
    <style>
        .highlighted {
            background-color: #cbd5e1;
        }
    </style>
</head>
<body>
<body class="bg-slate-50">
    <header class="bg-green-800 h-24 flex">
        <a href="{{ '/users/home' }}" class="flex items-center p-4" title="Home">
            {{-- <i class="bi bi-folder-fill text-orange-300 text-4xl pr-4"></i> --}}
            <h1 class="text-center text-3xl text-slate-50">Folders and Files</h1>
        </a>
    </header>

    <!-- Main Content -->
    <div class="w-screen h-fit overflow-auto">
        <!-- Updating the description of the title -->
        <div id="showUpdateDescription" class="hidden">
            <div class="h-caption-box w-screen absolute flex justify-center items-center">
                <div class="w-96">
                    <form action="{{ '/users/editDescription/'.$template_id }}" class="bg-slate-200 px-10 py-10 rounded shadow" method="POST">@csrf
                        <h1 class="mb-5 text-xl text-center text-zinc-700">Update the description</h1>
                        <div class="">
                            <textarea name="description" id="" cols="30" rows="10" class="resize-none rounded w-full overflow-auto bg-slate-100 border-none"></textarea>
                        </div>
                        <div class="mt-2">
                            <input type="submit" name="update" value="Update" class="w-full bg-green-800 rounded cursor-pointer text-white p-2 hover:bg-green-900">
                        </div>
                    </form>
                </div>
                <script>
                    $(document).ready(function(){
                        $("#buttonUpdateDescription").click(function(){
                            $("#showUpdateDescription").toggle(500);
                        })
                    })
                </script>
            </div>
        </div>
       <div class="grid xl:grid-cols-6 lg:grid-cols-6 md:grid-cols-6 gap-5">
            <div class="h-fit xl:col-span-2 lg:col-span-2 md:col-span-3 p-5">
                <!-- Form Content -->
                <div class="shadow p-5 h-fit rounded-lg">
                    <!-- Buttons to create and upload -->
                    <div class="w-full flex justify-end  px-5 pb-2">
                        <!-- Create Folder -->
                        <div class="flex justify-center border-2 rounded-full w-fit items-center mr-2 bg-green-800 text-white hover:bg-green-900">
                            <button id="buttonCreateFolder" class="w-10 cursor-pointer text-center p-2"><i class="bi bi-folder font-bold"></i></button>
                        </div>
                        <!-- Upload File -->
                        <div id="buttonUploadFile" class="flex justify-center border-2 rounded-full w-fit items-center mr-2 bg-green-800 text-white hover:bg-green-900">
                            <button class="w-10 cursor-pointer text-centerp-2"><i class="bi bi-file-earmark"></i></button>
                        </div>
                        <!-- Upload Via URL -->
                        <div id="buttonUploadFileUrl" class="flex justify-center border-2 rounded-full w-fit items-center mr-2 bg-green-800 text-white hover:bg-green-900">
                            <button class="w-10 cursor-pointer text-centerp-2"><i class="bi bi-link"></i></button>
                        </div>
                    </div>
                    <!-- Create Folder Form -->
                    <div class="h-fit mt-2 flex items-center justify-center">
                        <div class="w-full" id="showCreateFolder">
                            <form action="{{ route('storeSubParent') }}" class="px-5 py-10 bg-slate-200 rounded-lg flex items-center flex-col" method="post">@csrf
                                <span class="text-zinc-700 text-2xl">Create Folder</span>
                                <input class="h-32 text-center border-8 bg-transparent text-zinc-700" type="text" id="indicatorFolder" value="{{ $title }}" disabled><br>
                                <input type="text" name="title" placeholder="Folder Name" class="w-full p-3 rounded border-none bg-slate-50">
                                <input id="parentID_Folder" type="hidden" value="{{ $parentCategoryID }}" name="parent_id" required>
                                <input type="submit" value="Create Folder" class="w-full p-3 text-lg bg-green-800 hover:bg-green-900 text-slate-50 mt-7 rounded cursor-pointer">
                            </form>
                        </div>
                        <!-- Upload File Form -->
                        <div class="hidden w-full" id="showUploadFile">
                            <form action="{{ route('uploadFile') }}" class="px-5 py-10 bg-slate-200 rounded flex items-center flex-col" method="post" enctype="multipart/form-data">@csrf
                                <span class="pb-10 text-zinc-700 text-2xl">Upload File</span>
                                <input class="text-center bg-transparent border-none text-zinc-700" type="text" id="indicatorFile" value="{{ $title }}" disabled><br>
                                <input type="text" placeholder="File Name" class="w-full p-3 rounded border-none bg-slate-50" name="alternative_name">
                                <div class="flex mt-3 items-center justify-center w-full">
                                    <label for="dropzone-file" class="flex flex-col items-center justify-center rounded w-full h-fit border-2 bg-slate-50 cursor-pointer">
                                    <i class="bi bi-cloud-arrow-up-fill text-green-800 text-3xl pt-3"></i>
                                    <p class="text-green-800 py-3 text-center">Click to upload or drag and down</p>
                                    <input id="dropzone-file" type="file" name="file" class="hidden" />
                                    </label>
                                </div>
                                <input id="parentID_File" type="hidden" value="{{ $parentCategoryID }}" name="parent_id" required>
                                <input type="submit" value="Upload File" class="w-full p-3 text-lg bg-green-800 hover:bg-green-900 text-slate-50 mt-7 rounded cursor-pointer">
                            </form>
                        </div>

                        <!-- Upload Via URL -->
                        <div class="hidden w-full" id="showUploadFileUrl">
                            <form action="{{ route('uploadUrl') }}" class="px-5 py-10 bg-slate-200 rounded flex items-center flex-col" method="post">@csrf
                                <span class="pb-10 text-zinc-700 text-2xl">Upload Url</span>
                                <input class="text-center bg-transparent border-none text-zinc-700" type="text" id="indicatorURL" value="{{ $title }}" disabled><br>
                                <input type="text" class="w-full p-3 rounded border-none bg-slate-50" placeholder="URL Name" name="alternative_name" required>
                                <input type="url" class="mt-3 w-full p-3 rounded border-none bg-slate-50" placeholder="URL" name="url" required>
                                <input id="parentID_URL" type="hidden" value="{{ $parentCategoryID }}" name="parent_id">
                                <input type="submit" value="Upload Url" class="w-full p-3 text-lg bg-green-800 hover:bg-green-900 text-slate-50 mt-7 rounded cursor-pointer">
                            </form>
                        </div>
                        <!-- End Upload Via URL -->
                    </div>
                </div>
                <div class="mt-5 max-h-96 py-2">
                    <!-- Recent Uploads -->
                    <div class="rounded-lg w-full shadow">
                        <h1 class="px-3 py-4 text-xl bg-slate-200 rounded-tr-lg rounded-tl-lg">Recent Upload Files</h1>

                            @foreach ($recentlyInsertedData as $file)
                                <div class="px-2 py-3 w-full flex">
                                    <i class=" pl-2 bi bi-file-earmark-image-fill text-indigo-800"></i>
                                    <p class="ml-2">{{ $file->alternative_name }}</p>
                                </div>
                            @endforeach

                        <div class="rounded-bl-lg rounded-br-lg"></div>
                    </div>
                </div>
            </div>
            <!-- Folders and Files -->
            <div class="xl:col-span-4 lg:col-span-4 md:col-span-3 p-5">
                <!-- Template Title and Template Description -->
                <div class="">
                    <!-- Template Title -->
                    <div class="flex justify-between">
                        <span class="text-xl font-bold text-zinc-700">{{ $title }}</span>
                        <div class="">
                            <button id="buttonCaption" class="bg-green-800 hover:bg-green-900 text-white py-2 px-2 rounded">Caption</button>
                            <div class="hidden" id="showButtonCaption">
                                <div class="flex flex-col bg-slate-200 mt-1 rounded absolute w-20">
                                    <button id="buttonUpdateDescription" class="w-full bg-slate-300 p-1 text-zinc-700 border-slate-200 hover:bg-slate-400 border-b">Edit</button>

                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#buttonCaption").click(function(){
                                    $("#showButtonCaption").toggle(300);
                                });
                            });
                        </script>
                    </div>
                    <!-- Template Description -->
                    <div class="mt-5">
                    <h1 class="text-red-900"></h1>
                        <p class="w-full text-justify"><span class="mr-10"></span>{{ $descriptions }}</p>
                    </div>
                </div>

                <!-- Folder and Files -->
                <div class="mt-10">
                    <form class="w-full items-center justify-between border-b" action="{{ '/users/delete_sff' }}" method="post"> @csrf
                        {{-- Action Wrap --}}
                        <div class="grid grid-cols-2 w-full mb-2">
                            <h1 class="text-xl font-bold text-zinc-700">Folders and Files</h1>

                            <div class="text-right">
                                <!-- Updating a new name -->
                                <span class="hidden" id="showEditNameFile">
                                    <span class="mr-3">
                                        <!-- <form action="" class="flex"> -->
                                            <input type="text" name="title" class="w-3/5 border-none shadow bg-slate-50 p-2 rounded-tl rounded-bl" placeholder="New Name">
                                            <input type="submit" value="update" name="submit" class="bg-green-800 hover:bg-green-900 rounded-tr rounded-br text-white p-2 cursor-pointer">
                                        <!-- </form> -->
                                    </span>
                                </span>
                                <!-- Update -->
                                <label for="update" id="buttonEditNameFile"><i class="bi bi-pencil-fill w-full text-zinc-700 mr-2 cursor-pointer text-xl hover:text-2xl"></i></label>
                                {{-- <input class="border-2 border-black p-2 cursor-pointer hidden" type="submit" name="submit" value="update" id="update"> --}}
                                <!-- Delete -->
                                <label for="delete"><i class="bi bi-trash-fill w-full text-zinc-700 cursor-pointer text-xl hover:text-2xl"></i></label>
                                <input class="border-2 border-black p-2 cursor-pointer hidden" type="submit" name="submit" value="delete" id="delete" >
                            </div>
                        </div>

                        <div class="h-flf overflow-auto bg-slate-100">
                            <input id="fileID" type="hidden" name="id">

                            @foreach ($categories as $index => $category)

                                <x-sub-category :category="$category" :index="$index" />

                            @endforeach

                        </div>

                    </form>
                </div>

            </div>
       </div>
    </div>

    <!-- Jquery -->
    <script>
        $(document).ready(function(){
            $("#buttonCreateFolder").click(function(){
                $("#showCreateFolder").show(400);
            });
            $("#buttonCreateFolder").click(function(){
                $("#showUploadFile").hide(400);
            });
            $("#buttonCreateFolder").click(function(){
                $("#showUploadFileUrl").hide(400);
            });
        });
        $(document).ready(function(){
            $("#buttonUploadFile").click(function(){
                $("#showUploadFile").show(400);
            })
            $("#buttonUploadFile").click(function(){
                $("#showCreateFolder").hide(400);
            })
            $("#buttonUploadFile").click(function(){
                $("#showUploadFileUrl").hide(400);
            })
        });
        $(document).ready(function(){
            $("#buttonUploadFileUrl").click(function(){
                $("#showUploadFileUrl").show(400);
            })
            $("#buttonUploadFileUrl").click(function(){
                $("#showCreateFolder").hide(400);
            })
            $("#buttonUploadFileUrl").click(function(){
                $("#showUploadFile").hide(400);
            })
        });
        $(document).ready(function(){
            $("#buttonInsertCaption").click(function(){
                $("#showInsertCaption").toggle(400);
            })
        });
        $(document).ready(function(){
            $("#buttonEditNameFile").click(function(){
                $("#showEditNameFile").toggle();
            })
        })
    </script>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <!-- Jquery Validate Plugin  -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</body>
</html>

<script>

function getParentID(){

    var items = document.querySelectorAll('.item');

    for (var index = 0; index < items.length; index++) {

        items[index].addEventListener('click', function(event) {

            var clickedDiv = event.target;

            var attributeValue = clickedDiv.getAttribute('data-id');

            //getting the parent title indicator
            if (attributeValue.includes("folder")) {

                var folderTitle = attributeValue.split('_')[1];
                document.getElementById("indicatorFolder").value=folderTitle;
                document.getElementById("indicatorFile").value=folderTitle;
                document.getElementById("indicatorURL").value=folderTitle;

            } else {

                var folderTitle = attributeValue.split('_')[1];

            }

            //highlighting the <div> tag
            clickedDiv.classList.toggle('highlighted');

            //getting and storing the category ID and folder/file ex. 1folder/1file

            //removing the category title from attributeValue
            if ( attributeValue.includes('folder') ) {
                var remString = attributeValue.split('_')[0];
                console.log(remString);
                var finalString = remString+"folder";
            } else {
                var remString = attributeValue.split('_')[0];
                var finalString = remString+"file";
            }

            var parentID_Folder = document.getElementById("parentID_Folder");

                parentID_Folder.value = finalString;

            var parentID_File = document.getElementById("parentID_File");

                parentID_File.value = finalString;

            var parentID_URL = document.getElementById("parentID_URL");

                parentID_URL.value = finalString;

            var fileID = document.getElementById("fileID");

                fileID.value = finalString;

        });
    }
}
</script>
