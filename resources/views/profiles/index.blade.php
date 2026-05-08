<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black flex justify-center items-center min-h-screen">

<div class="bg-white w-[1050px] h-[700px] p-10 pb-20 rounded-lg shadow-lg">

    <div class="flex gap-10">

        <!-- LEFT -->
        <div class="w-[320px]">

            <div class="relative">
                <img src="https://i.pinimg.com/736x/29/0f/f5/290ff5805361cff0c8f90c9039a81a1e.jpg"
                     class="w-full h-[250px] object-cover rounded">

                <!-- <button class="absolute bottom-0 left-0 w-full bg-black/50 text-white py-3">
                    <a href="{{ route('profiles.edit') }}" class="text-2xl">Edit Profile</a>
                </button> -->
            </div>

            <h1 class="text-blue-500 text-4xl font-bold mt-6">
                Punloeu sok
            </h1>

            <p class="text-2xl text-gray-700 mt-2">
                worker at company
            </p>

        </div>

        <!-- RIGHT -->
        <div class="flex-1">

            <h2 class="text-4xl font-bold mb-4">
                About Me
            </h2>

            <p class="text-2xl leading-relaxed text-gray-700">
                Hobby exercise and learning new technologies
                in this industry for developing myself
                to be better and wanna see myself successfull.
            </p>

            <!-- Tabs -->
            <div class="flex gap-20 border-b mt-20 pb-3 text-3xl">
                <button class="border-b-2 border-blue-500 pb-2">
                    contact info
                </button>

                <button>
                    additional info
                </button>
            </div>

            <!-- Info -->
            <div class="mt-16 space-y-8 text-2xl">
                

                <p>
                    <strong>Email:</strong> wmad003@gmail.com
                </p>

                <p>
                    <strong>Phone number :</strong> 072 222 445
                </p>

                <p>
                    <strong>Facebook :</strong> WMAD Official
                </p>

                <div class="flex justify-end gap-10 mt-32"> 

                <!-- Buttons -->
                <button class="bg-indigo-900 text-white px-20 py-4 rounded-xl text-2xl">
                 BACK
                </button>
                </div>

            </div>

            
            
               

        </div>

    </div>

</div>

</body>
</html>