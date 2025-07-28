<!-- ブログ -->
<div class="box blog-section">
    <div class="d-flex  justify-content-between align-items-center blog-header">
        <div class="d-flex">
            <i class="fa-solid fa-blog fa-2x" style="color: white;"></i>
            <h2 class="ms-2 fw-bold">BLOG</h2>
        </div>
        <div>
            <button class="add-btn" onclick="">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="row row-cols-3 g-3 blog-content">
        <div class="col text-center">
            <img src="{{ asset('images/daiki_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="daiki">
            <div class="text-white fw-bold">daiki</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/kyota_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="kyota">
            <div class="text-white fw-bold">kyota</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/daiki_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="daiki">
            <div class="text-white fw-bold">daiki</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/kyota_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="kyota">
            <div class="text-white fw-bold">kyota</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/daiki_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="daiki">
            <div class="text-white fw-bold">daiki</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/kyota_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="kyota">
            <div class="text-white fw-bold">kyota</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/daiki_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="daiki">
            <div class="text-white fw-bold">daiki</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/kyota_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="kyota">
            <div class="text-white fw-bold">kyota</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/daiki_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="daiki">
            <div class="text-white fw-bold">daiki</div>
            <div class="text-muted small">5min ago</div>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/kyota_icon.jpg') }}" class="rounded-circle blog-avatar new" data-user="kyota">
            <div class="text-white fw-bold">kyota</div>
            <div class="text-muted small">5min ago</div>
        </div>

    </div>
</div>

<script>
    window.addEventListener = () => {
        const readUsers = JSON.parse(localStorage.getItem('readUsers') || '[]');
        document.querySelectorAll('.blog-avatar').forEach(avatar => {
            const user = avatar.dataset.user;
            if (readUsers.includes(user)) {
                avatar.classList.remove('new');
                avatar.classList.add('read');
            }

            avatar.addEventListener('click', () => {
                avatar.classList.remove('new');
                avatar.classList.add('read');
                markAsRead(user);
            });
        });
    };

    function markAsRead(user) {
        let readUsers = JSON.parse(localStorage.getItem('readUsers') || '[]');
        if (!readUsers.includes(user)) {
            readUsers.push(user);
            localStorage.setItem('readUsers', JSON.stringify(readUsers));
        }
    }
</script>
