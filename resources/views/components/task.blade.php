<!-- タスク -->
<div class="box task-section">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex">
            <i class="fa-solid fa-list-check fa-2x" style="color: white;"></i>
            <h2 class="ms-2 fw-bold">TASK</h2>
        </div>
        <div>
            <button class="add-btn" onclick="addTask()">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="task-item d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center task-content" onclick="toggleTask(this)">
            <i class="fa-regular fa-square me-2 text-icon task-icon"></i>
            <span class="task-text">practice</span>
        </div>
        <div class="task-actions">
            <i class="fa-solid fa-pen-to-square text-white me-2" onclick="editTask(this)"></i>
            <i class="fa-solid fa-trash text-white" onclick="deleteTask(this)"></i>
        </div>
    </div>
</div>

<script>
    function addTask() {
        const taskSection = document.querySelector('.task-section');
        const currentTasks = taskSection.querySelectorAll('.task-item');

        if (currentTasks.length >= 3) {
            alert("タスクは最大3つまでです。");
            return;
        }

        const taskHTML = `
    <div class="task-item d-flex justify-content-between align-items-center mt-2">
        <div class="d-flex align-items-center task-content" onclick="toggleTask(this)">
            <i class="fa-regular fa-square task-icon me-2 text-icon"></i>
            <span class="task-text">New Task</span>
        </div>
        <div class="task-actions">
            <i class="fa-solid fa-pen-to-square me-2 text-white" onclick="editTask(this)"></i>
            <i class="fa-solid fa-trash text-white" onclick="deleteTask(this)"></i>
        </div>
    </div>
    `;

        taskSection.insertAdjacentHTML('beforeend', taskHTML);
    }

    function toggleTask(element) {
        const icon = element.querySelector('.task-icon');
        const text = element.querySelector('.task-text');

        if (icon.classList.contains('fa-square')) {
            // チェックON
            icon.classList.remove('fa-square');
            icon.classList.add('fa-square-check');
            text.classList.add('completed');
        } else {
            // チェックOFF
            icon.classList.remove('fa-square-check');
            icon.classList.add('fa-square');
            text.classList.remove('completed');
        }
    }

    function editTask(icon) {
        // すでに開いている編集フォームがあれば削除
        document.querySelectorAll('.task-edit-input').forEach(input => {
            const span = input.previousElementSibling;
            if (span && span.classList.contains('task-text')) {
                span.style.display = 'inline';
            }
            input.remove();
        });

        const taskItem = icon.closest('.task-item');
        const span = taskItem.querySelector('.task-text');

        // 編集用 input を作成
        const input = document.createElement('input');
        input.type = 'text';
        input.value = span.textContent;
        input.className = 'form-control form-control-sm task-edit-input mt-1';
        input.onkeydown = function(e) {
            if (e.key === 'Enter') {
                span.textContent = input.value.trim();
                span.style.display = 'inline';
                input.remove();
            } else if (e.key === 'Escape') {
                span.style.display = 'inline';
                input.remove();
            }
        };

        span.style.display = 'none';
        span.after(input);
        input.focus();
    }

    function deleteTask(element) {
        // 親の親（task-item 全体）を削除
        const taskItem = element.closest('.task-item');
        if (taskItem) {
            taskItem.remove();
        }
    }
</script>
