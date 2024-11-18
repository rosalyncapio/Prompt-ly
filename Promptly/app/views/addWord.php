<div class="flex flex-col md:flex-row gap-6">
            <!-- Add New Word Section -->
            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-bold mb-4">Add New Word</h2>
                <div class="bg-gray-800 rounded-lg p-6">
                    <form id="addWordForm" class="space-y-4">
                        <div>
                            <label for="word" class="block mb-2">Word</label>
                            <input type="text" id="word" name="word" placeholder="Enter a Word" class="w-full bg-gray-700 text-white placeholder-gray-400 border-none rounded-md p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                        <div>
                            <label for="definition" class="block mb-2">Definition</label>
                            <textarea id="definition" name="definition" placeholder="Enter the Definition" class="w-full bg-gray-700 text-white placeholder-gray-400 border-none rounded-md p-3 h-32 focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none" required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-md transition duration-200">
                            Add Word
                        </button>
                    </form>
                </div>
            </div>

            <!-- Word List Section -->
            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-bold mb-4">Word List</h2>
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-900">
                                <th class="text-left p-4">Word</th>
                                <th class="text-left p-4">Definition</th>
                            </tr>
                        </thead>
                        <tbody id="wordList">
                            <?php if(isset($words) && !empty($words)): ?>
                                <?php foreach($words as $word): ?>
                                    <tr class="border-t border-gray-700">
                                        <td class="p-4"><?php echo htmlspecialchars($word['word']); ?></td>
                                        <td class="p-4 text-gray-300"><?php echo htmlspecialchars($word['definition']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="border-t border-gray-700">
                                    <td colspan="2" class="p-4 text-center">No words added yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Word History Section -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Word History</h2>
            <div class="bg-gray-800 rounded-lg p-6 min-h-[200px]">
                <table class="w-full" id="wordHistory">
                    <thead>
                        <tr>
                            <th class="text-left p-2">Word</th>
                            <th class="text-left p-2">Definition</th>
                            <th class="text-left p-2">Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($word_history) && !empty($word_history)): ?>
                            <?php foreach($word_history as $history): ?>
                                <tr class="border-t border-gray-700">
                                    <td class="p-2"><?php echo htmlspecialchars($history['word']); ?></td>
                                    <td class="p-2 text-gray-300"><?php echo htmlspecialchars($history['definition']); ?></td>
                                    <td class="p-2 text-gray-300"><?php echo htmlspecialchars($history['created_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="p-2 text-center">No word history available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
<script>
$(document).ready(function() {
    function showNotification(message, isError = false) {
        const notificationElement = $('#notification');
        notificationElement.text(message)
            .removeClass('bg-green-500 bg-red-500')
            .addClass(isError ? 'bg-red-500' : 'bg-green-500')
            .removeClass('hidden')
            .fadeIn()
            .delay(3000)
            .fadeOut();
    }

    $('#addWordForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('words/add_word'); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    showNotification(response.message, false);
                    
                    // Add the new word to the Word List table
                    var newRow = '<tr class="border-t border-gray-700">' +
                                 '<td class="p-4">' + response.word.word + '</td>' +
                                 '<td class="p-4 text-gray-300">' + response.word.definition + '</td>' +
                                 '</tr>';
                    $('#wordList').prepend(newRow);
                    
                    // Add the new word to the Word History table
                    var historyRow = '<tr class="border-t border-gray-700">' +
                                     '<td class="p-2">' + response.word.word + '</td>' +
                                     '<td class="p-2 text-gray-300">' + response.word.definition + '</td>' +
                                     '<td class="p-2 text-gray-300">' + response.word.created_at + '</td>' +
                                     '</tr>';
                    $('#wordHistory tbody').prepend(historyRow);
                    
                    // Clear the form
                    $('#addWordForm')[0].reset();

                    // Remove "No words added yet" or "No word history available" messages if present
                    $('#wordList td[colspan="2"]').parent().remove();
                    $('#wordHistory td[colspan="3"]').parent().remove();
                } else {
                    showNotification(response.message, true);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                showNotification('An error occurred. Please try again.', true);
            }
        });
    });
});
</script>