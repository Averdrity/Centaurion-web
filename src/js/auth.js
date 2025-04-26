// ==========================
// Modal Handling (Bugfixes)
// ==========================

let lastFocusedElement = null;

function openModal(id) {
    lastFocusedElement = document.activeElement;
    const overlay = document.getElementById('modalsOverlay');
    overlay.classList.remove('hidden');
    // Hide all modals
    document.querySelectorAll('.modal-container').forEach(m => m.classList.add('hidden'));
    // Show only the requested modal
    document.getElementById(id).classList.remove('hidden');

    // Focus first input in modal
    const firstInput = document.getElementById(id).querySelector('input, textarea, button');
    if (firstInput) firstInput.focus();

    // Trap focus
    trapFocus(document.getElementById(id));

    if (id === 'loginModal' && localStorage.getItem('rememberedUsername')) {
        document.getElementById('loginUsername').value = localStorage.getItem('rememberedUsername');
    }
    if (id === 'profileModal') {
        loadProfileData();
    }
}

function closeModal() {
    const overlay = document.getElementById('modalsOverlay');
    overlay.classList.add('hidden');
    document.querySelectorAll('.modal-container').forEach(m => m.classList.add('hidden'));
    if (lastFocusedElement) lastFocusedElement.focus();
    removeTrapFocus();
}

// Click outside modal to close (only if click is directly on overlay)
document.getElementById('modalsOverlay').addEventListener('mousedown', function(e) {
    if (e.target === this) closeModal();
});

// Esc key to close modal
window.addEventListener('keydown', function(e) {
    const overlay = document.getElementById('modalsOverlay');
    if (!overlay || overlay.classList.contains('hidden')) return;
    if (e.key === 'Escape') closeModal();
});

function switchToRegister() {
    document.getElementById('loginModal').classList.add('hidden');
    openModal('registerModal');
}

function switchToLogin() {
    document.getElementById('registerModal').classList.add('hidden');
    openModal('loginModal');
}

// ==========================
// Focus Trap Utility
// ==========================
let focusTrapElement = null;
let focusTrapHandler = null;

function trapFocus(modal) {
    focusTrapElement = modal;
    focusTrapHandler = function(e) {
        if (!focusTrapElement) return;
        const focusable = focusTrapElement.querySelectorAll('a, button, textarea, input, select, [tabindex]:not([tabindex="-1"])');
        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        if (e.key === 'Tab') {
            if (e.shiftKey) {
                if (document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                if (document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        }
    };
    document.addEventListener('keydown', focusTrapHandler);
}

function removeTrapFocus() {
    if (focusTrapHandler) document.removeEventListener('keydown', focusTrapHandler);
    focusTrapElement = null;
    focusTrapHandler = null;
}

// ==========================
// Toast Utility
// ==========================

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.textContent = message;
    toast.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-xl shadow-lg animate-fade-in text-white ${
        type === 'error' ? 'bg-red-600' : 'bg-green-600'
    }`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

// ==========================
// Utility Functions
// ==========================

function passwordsMatch(p1, p2) {
    return p1.trim() === p2.trim();
}

async function postJSON(url, data) {
    const response = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    });
    return await response.json();
}

// ==========================
// Auth: Login
// ==========================

async function handleLogin(event) {
    event.preventDefault();

    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;
    const remember = document.getElementById('rememberUsername').checked;

    try {
        const data = await postJSON('/api/auth/login.php', { username, password });

        if (data.success) {
            if (remember) {
                localStorage.setItem('rememberedUsername', username);
            } else {
                localStorage.removeItem('rememberedUsername');
            }
            closeModal();
            window.location.reload();
        } else {
            showToast(data.message || 'Login failed', 'error');
        }
    } catch {
        showToast('An error occurred during login', 'error');
    }
}

// ==========================
// Auth: Register
// ==========================

async function handleRegister(event) {
    event.preventDefault();

    const username = document.getElementById('registerUsername').value;
    const password = document.getElementById('registerPassword').value;
    const confirm = document.getElementById('confirmPassword').value;

    if (!passwordsMatch(password, confirm)) {
        showToast('Passwords do not match', 'error');
        return;
    }

    try {
        const data = await postJSON('/api/auth/register.php', { username, password });

        if (data.success) {
            closeModal();
            showToast('Registration successful!');
            openModal('loginModal');
        } else {
            showToast(data.message || 'Registration failed', 'error');
        }
    } catch {
        showToast('An error occurred during registration', 'error');
    }
}

// ==========================
// Auth: Profile
// ==========================

async function loadProfileData() {
    try {
        const response = await fetch('/api/auth/get-profile.php');
        const data = await response.json();

        if (data.success) {
            const { nickname, country, bio } = data.data;
            document.getElementById('nickname').value = nickname || '';
            document.getElementById('country').value = country || '';
            document.getElementById('bio').value = bio || '';
            document.getElementById('oldPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmNewPassword').value = '';
        } else {
            showToast(data.message || 'Failed to load profile data', 'error');
        }
    } catch {
        showToast('Error loading profile data', 'error');
    }
}

async function handleProfileUpdate(event) {
    event.preventDefault();

    const nickname = document.getElementById('nickname').value;
    const country = document.getElementById('country').value;
    const bio = document.getElementById('bio').value;
    const oldPassword = document.getElementById('oldPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmNewPassword').value;

    if (newPassword && !passwordsMatch(newPassword, confirmPassword)) {
        showToast('New passwords do not match', 'error');
        return;
    }

    try {
        const data = await postJSON('/api/auth/update-profile.php', {
            nickname,
            country,
            bio,
            oldPassword: oldPassword || null,
            newPassword: newPassword || null,
        });

        if (data.success) {
            showToast('Profile updated!');
        } else {
            showToast(data.message || 'Profile update failed', 'error');
        }
    } catch {
        showToast('Error updating profile', 'error');
    }
}

// ==========================
// Auth: Logout
// ==========================

async function logout() {
    try {
        const response = await fetch('/api/auth/logout.php', { method: 'POST' });
        const data = await response.json();

        if (data.success) {
            window.location.reload();
        } else {
            showToast(data.message || 'Logout failed', 'error');
        }
    } catch {
        showToast('Error logging out', 'error');
    }
}
