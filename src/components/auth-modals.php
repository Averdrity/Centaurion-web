<!-- Modal Overlay -->
<div id="modalsOverlay" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/70 dark:bg-[#0f0f13]/90 backdrop-blur-xl p-4 transition-all duration-300">
  <!-- LOGIN MODAL -->
  <div id="loginModal" class="modal-container hidden">
    <div class="relative w-full max-w-md bg-white/80 dark:bg-[#181a20]/80 rounded-3xl shadow-2xl border border-white/20 dark:border-white/10 flex flex-col px-8 py-10 backdrop-blur-xl" style="box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);">
      <button type="button" class="absolute top-5 right-5 text-zinc-400 hover:text-red-500 text-2xl font-bold focus:outline-none transition" aria-label="Close" onclick="closeModal()">
        <img src="/assets/icons/tabler/x.svg" alt="Close" class="w-6 h-6" />
      </button>
      <h2 class="text-3xl font-extrabold text-center mb-8 text-[#1e293b] dark:text-[#e0e0e0] tracking-tight">Login</h2>
      <form id="loginForm" class="flex flex-col gap-6" autocomplete="off" onsubmit="handleLogin(event)">
        <div class="relative">
          <input type="text" id="loginUsername" name="username" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm" placeholder="Username" required autofocus>
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
        </div>
        <div class="relative">
          <input type="password" id="loginPassword" name="password" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm pr-12" placeholder="Password" required>
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
          <button type="button" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400 transition" onclick="togglePassword('loginPassword', this)">
            <!-- Eye icon (inline SVG fallback) -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <div class="flex items-center justify-between mt-2">
          <label class="inline-flex items-center text-sm text-slate-500 dark:text-slate-400 cursor-pointer">
            <input type="checkbox" id="rememberUsername" class="accent-blue-500 w-4 h-4 rounded border-slate-300 dark:border-slate-700 focus:ring-blue-400 mr-2 transition">
            <span>Remember me</span>
          </label>
        </div>
        <button type="submit" class="mt-2 w-full bg-gradient-to-r from-[#3a86ff] to-[#00d4ff] text-white font-bold py-3 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-blue-400">Login</button>
      </form>
      <div class="mt-6 text-center text-sm text-slate-500 dark:text-slate-400">
        Not a user? <button type="button" class="text-blue-500 hover:underline font-medium transition" onclick="switchToRegister()">Register here!</button>
      </div>
    </div>
  </div>

  <!-- REGISTER MODAL -->
  <div id="registerModal" class="modal-container hidden">
    <div class="relative w-full max-w-md bg-white/80 dark:bg-[#181a20]/80 rounded-3xl shadow-2xl border border-white/20 dark:border-white/10 flex flex-col px-8 py-10 backdrop-blur-xl" style="box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);">
      <button type="button" class="absolute top-5 right-5 text-zinc-400 hover:text-red-500 text-2xl font-bold focus:outline-none transition" aria-label="Close" onclick="closeModal()">
        <img src="/assets/icons/tabler/x.svg" alt="Close" class="w-6 h-6" />
      </button>
      <h2 class="text-3xl font-extrabold text-center mb-8 text-[#1e293b] dark:text-[#e0e0e0] tracking-tight">Register</h2>
      <form id="registerForm" class="flex flex-col gap-6" autocomplete="off" onsubmit="handleRegister(event)">
        <div class="relative">
          <input type="text" id="registerUsername" name="username" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm" placeholder="Username" required autofocus>
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
        </div>
        <div class="relative">
          <input type="password" id="registerPassword" name="password" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm pr-12" placeholder="Password" required>
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
          <button type="button" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400 transition" onclick="togglePassword('registerPassword', this)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <div class="relative">
          <input type="password" id="confirmPassword" name="confirmPassword" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm pr-12" placeholder="Confirm Password" required>
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
          <button type="button" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400 transition" onclick="togglePassword('confirmPassword', this)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <button type="submit" class="mt-2 w-full bg-gradient-to-r from-[#3a86ff] to-[#00d4ff] text-white font-bold py-3 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-blue-400">Register</button>
      </form>
      <div class="mt-6 text-center text-sm text-slate-500 dark:text-slate-400">
        Already a user? <button type="button" class="text-blue-500 hover:underline font-medium transition" onclick="switchToLogin()">Login here</button>
      </div>
    </div>
  </div>

  <!-- PROFILE MODAL -->
  <div id="profileModal" class="modal-container hidden">
    <div class="relative w-full max-w-md bg-white/80 dark:bg-[#181a20]/80 rounded-3xl shadow-2xl border border-white/20 dark:border-white/10 flex flex-col px-8 py-10 backdrop-blur-xl" style="box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);">
      <button type="button" class="absolute top-5 right-5 text-zinc-400 hover:text-red-500 text-2xl font-bold focus:outline-none transition" aria-label="Close" onclick="closeModal()">
        <img src="/assets/icons/tabler/x.svg" alt="Close" class="w-6 h-6" />
      </button>
      <h2 class="text-3xl font-extrabold text-center mb-8 text-[#1e293b] dark:text-[#e0e0e0] tracking-tight">Profile</h2>
      <form id="profileForm" class="flex flex-col gap-6 mb-8" autocomplete="off" onsubmit="handleProfileUpdate(event)">
        <div class="relative">
          <input type="text" id="nickname" name="nickname" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm" placeholder="Nickname">
        </div>
        <div class="relative">
          <input type="text" id="country" name="country" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm" placeholder="Country">
        </div>
        <div class="relative">
          <textarea id="bio" name="bio" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm resize-none" rows="3" placeholder="Bio"></textarea>
        </div>
        <button type="submit" class="bg-gradient-to-r from-[#00d4ff] to-[#3a86ff] text-white font-bold py-3 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-cyan-400">Save Profile</button>
      </form>
      <div class="flex items-center my-8">
        <div class="flex-grow border-t border-slate-200 dark:border-slate-700"></div>
        <span class="mx-4 text-red-500 font-semibold text-base animate-pulse">Change Password</span>
        <div class="flex-grow border-t border-slate-200 dark:border-slate-700"></div>
      </div>
      <form id="passwordForm" class="flex flex-col gap-6" autocomplete="off">
        <div class="relative">
          <input type="password" id="oldPassword" name="oldPassword" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm pr-12" placeholder="Old Password">
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
          <button type="button" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400 transition" onclick="togglePassword('oldPassword', this)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <div class="relative">
          <input type="password" id="newPassword" name="newPassword" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm pr-12" placeholder="New Password">
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
          <button type="button" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400 transition" onclick="togglePassword('newPassword', this)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <div class="relative">
          <input type="password" id="confirmNewPassword" name="confirmNewPassword" class="block w-full px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-white/60 dark:bg-[#23262f]/60 text-[#1e293b] dark:text-[#e0e0e0] placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:ring-2 focus:ring-blue-400 focus:outline-none transition shadow-sm pr-12" placeholder="Confirm New Password">
          <span class="absolute left-3 top-1/2 -translate-y-1/2">
          </span>
          <button type="button" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400 transition" onclick="togglePassword('confirmNewPassword', this)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <button type="submit" class="mt-2 w-full bg-gradient-to-r from-[#3a86ff] to-[#00d4ff] text-white font-bold py-3 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-200 text-lg focus:outline-none focus:ring-2 focus:ring-blue-400">Change Password</button>
      </form>
    </div>
  </div>
</div>

<script>
function togglePassword(inputId, btn) {
  const input = document.getElementById(inputId);
  if (!input) return;
  if (input.type === 'password') {
    input.type = 'text';
    btn.innerHTML = `<svg class='w-5 h-5' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'><path d='M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z'/><circle cx='12' cy='12' r='3'/><line x1='4' y1='4' x2='20' y2='20' stroke='currentColor' stroke-width='2'/></svg>`;
  } else {
    input.type = 'password';
    btn.innerHTML = `<svg class='w-5 h-5' fill='none' stroke='currentColor' stroke-width='2' viewBox='0 0 24 24'><path d='M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z'/><circle cx='12' cy='12' r='3'/></svg>`;
  }
}
</script>
