<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <title>Templates</title>
    <style>
        /* Inline CSS */
        .green{
            background-color: #166534;
        }
        .HomeContentBlur{
            opacity: 0.2;
            overflow: hidden;
        }
        .blurMeContent{
            opacity: 0.2;
        }
    </style>
</head>
<body class="font-poppins bg-slate-50 ">

    {{-- Show Folder Uddate Form --}}
    <div class="showFolderUpdate hidden">
        <div class="h-screen w-screen flex absolute justify-center items-center z-20">
            <form action="{{ '/users/editTemplate/' }}" method="POST" id="update-form" class="w-96 p-5 bg-slate-200 rounded"> @csrf
                <div>
                    <span class="w-full border-8 flex items-center justify-center text-2xl text-zinc-700 p-5">
                        <p class="text-center">Template Name</p>
                    </span>
                    <input class="rounded bg-slate-50 border-none text-zinc-600 w-full" type="text" name="title" placeholder="New template name">
                    <input type="hidden" name="tid" id="template_id">
                    <div class="mt-5 flex justify-between">
                        <input type="submit" name="submit" value="Update" class="text-white text-base absoluite cursor-pointer bg-green-800 w-update-t-name rounded hover:bg-green-900">
                        <input type="button" value="Cancel" id="" class="nameUpdateClose bg-red-800 hover:bg-red-800 p-2 text-white w-update-t-name cursor-pointer rounded">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Error Message form -->
    {{-- @if(session()->has('message'))
        <div class="showErrorMessage hidden">
            <div class="h-screen w-screen absolute flex justify-center items-center z-20">
                <form  action="{{ '/users/continue_delete_template/'.session('template_id') }}" method="post" class="px-5 py-2 rounded bg-slate-200 w-register-box">@csrf
                    <p class="text-center p-5 text-xl text-zinc-700"><span class="text-red-600">Ooops!</span> {{ session('message') }}</p>
                    <div class="flex items-center justify-between mt-3">
                        <div></div>
                        <div class="">
                            <input type="button" name="submit" value="Cancel" class="closeErrorMessage bg-red-800 cursor-pointer py-3 px-4 text-slate-50 rounded hover:bg-red-900 p-2">
                            <input type="submit" value="Continue" name="submit" class="text-center cursor-pointer rounded py-3 px-4 bg-green-800 text-slate-50 hover:bg-green-900">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif --}}

    @if(session()->has('message'))
        <div class="showErrorMessage">
            <div class="h-screen w-screen absolute flex justify-center items-center">
                <div class="">
                    <form action="{{ '/users/continue_delete_template/'.session('template_id') }}" method="post" class="px-5 py-2 rounded bg-slate-200 w-register-box">@csrf
                        <p class="text-center p-5 text-xl text-zinc-700"><span class="text-red-600">Ooops!</span> {{ session('message') }}</p>
                        <div class="flex items-center justify-between mt-3">
                            <div></div>
                            <div class="">
                                <input type="submit" name="submit" value="Cancel" class="closeErrorMessage bg-red-800 cursor-pointer py-3 px-4 text-slate-50 rounded hover:bg-red-900 p-2">
                                <input type="submit" value="Continue" name="submit" class="text-center cursor-pointer rounded py-3 px-4 bg-green-800 text-slate-50 hover:bg-green-900">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 outline-none focus:ring-2 focus:bg-green-800 focus:text-white">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <!-- Side Bar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-80 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-5 py-4 overflow-y-auto bg-green-800">
            <!-- Logo -->
            <a href="#" class="flex items-center mb-5 mt-2">
                {{-- <i class="bi bi-folder-fill text-orange-300 text-4xl pr-4"></i> --}}
                <h1 class="text-center  text-3xl w-full text-slate-50">Create Templates</h1>
            </a>
            <ul class="space-y-2 mt-10">
                <li class="rounded-xl" id="showTemplate">
                    <a href="#" class="flex items-center p-4 text-xl font-medium rounded-lg bg-slate-100">
                        <i class="bi bi-plus-circle-fill text-green-800"></i>
                        <span class="ml-5 text-green-900">New Template</span>
                    </a>
                </li>
                <li class="rounded-xl" id="">
                    <!-- Form to create New Template -->
                    <form action="{{ 'addTemplate' }}" class="p-3 bg-slate-200 rounded mt-5 relative hidden" id="showTemplateForm" method="POST">@csrf
                        <input type="text" placeholder="Folder Name" name="title" class="w-full p-3 rounded-lg focus:outline-none focus:outline-green-900 border-none">
                        <!-- Title Description || textarea -->
                        <div class="mt-3">
                            <textarea name="descriptions" id="" cols="30" rows="10" placeholder="Title description" class="resize-none p-2 border-none rounded-lg" required></textarea>
                        </div>
                        <!-- Buttons -->
                        <div class="flex justify-end mt-3">
                            <input type="submit" value="Create" name="submit" class="bg-green-800 hover:bg-green-900 text-white w-full rounded-lg p-3 text-lg cursor-pointer">
                            <!-- {{-- <input type="reset" value="Cancel" id="hideTemplate" class="bg-red-800 hover:bg-red-900 text-white w-6/12 rounded-lg p-3 text-lg cursor-pointer" name="back"> --}} -->
                        </div>
                    </form>
                </li>
                {{-- <li>
                    <a href="{{ '/users/folderfiles' }}" class="flex items-center p-4 text-lg font-medium text-white rounded-lg hover:bg-slate-50 hover:text-green-900">
                        <i class="bi bi-file-earmark-fill text-xl"></i>
                        <span class="flex-1 ml-5 whitespace-nowrap">Temporary File</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ '/users/logout' }}" class="flex items-center p-4 text-lg font-medium text-white rounded-lg hover:bg-slate-50 hover:text-green-900">
                        <i class="bi bi-arrow-left-circle-fill text-xl"></i>
                        <span class="flex-1 ml-5 whitespace-nowrap">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Parent Folder / Main Content-->
    <div class="blurMe" id="border-8">
        <div class="p-4 sm:ml-80">
            <div class="p-4 rounded-lg">
                <h1 class="text-zinc-600 pb-4 ml-2 text-2xl">Parent Folder</h1>
                <!-- Search Input -->
                <!-- <div class="grid grid-cols-1 mb-4">
                    <input type="search" placeholder="Search template" class="rounded focus:outline-green-800 outline-none">
                </div> -->
                <!-- Templates -->
                <div class="grid xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-1 gap-5 mb-4">
                    @if ($templates->isEmpty())
                        <!-- Condition when no template has been created -->
                        <div class=" ml-2 absolute text-center">
                            <h1 class="text-3xl text-zinc-600">No Template Created</h1>
                        </div>
                        <!-- Content when template have created -->
                    @else
                        @foreach ($templates as $template)
                            @if (Session::get('user_id') == $template->user_id)
                                @if ( $template->status == 0 )
                                    {{-- dito iyong default color --}}
                                    <div id="sample" class="flex items-center justify-center flex-col shadow h-fit rounded-xl tex-white bg-slate-100 border-2 border-slate-200">
                                @else
                                    {{-- dito iyong activated color --}}
                                    <div id="sample" class="green flex items-center justify-center flex-col shadow h-fit rounded-xl text-white bg-slate-100 border-2 border-slate-200">
                                @endif
                                    <div class="w-full p-5 flex justify-between">
                                        <div>
                                            <!-- View Folder -->
                                            <a href="{{ '/users/file/'.$template->id }}" class="cursor-pointer bg-blue-500 px-3 py-2 hover:bg-blue-600 text-white rounded-lg mr-2"><i class="bi bi-arrow-right"></i></a>
                                        </div>
                                        <div>
                                            {{-- Preview --}}
                                            <a href="{{ '/users/preview/'.$template->id }}" class="cursor-pointer bg-indigo-500 py-2 px-1 hover:bg-indigo-600 rounded-lg mr-1" target="_blank"><i class="bi bi-eye-fill text-slate-100 p-2"></i></a>

                                            {{-- Duplication --}}
                                            <a href="{{ '/users/duplicate/'.$template->id }}" class="cursor-pointer bg-orange-500 py-2 px-1 hover:bg-orange-600 rounded-lg mr-1"><i class="bi bi-back text-slate-100 p-2"></i></a>

                                            <!--Edit icon-->
                                            <a href="#{{ $template->id }}" id="update-icon" onclick="updateTitle()" data-tooltip-target="tooltip-default" class="nameUpdate cursor-pointer bg-yellow-400 py-2 px-1 hover:bg-yellow-500 rounded-lg mr-1"><i class="bi bi-pencil-fill text-slate-100 p-2 _{{ $template->id }}"></i></a>
                                            <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip">
                                                <p>TAKE NOTE! <br> <p class="text-justify">Please double click the pencil button <br> to edit the template name and click
                                                    <br> once the cancel button to close the form</p></p>
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                            <!--Delete icon-->
                                            {{-- <a href="{{ '/users/delete_template/'.$template->id }}" class="buttonErrorMessage cursor-pointer bg-red-500 py-2 px-1 hover:bg-red-600 rounded-lg"><i class="bi bi-trash3-fill text-slate-100 p-2"></i></a> --}}
                                        </div>
                                    </div>

                                    <div class=" flex justify-end items-center w-full mt-2">
                                        <span class="mr-3 text-base font-medium">Set as active</span>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">

                                                @if ( $template->status == 0 )
                                                {{-- Naka off --}}
                                                    <input type="checkbox" value="Enable{{$template->id}}" class="sr-only peer" id="checkbox" onchange='javascript:handleToggle(this)'>
                                                @else
                                                {{-- naka on --}}
                                                    <input type="checkbox" value="Disable{{$template->id}}" class="sr-only peer" id="checkbox" onchange='javascript:handleToggle(this)' checked>
                                                @endif

                                            <script>
                                            function handleToggle(elm){
                                                if(elm.value.includes('Enable')==true){
                                                    const newStr = elm.value.replace('Enable', '');
                                                    console.log(newStr);
                                                    location.href = "{{ route('changeStatus', ['template_id' => ':newStr']) }}".replace(':newStr', newStr);
                                                }
                                                if(elm.value.includes('Disable')==true){
                                                    const newStr = elm.value.replace('Disable', '');
                                                    console.log(newStr);
                                                    location.href = "{{ route('changeStatus', ['template_id' => ':newStr']) }}".replace(':newStr', newStr);
                                                }
                                            }
                                            </script>

                                            <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-800"></div>
                                        </label>
                                    </div>
                                    </form>
                                        <p class="text-5xl mt-8 text-orange-300">
                                            <i class="bi bi-folder-fill"></i>
                                        </p>

                                        <p class="text-2xl text-center mb-5">
                                            {{ $template->title }}
                                        </p>
                                        <!-- Template Description -->
                                        <div class="px-5 h-28 border-2 border-transparent overflow-hidden mb-2">
                                            <p class="text-center text-lg">{{ $template->descriptions }}</p>
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    @endif
                    <!-- Update New Name -->
                    {{-- <div class="flex items-end mt-5 visible">
                        <form action="{{ '/users/editTemplate/' }}" method="POST" id="update-form" class="p-5 bg-slate-300 rounded showFolderUpdate"> @csrf
                        <div>
                            <input class="bg-green-800 border-none rounded-tl rounded-bl text-white" type="text" name="title" placeholder="New template name">
                            <input type="hidden" name="tid" id="template_id">
                            <input type="submit" name="submit" value="Go" class="h-10 text-base absoluite cursor-pointer bg-yellow-400 w-10 rounded-tr rounded-br hover:bg-yellow-500">
                        </div>
                        </form>
                </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!--Error Messages-->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>alert('something went wrong')</script>
        @endforeach
    @endif

    <script>
        $(document).ready(function(){
            $("#showTemplate").click(function(){
                $("#showTemplateForm").toggle(200);
            });
            $("#hideTemplate").click(function(){
                $("#showTemplateForm").hide();
            });
        });

        // Toggle for updating the name of the folder
        $(document).ready(function(){
            $(".nameUpdate").dblclick(function(){
                $(".showFolderUpdate").show()
            })

            //Blur the background
            $(".nameUpdate").dblclick(function(){
                $(".blurMe").addClass("blurMeContent");
            });
        })

        $(document).ready(function(){
            $(".nameUpdateClose").click(function(){
                $(".showFolderUpdate").hide()
            })

            //Remove blur the background
            $(".nameUpdateClose").click(function(){
                $(".blurMe").removeClass("blurMeContent");
            });
        })

        // Display Error Message for deleting template
        $(document).ready(function(){
            $(".buttonErrorMessage").click(function(){
                $(".showErrorMessage").show()
            })

            // Blur the background
            $(".buttonErrorMessage").click(function(){
                $(".blurMe").addClass("blurMeContent");
            });
        })

        $(document).ready(function(){
            $(".closeErrorMessage").click(function(){
                $(".showErrorMessage").hide()
            })

            //Remove blur the background
            $(".closeErrorMessage").click(function(){
                $(".blurMe").removeClass("blurMeContent");
            });
        })


        // Toggle for updating the title template
        function updateTitle(){
            // getting the href content and removing its '#' symbol.
            var aid = document.querySelectorAll('.nameUpdate');
            // getting the action attribute inside form tag and removing alpha and special character string to get the ID.
            for (var i = 0; i < aid.length; i++) {

                aid[i].addEventListener('click', function(event) {
                    var aTag1 = event.target;
                    var attributeValue = aTag1.getAttribute('class').split('_')[1];
                    var parentID_Folder = document.getElementById("template_id");
                    parentID_Folder.value = attributeValue;
                });
            }
        }

        // Set active background
        // const btn = document.querySelector('#checkbox')
        // const body = document.getElementById('sample')

        function change(){
            btn.checked ? body.classList.add("green") : body.classList.remove("green")
        }

        btn.addEventListener('change', change)
    </script>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <!-- Jquery Validate Plugin  -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</body>
</html>
