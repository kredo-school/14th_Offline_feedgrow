<!-- タスク -->
<div class="box task-section">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex mb-2">
            <i class="fa-solid fa-list-check fa-2x mt-1" style="color: white;"></i>
            <h2 class="ms-2 fw-bold mb-0">TASK</h2>
        </div>
        <div>
            <button class="add-btn" onclick="addTask()">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
</div>
<script>
    const TASK_KEY = 'tasks';

    function saveTasks() {
        const tasks = [];
        document.querySelectorAll('.task-item').forEach(item => {
            const text = item.querySelector('.task-text').textContent;
            const completed = item.querySelector('.task-icon').classList.contains('fa-square-check');
            tasks.push({
                text,
                completed
            });
        });
        localStorage.setItem(TASK_KEY, JSON.stringify(tasks));
    }

    function renderTask(text = "New Task", completed = false) {
        if (document.querySelectorAll('.task-item').length >= 3) return;

        const taskSection = document.querySelector('.task-section');

        const iconClass = completed ? 'fa-square-check' : 'fa-square';
        const textClass = completed ? 'completed' : '';

        const taskHTML = `
        <div class="task-item d-flex justify-content-between align-items-center mt-2">
            <div class="d-flex align-items-center task-content" onclick="toggleTask(this)">
                <i class="fa-regular ${iconClass} task-icon me-2 text-icon"></i>
                <span class="task-text ${textClass}">${text}</span>
            </div>
            <div class="task-actions">
                <i class="fa-solid fa-pen-to-square me-2 text-white" onclick="editTask(this)"></i>
                <i class="fa-solid fa-trash text-white" onclick="deleteTask(this)"></i>
            </div>
        </div>`;
        taskSection.insertAdjacentHTML('beforeend', taskHTML);
    }

    window.onload = function() {
        let savedTasks = JSON.parse(localStorage.getItem(TASK_KEY));

        // 初回アクセスならデフォルトの1つだけ表示
        if (!savedTasks || savedTasks.length === 0) {
            renderTask('New Task');
            saveTasks(); // 保存
        } else {
            savedTasks.forEach(task => renderTask(task.text, task.completed));
        }
    };

    function addTask() {
        const currentCount = document.querySelectorAll('.task-item').length;
        if (currentCount >= 3) {
            alert("タスクは最大3つまでです。");
            return;
        }
        renderTask();
        saveTasks();
    }

    function toggleTask(element) {
        const icon = element.querySelector('.task-icon');
        const text = element.querySelector('.task-text');

        if (icon.classList.contains('fa-square')) {
            icon.classList.remove('fa-square');
            icon.classList.add('fa-square-check');
            text.classList.add('completed');
        } else {
            icon.classList.remove('fa-square-check');
            icon.classList.add('fa-square');
            text.classList.remove('completed');
        }
        saveTasks();
    }

    function editTask(icon) {
        const taskItem = icon.closest('.task-item');
        const span = taskItem.querySelector('.task-text');

        // すでに他にinputがあれば戻す
        const existingInput = document.querySelector('.task-item input');
        if (existingInput) {
            existingInput.previousElementSibling.style.display = 'inline';
            existingInput.remove();
        }

        const input = document.createElement('input');
        input.type = 'text';
        input.value = span.textContent;
        input.className = 'form-control form-control-sm';
        input.onkeydown = function(e) {
            if (e.key === 'Enter') {
                span.textContent = input.value;
                span.style.display = 'inline';
                input.remove();
                saveTasks();
            }
        };

        span.style.display = 'none';
        span.after(input);
        input.focus();
    }

    function deleteTask(element) {
        const taskItem = element.closest('.task-item');
        if (taskItem) {
            taskItem.remove();
            saveTasks();
        }
    }
</script>
