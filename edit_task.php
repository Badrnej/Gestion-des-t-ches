<form method="POST" action="edit_task.php" class="space-y-4">
    <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
    <div>
        <label for="task_title" class="block text-sm font-medium text-gray-700">Titre de la tâche</label>
        <input type="text" id="task_title" name="task_title" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <div>
        <label for="task_description" class="block text-sm font-medium text-gray-700">Description de la tâche</label>
        <textarea id="task_description" name="task_description" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
    </div>
    <div>
        <label for="task_category" class="block text-sm font-medium text-gray-700">Catégorie</label>
        <select id="task_category" name="task_category" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <option value="informatique">informatique</option>
            <option value="infography">infography</option>
            <option value="reseau">reseau</option>
        </select>
    </div>
    <div>
        <label for="task_deadline" class="block text-sm font-medium text-gray-700">Date limite</label>
        <input type="date" id="task_deadline" name="task_deadline" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <div>
        <label for="task_priority" class="block text-sm font-medium text-gray-700">Priorité</label>
        <select id="task_priority" name="task_priority" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <option value="important">Important</option>
            <option value="normal">Normal</option>
            <option value="not_important">Non important</option>
        </select>
    </div>
    <div class="flex justify-end">
        <button type="submit" name="edit_task" class="px-4 py-2 bg-purple-600 text-white rounded-md">Modifier la tâche</button>
    </div>
</form>
