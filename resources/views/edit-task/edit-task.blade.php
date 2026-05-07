<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Task</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <!-- Form Container (No Modal) -->
  <div class="bg-white w-full max-w-lg rounded-2xl shadow-lg p-6">

    <!-- Header -->
    <div class="mb-4">
      <h2 class="text-xl font-semibold text-gray-800">Edit task</h2>
      <hr class="mt-2">
    </div>

    <!-- Form -->
    <form class="space-y-4">

      <!-- Task Title -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Task Title *</label>
        <input type="text" placeholder="Enter task title..."
          class="mt-1 w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none" />
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Descriptions</label>
        <textarea rows="3" placeholder="Add details about this task..."
          class="mt-1 w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
      </div>

      <!-- Date & Priority -->
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-sm font-medium text-gray-700">Due date *</label>
          <input type="date"
            class="mt-1 w-full px-3 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Priority</label>
          <select
            class="mt-1 w-full px-3 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none">
            <option>Low</option>
            <option selected>Medium</option>
            <option>High</option>
          </select>
        </div>
      </div>

      <!-- Category -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Category</label>
        <select
          class="mt-1 w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 outline-none">
          <option>Work</option>
          <option>Personal</option>
          <option>Study</option>
        </select>
      </div>

      <!-- Reminder -->
      <div class="flex items-center gap-2">
        <input type="checkbox" class="w-4 h-4">
        <label class="text-sm text-gray-600">Set reminder notification</label>
      </div>

      <!-- Buttons -->
      <div class="flex justify-between pt-4">
        <button type="button"
          class="w-1/2 mr-2 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200">
          Cancel
        </button>
        <button type="submit"
          class="w-1/2 ml-2 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
          Save Task
        </button>
      </div>

    </form>

  </div>

</body>
</html>
